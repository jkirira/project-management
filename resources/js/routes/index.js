import Vue from 'vue'
import VueRouter from "vue-router";
import LoginComponent from "../components/LoginComponent.vue";
import LayoutComponent from "../components/Layout.vue";
import AddTenant from "../components/manager/AddTenant.vue";
import Units from "../components/manager/Units.vue";
import UnitDetails from "../components/manager/UnitDetails.vue";
import HomeComponent from "../components/Home.vue";
import AddIssue from "../components/tenant/AddIssue.vue";
import Issue from "../components/tenant/Issue.vue";
import Profile from "../components/Profile.vue"
import Projects from "../components/supervisor/Projects.vue"
import ProjectDetails from "../components/supervisor/ProjectDetails.vue"

Vue.use(VueRouter);

import store from "../store";
import AdminHome from "../components/manager/AdminHome";
import ViewProfile from "../components/ViewProfile.vue";
import EditProfile from "../components/EditProfile.vue";

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
            if (!store.getters.isLoggedIn) next({name: 'login'})
            else next()
        },
        children: [
            {
                path: '',
                component: HomeComponent,
                name: 'home',
                beforeEnter: (to, from, next) => {
                    if (store.getters.userDetails.role_id > 1) next({name: 'admin_home'})
                    else next()
                },
            },
            {
                path: 'add-issue',
                component: AddIssue,
                name: 'add_issue',
                beforeEnter: (to, from, next) => {
                    if (store.getters.userDetails.role_id > 1 || !store.getters.isLoggedIn) next(false)
                    else next()
                },
            },
            {
                path: 'issue/:id',
                component: Issue,
                name: 'issue_details',
                beforeEnter: (to, from, next) => {
                    if (!store.getters.isLoggedIn) next(false)
                    else next()
                },
            },
            {
                path: 'profile',
                component: Profile,
                children: [
                    {
                        path: '/:id',
                        component: ViewProfile,
                        name: 'view_profile',
                        beforeEnter: (to, from, next) => {
                            if (!store.getters.isLoggedIn) next(false)
                            else next()
                        },
                    },
                    {
                        path: '/:id/edit',
                        component: EditProfile,
                        name: 'edit_profile',
                        beforeEnter: (to, from, next) => {
                            if ( !store.getters.isLoggedIn ) next( false )
                            else next()
                        },
                    }
                ]
            },
        ]
    },
    {
        path: '/management',
        component: LayoutComponent,
        beforeEnter: (to, from, next) => {
            if ( store.getters.userDetails.role_id < 2 ) next( false )
            else next()
        },
        children: [
            {
                path: '/',
                component: AdminHome,
                name: 'admin_home',
            },
            {
                path: '/projects',
                component: Projects,
                name: 'projects'
            },
            {
                path: '/projects/:id/units',
                component: ProjectDetails,
                children: [
                    {
                        path: '/',
                        component: Units,
                        name: 'units',
                    },
                    {
                        path: '/projects/:project_id/units/:unit_id',
                        component: UnitDetails,
                        name: 'unit_details',
                    },
                ]
            },

            {
                path: '/add-tenant',
                component: AddTenant,
                name: 'add_tenant',
            },
        ]
    },

]


const router = new VueRouter({
    routes,
    mode: 'history',
})

export default router;

