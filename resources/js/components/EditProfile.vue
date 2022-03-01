<template>

    <section class="text-gray-600 body-font relative">
        <div class="container px-5 py-12 mx-auto">
            <div class="flex items-center justify-center w-3/4 mx-auto rounded-md mb-12 border-2 border-red-500" v-show="error">
                <h1 class="sm:text-2xl text-xl font-medium title-font text-red-500">{{error}}</h1>
            </div>
            <div class="flex flex-col w-full mb-12">
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Edit Profile</h1>
            </div>
            <div class="lg:w-1/2 md:w-2/3 ">
                <div class="flex flex-wrap -m-2">
                    <div class="p-2 w-1/2">
                        <div class="relative">
                            <label for="first_name" class="leading-7 text-sm text-gray-600">First Name</label>
                            <input type="text" id="first_name" required v-model="form.first_name" name="first_name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                    </div>
                    <div class="p-2 w-1/2">
                        <div class="relative">
                            <label for="last_name" class="leading-7 text-sm text-gray-600">Last Name</label>
                            <input type="text" id="last_name" required v-model="form.last_name" name="last_name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                    </div>
                    <div class="p-2 w-full">
                        <div class="relative">
                            <label for="national_id" class="leading-7 text-sm text-gray-600">National Id</label>
                            <input type="number" id="national_id" required v-model="form.national_id" name="national_id" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                    </div>
                    <div class="p-2 w-full">
                        <div class="relative">
                            <label for="phone" class="leading-7 text-sm text-gray-600">Phone</label>
                            <input type="number" id="phone" v-model="form.phone" name="phone" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                    </div>
                    <div class="p-2 w-full">
                        <div class="relative">
                            <label for="email" class="leading-7 text-sm text-gray-600">Email</label>
                            <input type="email" id="email" required v-model="form.email" name="email" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                    </div>
                    <div class="p-2 w-1/6 my-5">
                        <div class="relative">
                            <label for="unit_id" class="leading-7 text-sm text-gray-600">Unit ID</label>
                        </div>
                    </div>
                    <div class="p-2 w-3/4 my-5">
                        <div class="relative">
                            <select id="unit_id" v-model="form.unit_id" name="unit_id" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                <option>Select a unit</option>
        <!--                        <option v-for="(unit, index) in units" :key="index" :value="unit.id">{{ unit.name }}</option>-->
                            </select>
                        </div>
                    </div>
                    <div class="p-2 w-full">
                        <div class="relative">
                            <label for="occupation" class="leading-7 text-sm text-gray-600">Occupation</label>
                            <input type="text" v-model="form.occupation" id="occupation" name="occupation" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                    </div>
                    <div class="p-2 w-full my-6">
                        <button @click="editDetails" class="flex text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">
                            Edit
                        </button>
                    </div>

                </div>
            </div>
        </div>

        <hr class="bg-gray-300 my-12">

        <div class="container px-5 py-2 mx-auto">
            <div class="flex items-center justify-center w-3/4 mx-auto rounded-md mb-12 border-2 border-red-500" v-show="error">
                <h1 class="sm:text-2xl text-xl font-medium title-font text-red-500">{{error}}</h1>
            </div>
            <div class="flex flex-col w-full mb-12">
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Change Password</h1>
            </div>
            <div class="p-2 w-3/4">
                <div class="relative flex flex-col lg:flex-row w-3/4">
                    <label class="leading-7 lg:w-1/4 text-sm text-gray-600">Old Password:</label>
                    <input type="password" v-model="password_form.old" name="password_old" class=" w-3/4 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                </div>
            </div>
            <div class="p-2 w-3/4">
                <div class="relative flex flex-col lg:flex-row w-3/4">
                    <label class="leading-7 lg:w-1/4 text-sm text-gray-600">New Password:</label>
                    <input type="password" v-model="password_form.new" name="password" class=" w-3/4 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                </div>
            </div>
            <div class="p-2 w-3/4">
                <div class="relative flex flex-col lg:flex-row w-3/4">
                    <label class="leading-7 lg:w-1/4 text-sm text-gray-600">Confirm Password:</label>
                    <input type="password" v-model="password_form.confirmation" name="password_confirmation" class=" w-3/4 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                </div>
            </div>
            <div class="p-2 w-full my-6">
                <button @click="changePassword" class="flex text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">
                    Change
                </button>
            </div>
        </div>


    </section>


</template>

<script>
import base_url from "../baseUrl";

export default{
    name: 'EditProfile',
    mounted() {
    },
    data(){
        return {
            form:{
                first_name:'',
                last_name:'',
                email:'',
                national_id:'',
                phone:'',
                occupation:''
            },
            password_form: {
                old:'',
                new:'',
                confirmation:''
            },
            error: ''
        }
    },
    methods:{
        validate(){
            let form_fields = ['first_name', 'last_name', 'national_id', 'email', 'unit_id' ]
            for (var i = 0; i < form_fields.length; i++) {
                if( this.form[ form_fields[i] ] == '' ) {
                    this.errors.push("Error: Entry needs at least first name, last name, national id, email and unit id.")
                    window.location = '#top'
                    return false;
                }
            }

            if( (isNaN( parseInt(this.form['phone']) ) ) ){
                this.errors.push("Error: Phone needs to be a number.")
                window.location = '#top'
                return false;
            }

            if( (isNaN( parseInt(this.form['national_id']) )) ){
                this.errors.push("Error: National_id needs to be a number.")
                window.location = '#top'
                return false;
            }

            return true;

        },
        editDetails() {
            this.errors = []
            if (!this.validate()) {
                return
            }

            axios({
                method: 'put',
                url: base_url + '/api/tenants/' + this.$route.params.id,
                data: this.form,
                headers: {
                    Authorization: 'Bearer ' + window.localStorage.getItem('token')
                }
            }).then((response) => {
                console.log(response.data)
                this.$swal('Success', response.data['message'])
            }).catch((err) => {
                console.log(err.response.data)
                this.$swal('Error', err.response.data['message'])
                if (err.response.data['errors']) {
                    console.log(err.response.data)
                    this.errors = Object.values(err.response.data['errors'])[0]
                    window.location = '#top'
                    return
                }
            })
        },

        change_password(){
            if( !this.password_form.new.length ){
                this.error = "'New Password' field is empty"
                return
            }
            if ( !this.password_form.old.length ){
                this.error = "'Old Password' field is empty"
                return
            }
            if ( this.password_form.confirmation.length ){
                this.error = "'Password Confirmation' field is empty"
                return
            }

            axios({
                method: 'post',
                url: base_url + '/api/users/' + this.$route.params.id + '/change-password',
                data: this.form,
                headers: {
                    Authorization: 'Bearer ' + window.localStorage.getItem('token')
                }
            }).then((response) => {
                console.log(response.data)
                this.$swal('Success', response.data['message'])
            }).catch((err) => {
                console.log(err.response.data)
                this.$swal('Error', err.response.data['message'])
                if (err.response.data['errors']) {
                    console.log(err.response.data)
                    this.errors = Object.values(err.response.data['errors'])[0]
                    window.location = '#top'
                    return
                }
            })
}
    }
}
</script>

<style>

</style>
