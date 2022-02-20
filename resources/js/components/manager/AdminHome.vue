<template>

    <div class="flex flex-grow p-6 mt-8 overflow-auto">
        <div class="w-full">
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

    </div>

</template>

<script>
import {mapGetters} from "vuex";
import base_url from "../../baseUrl.js";

export default{
    name: 'HomeComponent',
    data(){
        return {
            issues: ''
        }
    },
    computed:{
        ...mapGetters([
            'userDetails'
        ])
    },
    mounted() {
        axios({
            method: 'get',
            url: base_url + '/api/issues/manager/' + this.userDetails.id,
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
