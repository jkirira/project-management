<template>

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex items-center border-b pb-10 border-gray-200 flex-col lg:flex-row">
                <div class="sm:w-32 sm:h-32 h-20 w-20 sm:mr-16 inline-flex items-center justify-center rounded-full bg-green-100 text-green-500 flex-shrink-0">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="sm:w-16 sm:h-16 w-10 h-10" viewBox="0 0 24 24">
                        <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>
                <div class="flex-grow sm:text-left text-center mt-6 sm:mt-0">
                    <h2 class="text-gray-900 text-lg title-font font-medium mb-2">User Profile</h2>
                </div>
            </div>

            <router-view></router-view>

        </div>
    </section>


</template>

<script>

</script>

<style>

</style>
