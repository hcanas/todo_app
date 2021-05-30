<template>
    <div class="flex flex-col">
        <div class="flex justify-between items-center pb-2 border-b">
            <h1 class="text-xl">Tasks</h1>
            <div class="flex items-center space-x-2">
                <form>
                    <input type="search" @input="findTask($event.target.value)" placeholder="Filter Tasks" class="border p-1.5 rounded text-sm focus:outline-none focus:ring-1">
                </form>
                <a href="#" @click="$emit('addTask')" class="text-sm text-white bg-green-700 hover:bg-green-500 p-1.5 rounded">
                    <span class="hidden lg:inline">Add task</span>
                    <span class="lg:hidden">
                        <i class="fas fa-plus"></i>
                    </span>
                </a>
            </div>
        </div>

        <task v-if="list_copy.length > 0" v-for="task in list_copy" :key="task.id" :task="task" @done="doneTask" @delete="deleteTask"></task>
        <div v-else class="text-sm text-gray-500 bg-gray-100 flex justify-center p-4 rounded my-1">No tasks to be displayed.</div>
    </div>
</template>

<script>
    import Task from "./Task";

    export default {
        name: "TaskList",
        components: {
            Task,
        },
        props: {
            list: Object,
        },
        data() {
            return {
                list_copy: this.list,
            }
        },
        methods: {
            findTask(keyword) {
                this.list_copy = this.list;

                if (keyword && Object.keys(this.list_copy).length > 0) {
                    this.list_copy = this.list_copy.filter(item => {
                        return item.title.includes(keyword)
                            || item.description.includes(keyword)
                            || item.status.includes(keyword);
                    });
                }
            },
            doneTask(id) {
                this.$emit('doneTask', id);
            },
            deleteTask(id) {
                this.$emit('deleteTask', id);
            },
        },
        computed: {
            origList() {
                return this.list;
            },
        },
        watch: {
            origList(new_val, old_val) {
                this.list_copy = this.list;
            },
        },
    }
</script>

<style scoped>

</style>
