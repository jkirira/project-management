<template>
    <section class="text-gray-600 body-font relative">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex items-center justify-center w-3/4 mx-auto rounded-md mb-12 border-2 border-red-500" v-show="error">
                <h1 class="sm:text-2xl text-xl font-medium title-font text-red-500">{{error}}</h1>
            </div>
            <div class="flex flex-col w-full mb-12">
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Submit an Issue</h1>
                <p class="lg:w-2/3 leading-relaxed text-base">One of our managers will respond to you as soon as possible</p>
            </div>
            <div class="lg:w-1/2 md:w-2/3">
                <div class="flex flex-wrap -m-2">
                    <div class="p-2 w-full">
                        <div class="relative">
                            <label for="title" class="leading-7 text-sm text-gray-600">Title</label>
                            <input v-model="form.title" type="text" id="title" name="title" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                    </div>
                    <div class="p-2 w-full">
                        <div class="relative">
                            <label for="message" class="leading-7 text-sm text-gray-600">Message</label>
                            <textarea v-model="form.body" id="message" name="message" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                        </div>
                    </div>
                    <div class="p-2 w-full">
                        <button @click="createIssue" class="flex mx-auto text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">
                            Send
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </section>
</template>

<script>
import store from "../../store";
import base_url from "../../baseUrl.js";

export default {
    data(){
        return {
            form:{
                title:'',
                body: ''
            }
        }
    },
    methods:{
        validate(){
            if( this.form.title=='' ){
                this.error = "Please fill the title"
                return false;
            }

            if( this.form.body =='' ) {
                this.error = "Please fill the message"
                return false;
            }
            return true;
        },

        createIssue(){
            this.error = null
            if( !this.validate() ){
                return
            }

            axios.post(base_url + '/api/issues', this.form )
                .then((response) => {
                    console.log(response.data)
                    this.$swal('Success', response.data['message']);
                    return
                }) .catch((err) => {
                    this.error = err.response.data['message']
                    window.location = '#top';
                    return
                })
        }
    }
}

</script>

<style>

</style>


