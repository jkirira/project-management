import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const localstorage_user = JSON.parse(window.localStorage.getItem('user'))
const store = new Vuex.Store({
    state: {
        user: localstorage_user ? localstorage_user : {},
        token: (window.localStorage.getItem('token')) ? window.localStorage.getItem('token') : null ,
        loading: false,
    },

    getters: {
        getToken(state){
            return state.token
        },
        userDetails(state){
            return state.user;
        },
        isLoggedIn(state) {
            return (state.token) ? true : false;
        },
        isAdmin(state){
            return state.user.is_admin
        },
    },


    mutations: {
        setToken(state, payload) {
            state.token = payload
        },
        setUser(state, payload) {
            state.user = payload
        },
        resetUser(state) {
            state.user = (window.localStorage.getItem('user')) ? window.localStorage.getItem('user') : {}
            state.token = (window.localStorage.getItem('token')) ? window.localStorage.getItem('token') : null
        },
        logIn(state){
            state.loggedIn = true
        },
        logOut(state){
            state.loggedIn = false
        },

    },


    actions: {
        set_token (context, payload) {
            context.commit('setToken', payload)
        },
        set_user (context, payload) {
            context.commit('setUser', payload)
        },
        reset_user(context){
            context.commit('resetUser');
        },
        log_in(context){
            context.commit('logIn')
        },
        log_out(context){
            context.commit('logOut')
        },
    }
})

export default store;
