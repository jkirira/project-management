<template>

    <div class="flex flex-grow p-6 mt-8 overflow-auto">
        <div class="w-2/3">
            <section class="text-gray-600 body-font overflow-hidden">
                <div class="container px-5 py-24 mx-auto">
                    <div class="mb-5 border-b-2 border-grey-200">
                        <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">Issues</h1>
                    </div>

                    <div class="my-6 divide-y-2 divide-gray-100">

                        <template v-if="user_issues.length > 0">

                            <div v-for="(issue, index) in user_issues" class="py-8 px-4 flex flex-col flex-wrap md:flex-nowrap my-2 border border-gray-100">

                                <div class="md:flex-grow">
                                    <router-link :to="{ name: 'issue_details', params: { id: issue.id } }" >
                                        <h2 class="text-2xl font-medium text-gray-900 title-font mb-2">{{ issue.title }}</h2>
                                    </router-link>
                                    <p class="leading-relaxed">
                                        {{ issue.body }}
                                    </p>
                                </div>
                                <div class="md:w-64 md:mb-0 mt-6 flex-shrink-0 flex flex-col">
                                    <span class="font-semibold text-gray-700">{{ issue.created_at }}</span>
                                    <span class="mt-1 text-gray-500 text-sm">{{ issue.replies_count }} replies</span>
                                </div>
                            </div>
                        </template>

                        <template v-else>
                            <div class="py-8 flex flex-wrap md:flex-nowrap border-b-2 border-grey-200">
                                <h1 class="text-xl title-font font-medium mt-3 mb-1">You have not created any Issues.</h1>
                            </div>
                        </template>

                    </div>
                </div>
            </section>
        </div>

        <div class="flex-grow p-6 mt-8 overflow-auto w-1/3">
            <div class="flex flex-col flex-wrap -mb-10 lg:text-left text-center">
                <div class="flex flex-col mb-10 lg:items-start items-center">
                    <div class="mb-5">
                        <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">Unresolved Issues</h1>
                        <span class="text-gray-600 ml-3">34 Issues</span>
                    </div>
                    <div class="flex-grow">
                        <a class="mt-3 text-indigo-500 inline-flex items-center">
                            <p class="leading-relaxed text-base">Blue bottle crucifix vinyl post-ironic four dollar toast vegan taxidermy. Gastropub indxgo juice poutine.</p>
                        </a>
                        <a class="mt-3 text-indigo-500 inline-flex items-center">
                            <p class="leading-relaxed text-base">Blue bottle crucifix vinyl post-ironic four dollar toast vegan taxidermy. Gastropub indxgo juice poutine.</p>
                        </a>
                        <a class="mt-3 text-indigo-500 inline-flex items-center">
                            <p class="leading-relaxed text-base">Blue bottle crucifix vinyl post-ironic four dollar toast vegan taxidermy. Gastropub indxgo juice poutine.</p>
                        </a>
                        <a class="mt-3 text-indigo-500 inline-flex items-center">
                            <p class="leading-relaxed text-base">Blue bottle crucifix vinyl post-ironic four dollar toast vegan taxidermy. Gastropub indxgo juice poutine.</p>
                        </a>
                        <a class="mt-3 text-indigo-500 inline-flex items-center">
                            <p class="leading-relaxed text-base">Blue bottle crucifix vinyl post-ironic four dollar toast vegan taxidermy. Gastropub indxgo juice poutine.</p>
                        </a>
                    </div>
                </div>
                <div class="flex flex-col mb-10 lg:items-start items-center">
                    <div class="mb-5">
                        <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">Resolved Issues</h1>
                        <span class="text-gray-600 ml-3">34 Issues</span>
                    </div>
                    <div class="flex-grow">
                        <a class="mt-3 text-indigo-500 inline-flex items-center">
                            <p class="leading-relaxed text-base">Blue bottle crucifix vinyl post-ironic four dollar toast vegan taxidermy. Gastropub indxgo juice poutine.</p>
                        </a>
                        <a class="mt-3 text-indigo-500 inline-flex items-center">
                            <p class="leading-relaxed text-base">Blue bottle crucifix vinyl post-ironic four dollar toast vegan taxidermy. Gastropub indxgo juice poutine.</p>
                        </a>
                        <a class="mt-3 text-indigo-500 inline-flex items-center">
                            <p class="leading-relaxed text-base">Blue bottle crucifix vinyl post-ironic four dollar toast vegan taxidermy. Gastropub indxgo juice poutine.</p>
                        </a>
                        <a class="mt-3 text-indigo-500 inline-flex items-center">
                            <p class="leading-relaxed text-base">Blue bottle crucifix vinyl post-ironic four dollar toast vegan taxidermy. Gastropub indxgo juice poutine.</p>
                        </a>
                        <a class="mt-3 text-indigo-500 inline-flex items-center">
                            <p class="leading-relaxed text-base">Blue bottle crucifix vinyl post-ironic four dollar toast vegan taxidermy. Gastropub indxgo juice poutine.</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>


    </div>


</template>

<script>
import {mapGetters} from "vuex";
import base_url from "../baseUrl.js";

export default{
    name: 'HomeComponent',
    data(){
        return {
            user_issues: [],
        }
    },
    computed:{
        ...mapGetters([
            'userDetails'
        ])
    },
    mounted() {
        axios({
            method: 'get', //you can set what request you want to be
            url: base_url + '/api/issues/by/'+this.userDetails.id,
            headers: {
                Authorization: 'Bearer ' + window.localStorage.getItem('token')
            }
            }).then((response) =>{
                    console.log(response.data)
                    this.user_issues = response.data
                }) .catch((err) => {
                    console.log(err)
                })
    }
}
</script>

<style></style>
