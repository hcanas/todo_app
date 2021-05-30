<template>
    <div class="absolute inset-0 top-0">
        <div class="absolute inset-0 bg-gray-900 opacity-90"></div>
        <div class="absolute inset-0 flex justify-center items-center">
            <div class="w-11/12 lg:w-96 bg-white rounded">
                <div class="flex justify-between items-center p-2 bg-gray-700 rounded-t">
                    <h1 class="text-white font-medium">Task Details</h1>
                    <button type="button" @click="$emit('close')" class="focus:outline-none focus:ring-1">
                        <i class="fas fa-times text-white hover:text-gray-300"></i>
                    </button>
                </div>

                <div class="flex flex-col p-4">
                    <slot></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Modal",
    }
</script>

<style scoped>

</style>
