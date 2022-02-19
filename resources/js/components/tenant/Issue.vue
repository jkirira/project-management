<template>

    <div class="container px-5 py-24 mx-auto">

        <div class="mx-16 border-b-2 border-gray-200">
            <div class="flex flex-wrap -m-2">
                <div class="p-2 w-full">
                    <div class="relative flex flex-col md:flex-row justify-between items-center">
                        <h1 class="text-4xl font-medium title-font text-gray-900 mb-8">
                            {{ issue.title }}
                        </h1>
                        <strong :class="(issue.status == 'resolved') ? 'border-green-500 bg-green-500' : 'border-red-500 bg-red-500' " class="border  text-sm text-white  uppercase px-5 py-1.5 mx-2 rounded-full tracking-wide">
                            {{ issue.status }}
                        </strong>
                    </div>
                </div>
                <div class="p-2 w-full">
                    <div class="relative">
                        <p class="text-xl font-medium mb-12">
                            {{ issue.body }}
                        </p>
                    </div>
                    <div class="relative">
                        <p class="text-xl font-medium mb-12">
                            {{ issue.created_at }}
                        </p>
                    </div>
                </div>

                <div v-if="issue.status != 'unanswered'" class="p-2 w-full">

                    <button @click="resolve_issue" class="flex my-4 text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">
                        Mark as {{ (issue.status == 'resolved') ? 'Unresolved' : 'Resolved' }}
                    </button>

                    <button @click="open_modal" class="flex my-4 text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">
                        Rate
                    </button>
                </div>

            </div>
        </div>

        <rating-form-component @closeModal="close_modal" :show_modal="show" :issue_id="issue.id"></rating-form-component>


        <section class="text-gray-600 body-font border-b-2 border-gray-200">
            <div class="container px-5 py-24 mx-auto">
                <h1 class="text-2xl font-medium title-font text-gray-900 mb-6">Replies</h1>
                <div class="flex flex-wrap flex-column -m-4">

                    <template v-if="replies.length > 0">
                        <div v-for="(reply, index) in replies" :key="index" class="mx-2 p-4 w-full">
                            <div class="h-full bg-gray-100 p-8 rounded">
                                <p class="leading-relaxed mb-6">
                                    {{ reply.body }}
                                </p>
                                <span class="flex flex-col md:inline-flex">
                                <span class="flex-grow flex flex-col">
                                  <span class="title-font font-medium text-gray-900">{{ reply.owner.first_name + " " + reply.owner.last_name }}</span>
                                </span>
                                <span class=" flex-grow flex flex-col md:pl-4">
                                  <span class="text-gray-500 text-sm">{{ reply.created_at }}</span>
                                </span>
                            </span>
                            </div>
                        </div>
                    </template>

                    <template v-else>
                        <div class="p-2 mx-2 w-full">
                            <div class="relative">
                                <p class="text-xl font-medium text-gray-900 mb-12">
                                    There are no replies
                                </p>
                            </div>
                        </div>
                    </template>

                </div>
            </div>
        </section>

        <section class="text-gray-600 body-font relative border-b border-gray-200">
            <div class="container px-5 py-20 mx-auto">
                <div class="flex flex-col w-full mb-6">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Reply</h1>
                </div>
                <div class="lg:w-3/4 md:w-2/3 ">

                    <div class="flex items-center justify-center w-3/4 mx-auto rounded-md mb-12 border-2 border-red-500" v-show="error">
                        <h1 class="sm:text-2xl text-xl font-medium title-font text-red-500">{{error}}</h1>
                    </div>

                    <div class="flex flex-wrap -m-2">
                        <div class="p-2 w-full">
                            <div class="relative">
                                <label for="message" class="leading-7 text-sm text-gray-600">Message</label>
                                <textarea v-model="form.body" id="message" name="message" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                            </div>
                        </div>
                        <div class="p-2 w-full">
                            <button @click="saveReply" class="flex mx-auto text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">
                                Send
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </section>

    </div>

</template>

<script>
import base_url from "../../baseUrl.js";
import RatingFormComponent from "../RatingFormComponent.vue";

export default {
    name: 'Issue',
    components: {
        RatingFormComponent
    },
    data(){
        return {
            form:{
                body: ''
            },
            error: '',
            issue: '',
            show: false,
            replies: '',
            rating_value: 0,
            rating_comment: ''
        }
    },
    mounted(){
        axios({
            method: 'get',
            url: base_url + '/api/issues/' + this.$route.params.id,
            headers: {
                Authorization: 'Bearer ' + window.localStorage.getItem('token')
            }
            }).then((response) =>{
                console.log(response.data)
                this.issue = response.data
                this.replies = this.issue.replies
            }) .catch((err) => {
                console.log(err)
            })
    },
    methods: {
        validate(){
            if( this.form.body =='' ) {
                this.error = "Please fill the message"
                return false;
            }
            return true;
        },

        close_modal(){
            this.show = false;
        },

        open_modal(){
            this.show = true;
        },

        resolve_issue(){
            axios({
                method: 'post',
                url: base_url + '/api/issues/' + this.issue.id + '/resolve',
                data: {'resolve': this.issue.status !== 'resolved' },
                headers: {
                    Authorization: 'Bearer ' + window.localStorage.getItem('token')
                }
            }) .then((response) => {
                console.log(response)
                this.$swal('Success', response.data['message'])
            }) .catch((err) => {
                console.log(err)
                this.$swal('Error', err.response.data['message'])
            })
        },

        saveReply(){
            this.error = null

            if( !this.validate() ){
                return
            }

            axios({
                method: 'post',
                url: base_url + '/api/issues/' + this.issue.id + '/replies',
                data: this.form,
                headers: {
                    Authorization: 'Bearer ' + window.localStorage.getItem('token')
                }
            }).then((response) => {
                    console.log(response.data)
                    this.$swal('Success', response.data['message']);
                    console.log(response.data['reply'])
                    this.replies.unshift(response.data['reply'])
                    return
                }) .catch((err) => {
                    this.error = err.response.data['message']
                    window.location = '#top';
                    return
                })
        },

    }
}
</script>
