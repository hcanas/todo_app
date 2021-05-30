<template>
    <div class="flex p-2 my-1 bg-gray-50 border rounded relative">
        <div class="flex-grow flex flex-col">
            <span class="font-medium">{{ task.title }}</span>
            <span class="italic">{{ task.description }}</span>
            <span :class="`text-xs uppercase ${task.status}`">{{ task.status }}</span>
        </div>
        <div class="flex-shrink flex flex-col justify-evenly items-center">
            <a v-if="task.status === 'pending'" href="#" @click="$emit('done', task.id)" class="text-xs text-green-700 hover:text-green-500" title="Mark as Done">
                <i class="fas fa-check"></i>
            </a>
            <a v-if="task.status === 'pending'" href="#" @click="$emit('delete', task.id)" class="text-xs text-red-700 hover:text-red-500" title="Delete">
                <i class="fas fa-times"></i>
            </a>
            <a v-if="task.status !== 'pending'" href="#" @click="$emit('restore', task.id)" class="text-xs text-green-700 hover:text-green-500" title="Undo">
                <i class="fas fa-undo"></i>
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Task",
        props: {
            task: Object,
        },
    }
</script>

<style scoped>
    .pending {
        @apply text-yellow-500
    }

    .done {
        @apply text-green-500
    }

    .deleted {
        @apply text-red-500
    }
</style>
