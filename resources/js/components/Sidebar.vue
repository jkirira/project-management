<template>

    <div id="sidebar" class="sidebar flex-col border-r border-gray-300ss">
        <div class="flex items-center justify-between w-full h-16 px-4 border-b border-gray-300 hover:bg-gray-300">
        </div>
        <div class="flex flex-col flex-grow p-4 overflow-auto">

            <span v-for="(route, index) in sidebar_routes" class="flex items-center flex-shrink-0 h-10 px-2 text-sm font-medium rounded hover:bg-gray-300" >
                <router-link :to="{ name: route.to }"><span class="leading-none">{{ route.name }}</span></router-link>
            </span>

        </div>

    </div>
</template>

<script>
export default{
    name: 'SidebarComponent',
    props: ['sidebar_routes']
}
</script>

<style>

</style>
