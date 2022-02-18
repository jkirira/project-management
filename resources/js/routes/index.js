import Vue from 'vue'
import VueRouter from "vue-router";
import LoginComponent from "../components/LoginComponent.vue";
import LayoutComponent from "../components/Layout.vue";
import AddTenant from "../components/manager/AddTenant.vue";
import Units from "../components/manager/Units.vue";
import UnitDetails from "../components/manager/UnitDetails.vue";
import HomeComponent from "../components/Home.vue";
import AddIssue from "../components/tenant/AddIssue.vue";

Vue.use(VueRouter);

import store from "../store";
import AdminHome from "../components/manager/AdminHome";

const routes = [
    {
        path: '/login',
        component: LoginComponent,
        name: 'login',
        beforeEnter: (to, from, next) => {
            console.log(store.getters.isLoggedIn)
            if ( store.getters.isLoggedIn ) next(false)
            else next()
        },
    },
    {
        path: '/',
        component: LayoutComponent,
        beforeEnter: (to, from, next) => {
            console.log(store.getters.isLoggedIn)
            if ( !store.getters.isLoggedIn ) next( {name: 'login'} )
            else next()
        },
        children: [
            {
                path: 'home',
                component: HomeComponent,
                name: 'home',
                beforeEnter: (to, from, next) => {
                    if ( store.getters.userDetails.role_id > 1 ) next( {name: 'admin_home'} )
                    else next()
                },
            },
            {
                path: 'management/home',
                component: AdminHome,
                name: 'admin_home',
                beforeEnter: (to, from, next) => {
                    if ( store.getters.userDetails.role_id < 2 ) next( false )
                    else next()
                },
            },
            {
                path: 'units',
                component: Units,
                name: 'units',
                beforeEnter: (to, from, next) => {
                    if ( store.getters.userDetails.role_id < 2 ) next( false )
                    else next()
                },
            },
            {
                path: 'units/details',
                component: UnitDetails,
                name: 'unit_details',
                beforeEnter: (to, from, next) => {
                    if ( store.getters.userDetails.role_id < 2 ) next( false )
                    else next()
                },
            },
            {
                path: 'add-tenant',
                component: AddTenant,
                name: 'add_tenant',
                beforeEnter: (to, from, next) => {
                    console.log(store.getters.userDetails.role_id < 2 || !store.getters.isLoggedIn)
                    if ( store.getters.userDetails.role_id < 2 || !store.getters.isLoggedIn ) next( false )
                    else next()
                },
            },
            {
                path: 'add-issue',
                component: AddIssue,
                name: 'add_issue',
                beforeEnter: (to, from, next) => {
                    if ( store.getters.userDetails.role_id > 1 || !store.getters.isLoggedIn ) next( false )
                    else next()
                },
            },
        ]
    },

]


const router = new VueRouter({
    routes,
    mode: 'history',
})

export default router;

