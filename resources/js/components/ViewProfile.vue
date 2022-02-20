<template>

    <section class="w-full pt-20">

        <div>
            <h2 class="font-sans font-bold break-normal text-gray-700 px-2 pb-8 text-xl">User Details</h2>

            <div class="p-8 mt-6 lg:mt-0 leading-normal rounded shadow bg-white">
                <p><span class="px-4">First Name:</span>{{ user.first_name }}</p>
                <p><span class="px-4">Last Name:</span>{{ user.last_name }}</p>
                <p><span class="px-4">National Id:</span>{{ user.national_id }}</p>
                <p><span class="px-4">Phone: </span>{{ user.phone }}</p>
                <p><span class="px-4">Email: </span>{{ user.email }}</p>
            </div>

            <hr class="bg-gray-300 my-12">
        </div>

        <div>
            <h2 class="font-sans font-bold break-normal text-gray-700 px-2 pb-8 text-xl">Financial History</h2>

            <div class="p-8 mt-6 lg:mt-0 leading-normal rounded shadow bg-white">
            </div>

            <hr class="bg-gray-300 my-12">
        </div>


    </section>

</template>

<script>
import base_url from "../baseUrl";
import {mapGetters} from "vuex";

export default {
    name: "ViewProfile",
    data(){
        return{
            user: ''
        }
    },
    computed: {
        ...mapGetters([
            "userDetails"
        ]),
    },
    mounted(){
        axios({
            method: 'get',
            url: base_url +'/api/users/' + this.userDetails.id,
            headers: {
                Authorization: 'Bearer ' + window.localStorage.getItem('token')
            }
        }).then((response) =>{
            console.log(response.data)
            this.user = response.data
        }) .catch((err) => {
            console.log(err)
        })
    },

    methods: {

    }
}
</script>
