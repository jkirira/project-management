<template>

    <section class="text-gray-600 body-font">
        <div class="container mx-auto flex px-5 flex-col">
            <div class="lg:flex-grow lg:pr-24 md:pr-16 py-12 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center border-b-2 border-gray-200 text-center">
                <h1 class="title-font sm:text-3xl text-2xl mb-4 font-medium text-gray-900">
                    Unit Name: &ensp;&ensp;{{ unit.name }}
                </h1>
            </div>
            <div class="py-12 border-b-2 border-gray-200">
                <h1 class="title-font sm:text-3xl text-2xl mb-4 font-medium text-gray-900">
                    Tenant Details
                </h1>
                <template v-if="unit.tenant">
                    <div class="flex flex-col justify-center">
                        <p class="">Name: <span class="">{{ unit.tenant.user.first_name + unit.tenant.user.first_name }}</span></p>
                        <p class="">National ID<span class="">{{ unit.tenant.user.national_id }}</span></p>
                        <p class="">Phone:<span class="">{{ unit.tenant.user.phone }}</span></p>
                        <p class="">Email:<span class="">{{ unit.tenant.user.email }}</span></p>
                        <p class="">Date Joined:<span class="">{{ unit.tenant.user.created_at }}</span></p>
                    </div>
                </template>
                <template v-else>
                    <div class="flex justify-center">
                        <p>This unit has no tenant</p>
                    </div>
                </template>

            </div>

            <div class="py-12 border-b-2 border-gray-200">
                <h1 class="title-font sm:text-3xl text-2xl mb-4 font-medium text-gray-900">
                    Financial Records
                </h1>
                <template v-if="unit.tenant" class="">
                    <div class="flex flex-col justify-center">
                        <p class="">Name: <span class=""></span></p>
                        <p class="">National ID<span class=""></span></p>
                        <p class="">Phone:<span class=""></span></p>
                        <p class="">Email:<span class=""></span></p>
                        <p class="">Date Joined:<span class=""></span></p>
                    </div>
                </template>
                <template v-else>
                    <div class="flex justify-center">
                        <p>This unit has no tenant</p>
                    </div>
                </template>

            </div>

            <div class="py-12 border-b-2 border-gray-200">
                <h1 class="title-font sm:text-3xl text-2xl mb-4 font-medium text-gray-900">
                    Issues
                </h1>
                <template v-if="unit.tenant">
                    <div class="flex flex-col justify-center">
                        <p class="">Issues Logged: <span class=""></span></p>
                        <p class="my-6">Views Issues -></p>
                    </div>
                </template>
                <template v-else>
                    <div class="flex justify-center">
                        <p>This unit has no tenant</p>
                    </div>
                </template>

            </div>

        </div>
    </section>

</template>

<script>
import base_url from "../../baseUrl";

export default{
    name: "UnitDetails",
    data(){
        return {
            unit: ''
        }
    },
    mounted(){
        axios({
            method: 'get',
            url: base_url + '/api/units/' + this.$route.params.unit_id,
            headers: {
                Authorization: 'Bearer ' + window.localStorage.getItem('token')
            }
        }).then((response) =>{
            console.log(response.data)
            this.unit = response.data
        }) .catch((err) => {
            console.log(err)
        })
    }
}
</script>
