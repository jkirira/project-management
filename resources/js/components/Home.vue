<template>

    <div class="flex flex-grow p-6 mt-8 overflow-auto">
        <div class="w-2/3">
            <section class="text-gray-600 body-font overflow-hidden">
                <div class="container px-5 py-24 mx-auto">
                    <div class="mb-5">
                        <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">Issues</h1>
                    </div>

                    <div class="-my-8 divide-y-2 divide-gray-100">

                        <div class="py-8 flex flex-wrap md:flex-nowrap">

                            <div class="md:flex-grow">
                                <h2 class="text-2xl font-medium text-gray-900 title-font mb-2">Meditation bushwick direct trade taxidermy shaman</h2>
                                <p class="leading-relaxed">Glossier echo park pug, church-key sartorial biodiesel vexillologist pop-up snackwave ramps cornhole. Marfa 3 wolf moon party messenger bag selfies, poke vaporware kombucha lumbersexual pork belly polaroid hoodie portland craft beer.</p>
                                <a class="text-indigo-500 inline-flex items-center mt-4">Learn More
                                    <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14"></path>
                                        <path d="M12 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                            <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
                                <span class="mt-1 text-gray-500 text-sm">12 Jun 2019</span>
                                <span class="font-semibold title-font text-gray-700">CATEGORY</span>
                            </div>
                        </div>

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

export default{
    name: 'HomeComponent',
    data(){
        return {}
    },
    computed:{
        ...mapGetters([
            'userDetails'
        ])
    },
    mounted() {
        axios({
            method: 'get', //you can set what request you want to be
            url: 'http://project-management.appp/api/issues/by/'+this.userDetails.id,
            headers: {
                Authorization: 'Bearer ' + window.localStorage.getItem('token')
            }
            }).then((response) =>{
                    console.log(response.data)
                }) .catch((err) => {
                    console.log(err)
                })
    }
}
</script>

<style></style>
