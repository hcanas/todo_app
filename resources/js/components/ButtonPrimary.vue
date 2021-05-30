<template>
    <button class="px-2 py-1 text-white bg-green-700 hover:bg-green-500 focus:outline-none focus:ring-1 focus:bg-green-500 rounded">
        <slot></slot>
    </button>
</template>

<script>
    export default {
        name: "ButtonPrimary",
    }
</script>

<style scoped>

</style>
