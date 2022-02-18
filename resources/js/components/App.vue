<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <router-link :to="{ name: 'home' }" class="navbar-brand"
            >Laravel-Vue SPA</router-link
            >
            <button
                class="navbar-toggler"
                data-toggle="collapse"
                data-target="#navbarCollapse"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbarCollapse" class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <router-link
                            class="nav-link"
                            data-toggle="collapse"
                            :to="{ name: 'home' }"
                        >
                            Home
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link
                            class="nav-link"
                            data-toggle="collapse"
                            :to="{ name: 'about' }"
                        >
                            About
                        </router-link>
                    </li>
                    <li @click="logout" class="nav-item">
                        Logout
                    </li>
                </ul>
            </div>
        </nav>

        <div>
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import store from "../store";
import base_url from "../baseUrl.js";

export default {

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
                    window.localStorage.removeItem('token');
                    window.localStorage.removeItem('user');
                    console.log('Logged out')
                    store.dispatch("log_out")
                    store.dispatch("set_token", null)
                    store.dispatch("set_user", null)
                    this.$swal('success', response.data['message'])
                    window.location = '/login'
            }).catch((err) => {
                    console.log(err.response.data)
                })
        }
    }
};
</script>
