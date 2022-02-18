<template>
    <div>
        <div class="flex flex-col lg:flex-row w-screen h-full text-gray-700 relative">

            <!-- Component Start -->

            <sidebar-component class="w-2/12" :sidebar_routes="sidebarRoutes"></sidebar-component>

            <div class="w-10/12">

                <router-view></router-view>

            </div>

            <!-- Component End  -->

        </div>
    </div>
</template>

<script>
import SidebarComponent from "./Sidebar";
import {mapActions, mapGetters} from "vuex";
export default {
    components: {SidebarComponent},
    data(){
        return{}
    },
    mounted() {
        const SideBar = document.getElementById('sidebar')
        const SideBarToggle = document.getElementById('sidebarToggle')
        SideBarToggle.addEventListener('click', () => {
            let sidebar_display = SideBar.style.display
            console.log(sidebar_display)
            if(sidebar_display != "none"){
                SideBar.style.display = "none"
            } else {
                SideBar.style.display = "flex"
                // NavBar.style.display = "flex"
            }
        })
    },
    computed: {
        ...mapGetters([
            "userDetails"
        ]),
        sidebarRoutes(){
            if ( this.userDetails.role_id == 1 ) {
                return [
                    {'name':'My Issues', 'to' : 'home'},
                    {'name':'Add Issues', 'to' : 'add_issue'},
                    {'name':'My Issues', 'to' : ''},
                ]
            } else if ( this.userDetails.role_id > 1 ){
                return [
                    {'name':'My Issues', 'to' : 'admin_home'},
                    {'name':'Active Issues', 'to' : ''},
                    {'name':'Resolved Issues', 'to' : ''},
                    {'name':'View Units', 'to' : 'units'},
                    {'name':'Add Tenant', 'to' : 'add_tenant'},
                ]
            } else {
               return []
            }
        }
    },
    methods: {}
}
</script>

<style>
.sidebar{
    display: none;
    position: absolute;
    z-index: 9999;
    background: #ffffff;
    border: 1px solid lightgrey;

}
@media screen and (min-width: 1024px){
    .sidebar{
        display: flex;
        position: relative;
    }
    .sidebarToggle{
        display: none;
    }
}
</style>
