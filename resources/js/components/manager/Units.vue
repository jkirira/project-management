<template>

    <div class="my-24">
        <div class="flex flex-wrap -m-4">
            <template v-if="unitData.data">
                <div v-for="(unit, index) in unitData.data" :key=index class="p-4 md:w-1/3">
                    <router-link :to="{name: 'unit_details', params: {project_id: $route.params.id , unit_id: unit.id} }">
                        <div class="flex rounded-lg h-full bg-gray-100 p-8 flex-col">
                            <div class="flex items-center mb-3">
                                <div class="w-8 h-8 mr-3 inline-flex items-center justify-center rounded-full bg-green-500 text-white flex-shrink-0">
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                        <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                                    </svg>
                                </div>
                                <h2 class="text-gray-900 text-lg title-font font-medium">{{ unit.name }}</h2>
                            </div>
                        </div>
                    </router-link>
                </div>
            </template>
        </div>

        <template v-if="unitData.data">
            <div class="pagination-wrapper">
                <Pagination :data="unitData" class="pagination" :align="'center'"  @pagination-change-page="getResults">
                    <span slot="prev-nav">&lt; Previous</span>
                    <span slot="next-nav">Next &gt;</span>
                </Pagination>
            </div>
        </template>

        <template v-else>
            <div class="p-4 md:w-1/3">
                This project has no units
            </div>
        </template>
    </div>

</template>

<script>
import base_url from "../../baseUrl";
import LaravelVuePagination from 'laravel-vue-pagination';

export default{
    name: "Units",
    data(){
        return {
            unitData: {}
        }
    },
    components: {
        'Pagination': LaravelVuePagination
    },
    mounted(){
        this.getResults();
    },
    methods:{
        getResults(page = 1) {
            axios({
                method: 'get',
                url: base_url + '/api/projects/' + this.$route.params.id + '/units?page=' + page,
                headers: {
                    Authorization: 'Bearer ' + window.localStorage.getItem('token')
                }
            }).then((response) =>{
                console.log(response.data)
                this.unitData = response.data
            }) .catch((err) => {
                console.log(err)
            })
        }
    }
}

</script>

<style>
.pagination-wrapper {
    text-align: center;
}

.pagination {
    display: inline-block;
    margin: 30px 0;
}

.pagination li {
    color: black;
    float: left;
    text-decoration: none;
    box-sizing: border-box;
    margin: 0 5px;
}

.pagination li > a {
    padding: 8px 16px;
    display: inline-block;
}

.pagination li.active {
    background-color: #4CAF50;
    color: white;
}

.pagination li:hover:not(.active) {background-color: #ddd;}
</style>
