<template>

    <section class="text-gray-600 body-font relative">
        <div class="w-full text-red-500" v-show="error">
           {{error}}
        </div>
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col text-center w-full mb-12">
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Login</h1>
                <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Login into your account</p>
            </div>
            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                <div class="flex flex-wrap -m-2">
                    <div class="p-2 w-full">
                        <div class="relative">
                            <label for="email" class="leading-7 text-sm text-gray-600">Email</label>
                            <input type="text" id="email" name="email" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                    </div>
                    <div class="p-2 w-full">
                        <div class="relative">
                            <label for="password" class="leading-7 text-sm text-gray-600">Password</label>
                            <input type="password" id="password" name="password" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                    </div>

                    <div class="p-2 mt-8 w-full">
                        <button class="flex mx-auto text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">Sign In</button>
                    </div>
                    <div class="p-2 w-full pt-8 mt-8 border-t border-gray-200 text-center">
                        <a class="text-green-500">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</template>

<script>
export default{
    name: "LoginComponent",
    data(){
        return{
            form:{
                email:'',
                password:''
            },
            error: null
        }
    },
    methods: {
        validate(){
            if( form.email=='' || form.password=='' ){
                return false;
            }
            return true
        },

        login(){
            this.error = null
            if( !validate ){
                this.error = "Please fill all values"
                return
            }

            axios.post('', {'email': form.email, password: 'form.password'})
            .then((response) => {
                if(response.status = 200){
                    flash('Login Successful')
                    window.location = '/home'
                }
            }) .catch((err) => {
                console.log(err)
                flash('Login Successful')
                return
            })
        }
    }

}
</script>

<style></style>
