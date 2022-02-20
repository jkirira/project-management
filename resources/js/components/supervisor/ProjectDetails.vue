<template>

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex items-center border-b pb-10 border-gray-200 flex-col lg:flex-row">
                <div class="sm:w-32 sm:h-32 h-20 w-20 sm:mr-16 inline-flex items-center justify-center rounded-full bg-green-100 text-green-500 flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                         width="30" height="30"
                         viewBox="0 0 50 50"
                         style=" fill:#000000;">
                        <path d="M 24.962891 1.0546875 A 1.0001 1.0001 0 0 0 24.384766 1.2636719 L 1.3847656 19.210938 A 1.0005659 1.0005659 0 0 0 2.6152344 20.789062 L 4 19.708984 L 4 46 A 1.0001 1.0001 0 0 0 5 47 L 18.832031 47 A 1.0001 1.0001 0 0 0 19.158203 47 L 30.832031 47 A 1.0001 1.0001 0 0 0 31.158203 47 L 45 47 A 1.0001 1.0001 0 0 0 46 46 L 46 19.708984 L 47.384766 20.789062 A 1.0005657 1.0005657 0 1 0 48.615234 19.210938 L 41 13.269531 L 41 6 L 35 6 L 35 8.5859375 L 25.615234 1.2636719 A 1.0001 1.0001 0 0 0 24.962891 1.0546875 z M 25 3.3222656 L 44 18.148438 L 44 45 L 32 45 L 32 26 L 18 26 L 18 45 L 6 45 L 6 18.148438 L 25 3.3222656 z M 37 8 L 39 8 L 39 11.708984 L 37 10.146484 L 37 8 z M 20 28 L 30 28 L 30 45 L 20 45 L 20 28 z">
                        </path>
                    </svg>
                </div>
                <div class="flex-grow sm:text-left text-center mt-6 sm:mt-0">
                    <h2 class="text-gray-900 text-lg title-font font-medium mb-2">Project: {{ project.name }}</h2>
                    <h2>
                        Manager: {{ (project.manager) ? project.manager.first_name + ' ' + project.manager.last_name : 'none' }}
                    </h2>
                    <h2>Units: {{ project.units_count }}</h2>
                </div>
            </div>

            <div v-if="!project.manager" class="flex items-center border-b pb-10 border-gray-200 flex-col lg:flex-row">
                <div v-if="error" class="flex items-center justify-center mx-auto rounded-md p-3 mb-12 border-2 border-red-500" v-show="error">
                    <h1 class="sm:text-2xl text-xl font-medium title-font text-red-500">{{error}}</h1>
                </div>
                <div class="p-2 w-3/4 my-5">
                    <h2>Assign a manager</h2>
                    <div class="relative">
                        <select id="manager_id" v-model="form.manager_id" name="manager_id" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            <option>Assign a manager</option>
                            <option v-for="(manager, index) in managers" :key="index" :value="manager.id">{{ manager.name }}</option>
                        </select>
                    </div>
                </div>
                <div class="p-2 w-full my-6">
                    <button @click="assignManager" class="flex text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">
                        Assign
                    </button>
                </div>
            </div>

            <div v-else class="flex items-center border-b pb-10 border-gray-200 flex-col lg:flex-row">
                <div class="p-2 w-full my-6">
                    <button v-on:click="removeManager" class="flex text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">
                        Remove Manager
                    </button>
                </div>
            </div>

            <router-view></router-view>

        </div>
    </section>

</template>

<script>
import base_url from "../../baseUrl";

export default{
    name: "ProjectDetails",
    data(){
        return {
            project: '',
            managers: '',
            form: {
                manager_id: '',
            },
            error:''
        }
    },
    mounted(){
        axios({
            method: 'get',
            url: base_url + '/api/projects/' + this.$route.params.id,
            headers: {
                Authorization: 'Bearer ' + window.localStorage.getItem('token')
            }
        }).then((response) =>{
            // console.log(response.data)
            this.project = response.data
        }) .catch((err) => {
            console.log(err)
        });

        axios({
            method: 'get',
            url: base_url + '/api/managers',
            headers: {
                Authorization: 'Bearer ' + window.localStorage.getItem('token')
            }
        }).then((response) =>{
            // console.log(response.data)
            this.managers = response.data
        }) .catch((err) => {
            console.log(err)
        })
    },
    methods: {
        validate() {
            if (!this.form.manager_id || this.form.manager_id == '') {
                this.errors.push("Error: Manager value is empty")
                window.location = '#top'
                return false;
            }
        },

        assignManager() {
            if(!this.validate()){
                return
            }

            this.error = ''
            axios({
                method: 'post',
                url: base_url + '/projects/' + this.project.id + '/manager',
                data: this.form,
                headers: {
                    Authorization: 'Bearer ' + window.localStorage.getItem('token')
                }
            }).then((response) => {
                // console.log(response.data)
                this.$swal('Success', "Successfully assigned project")
                this.project = response.data
            }).catch((err) => {
                console.log(err)
                this.error = "Error, could not assign this project."
            })
        },

        removeManager() {
            this.error = ''
            axios({
                method: 'delete',
                url: base_url + '/projects/' + this.project.id + '/manager',
                headers: {
                    Authorization: 'Bearer ' + window.localStorage.getItem('token')
                }
            }).then((response) => {
                // console.log(response.data)
                this.$swal('Success', "Successfully assigned project")
                this.project = response.data
            }).catch((err) => {
                console.log(err)
                this.error = "Error, could not assign this project."
            })
        }
    }
}
</script>

<style></style>
