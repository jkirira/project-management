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

                <div  class="p-2 w-full">
                    <div class="relative flex flx-col md:flex-row">
                        <p>Rating:</p>
                        <p class="px-3">{{ (issue.rating) ? issue.rating.value : ''  }}</p>
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

                <template v-if="userDetails.role_id == 1">

                    <div v-if="issue.status != 'unanswered'" class="p-2 w-full">

                        <button @click="resolve_issue" class="flex my-4 text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">
                            Mark as {{ (issue.status == 'resolved') ? 'Unresolved' : 'Resolved' }}
                        </button>

                        <button v-if="issue.status == 'resolved'" @click="open_modal" class="flex my-4 text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">
                            Rate
                        </button>
                    </div>

                </template>

            </div>
        </div>

        <rating-form-component @closeModal="close_modal" :show_modal="show" :issue_id="issue.id"></rating-form-component>

        <section v-if="issue.rating" class="text-gray-600 body-font border-b-2 border-gray-200">
            <div class="container px-5 py-24 mx-auto">
                <h1 class="text-2xl font-medium title-font text-gray-900 mb-6">Rating</h1>
                <div class="flex flex-wrap flex-col -m-4">

                    <star-rating :rating="issue.rating.value" :read-only="true" :border-width="3" :padding="10" ></star-rating>

                    <div class="text-gray-600 body-font">
                        <div class="flex flex-wrap my-4 mx-2">

                            <div class="h-full w-3/4 my-2 bg-gray-100 p-8 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="block w-5 h-5 text-gray-400 mb-4" viewBox="0 0 975.036 975.036">
                                    <path d="M925.036 57.197h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.399 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l36 76c11.6 24.399 40.3 35.1 65.1 24.399 66.2-28.6 122.101-64.8 167.7-108.8 55.601-53.7 93.7-114.3 114.3-181.9 20.601-67.6 30.9-159.8 30.9-276.8v-239c0-27.599-22.401-50-50-50zM106.036 913.497c65.4-28.5 121-64.699 166.9-108.6 56.1-53.7 94.4-114.1 115-181.2 20.6-67.1 30.899-159.6 30.899-277.5v-239c0-27.6-22.399-50-50-50h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.4 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l35.9 75.8c11.601 24.399 40.501 35.2 65.301 24.399z"></path>
                                </svg>
                                <p class="leading-relaxed mb-6">{{ issue.rating.comment }}</p>
                                <span class="flex-grow flex flex-col pl-4">
                                  <span class="title-font font-medium text-gray-900">Created at: </span>
                                  <span class="title-font font-medium text-gray-900">{{ issue.rating.created_at }}</span>
                                </span>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>


        <section class="text-gray-600 body-font border-b-2 border-gray-200">
            <div class="container px-5 py-24 mx-auto">
                <h1 class="text-2xl font-medium title-font text-gray-900 mb-6">Replies</h1>
                <div class="flex flex-wrap flex-column -m-4">

                    <template v-if="replies.length > 0">
                        <div v-for="(reply, index) in replies" :key="index" class="mx-2 p-4 w-full">
                            <div class="h-full bg-gray-100 p-8 rounded">
                                <p class="leading-relaxed mb-6 ">
                                    {{ reply.body }}
                                </p>
                                <span class="flex flex-col md:inline-flex border-t-2 border-gray-300">
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
import StarRating from 'vue-star-rating';
import {mapGetters} from "vuex";

export default {
    name: 'Issue',
    components: {
        RatingFormComponent,
        StarRating
    },
    computed:{
        ...mapGetters([
            'userDetails'
        ])
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
                this.issue = response.data['issue']
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
            console.log(this.form);
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
