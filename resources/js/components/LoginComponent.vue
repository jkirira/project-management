<template>

    <section id="top" class="text-gray-800 body-font relative px-4 lg:p-0">
        <div class="container px-5 py-24 md:mx-auto my-6 rounded-lg border-2 border-gray-200">
            <div class="flex items-center justify-center lg:w-1/2 md:w-2/3 mx-auto rounded-md mb-12 border-2 border-red-500" v-show="error">
                <h1 class="sm:text-2xl text-xl font-medium title-font text-red-500">{{error}}</h1>
            </div>
            <div class="flex flex-col text-center w-full mb-12">
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Login</h1>
                <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Login into your account</p>
            </div>
            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                <form>
                    <div class="flex flex-wrap -m-2">
                        <div class="p-2 w-full">
                            <div class="relative">
                                <label for="email" class="leading-7 text-sm text-gray-600">Email</label>
                                <input type="text" id="email" name="email" v-model="form.email" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                        <div class="p-2 w-full">
                            <div class="relative">
                                <label for="password" class="leading-7 text-sm text-gray-600">Password</label>
                                <input type="password" id="password" name="password" v-model="form.password" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>

                        <div class="p-2 mt-8 w-full">
                            <button @click="login" class="flex mx-auto text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">
                                Sign In
                            </button>
                        </div>

                    </div>
                </form>

            </div>

        </div>

    </section>

</template>

<script>
import {mapGetters, mapActions} from "vuex";
import store from "../store/index.js";
export default{
    name: "LoginComponent",
    data(){
        return{
            form:{
                email:'',
                password:''
            },
            error: null,
        }
    },

    methods: {
        validate(){
            if( this.form.email=='' ){
                this.error = "Please enter your email"
                return false;
            }

            if( this.form.password=='' ) {
                this.error = "Please enter your password"
                return false;
            }

            return true;

        },

        login(e){
            e.preventDefault();
            this.error = null
            if( !this.validate() ){
                return
            }

            axios.post('http://project-management.appp/api/login', this.form )
                .then((response) => {
                    this.$swal('Success', 'Login Successful');
                    console.log(response.data)
                    window.localStorage.setItem('token', response.data['token'].toString())
                    window.localStorage.setItem('user', JSON.stringify( response.data['user'] ))
                    store.dispatch("reset_user");
                    let role = response.data['user']['role_id'];
                    // this.$router.push({ name: 'home' })
                    window.location = '/'
                    return
                }) .catch((err) => {
                    this.error = err.response.data['message']
                    window.location = 'top';
                    return
                })
        }
    }

}
</script>

<style></style>
