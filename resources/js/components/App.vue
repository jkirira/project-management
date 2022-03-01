<template>
    <div class="h-full">
        <nav class="flex flex-col md:flex-row justify-between relative bg-green-500 align-center py-6">
            <div class="nav-item p-4 mx-2 hover:bg-white hover:text-green-500">
                <router-link :to="{ name: 'home' }" class="navbar-brand">Project Management</router-link>
            </div>
<!--            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">-->
<!--                <span class="navbar-toggler-icon"></span>-->
<!--            </button>-->
            <div id="navbarCollapse" class="collapse navbar-collapse">
                <ul class="navbar-nav flex">
                    <li class="nav-item p-4 mx-2 hover:bg-white hover:text-green-500">
                        <router-link v-if="isLoggedIn" class="nav-link" data-toggle="collapse" :to="{ name: 'home' }">
                            {{ userDetails.first_name[0].toUpperCase() + ". " + userDetails.last_name }}
                        </router-link>
                    </li>

                    <div v-if="isLoggedIn">
                        <li @click="logout" class="nav-item p-4 mx-2 hover:bg-white hover:text-green-500">
                            Logout
                        </li>
                    </div>

                    <div v-else>
                        <li class="nav-item p-4 mx-2 hover:bg-white hover:text-green-500">
                            <router-link class="nav-link" data-toggle="collapse" :to="{ name: 'login' }">
                                Login
                            </router-link>
                        </li>
                    </div>

                </ul>
            </div>
        </nav>

        <div class="h-full">
            <router-view></router-view>
        </div>

    </div>
</template>

<script>
import store from "../store";
import base_url from "../baseUrl.js";
import {mapGetters} from "vuex";

export default {

    computed: {
        ...mapGetters([
            "userDetails",
            'isLoggedIn'
        ]),
    },

    methods: {
        logout(){
            axios({
                method: 'post',
                url: base_url + '/api/logout',
                headers: {
                    Authorization: 'Bearer ' + window.localStorage.getItem('token')
                }
            }).then((response) => {
                    console.log(response.data['message'])
                    store.dispatch("log_out")
                    store.dispatch("set_token", null)
                    store.dispatch("set_user", null)
            }).catch((err) => {
                console.log(err.response.data)
                this.$swal('success', "There was an error logging out. Please try logging in again.")
            }).then(() => {
                window.localStorage.removeItem('token');
                window.localStorage.removeItem('user');
                console.log('Logged out')
                window.location = '/login'
            })
        }
    }
};
</script>
