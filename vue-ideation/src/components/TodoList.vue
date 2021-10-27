<template lang="">
    <div>
        <form @submit.prevent="addTask" >
            <div class="grid grid-cols-12 gap-2">
                <input type="text" class="col-span-6 block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500  focus:outline-none focus:ring" placeholder="Add Task">
                <button class="col-span-2 block items-center p-2 text-sm text-gray-600 bg-white border border-transparent rounded-md focus:border-blue-500 focus:ring-opacity-40  focus:ring-blue-300 dark:focus:ring-blue-400 focus:ring focus:outline-none">
                <span class="mx-1">Jane Doe</span>
                <svg class="w-5 h-5 mx-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 15.713L18.01 9.70299L16.597 8.28799L12 12.888L7.40399 8.28799L5.98999 9.70199L12 15.713Z" fill="currentColor"></path>
                </svg>
            </button>
                <input type="date" class=" col-span-2 block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500  focus:outline-none focus:ring" >
                <button type="submit" class="c-btn-primary col-span-1">Add Task</button>
                
            </div>
        </form>
    </div>
</template>
<script>
export default {
    name: 'TodoList',
    data() {
        return {
            task: {

            }
        }
    },
    methods: {
        addTask() {

        }
    }
    
}
</script>
<style lang="">
    
</style>