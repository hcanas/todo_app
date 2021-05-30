<template>
    <div class="flex flex-col">
        <div class="flex justify-between items-center pb-2 border-b">
            <h1 class="text-xl">History</h1>
            <form>
                <input type="search" @input="findTask($event.target.value)" placeholder="Filter Tasks" class="border p-1.5 rounded text-sm focus:outline-none focus:ring-1">
            </form>
        </div>

        <task v-if="history_copy.length > 0" v-for="task in history_copy" :key="task.id" :task="task" @restore="restoreTask"></task>
        <div v-else class="text-sm text-gray-500 bg-gray-100 flex justify-center p-4 rounded my-1">No tasks to be displayed.</div>
    </div>
</template>

<script>
    import Task from "./Task";

    export default {
        name: "TaskHistory",
        components: {
            Task,
        },
        props: {
            history: Object,
        },
        data() {
            return {
                history_copy: this.history,
            }
        },
        methods: {
            findTask(keyword) {
                this.history_copy = this.history;

                if (keyword && Object.keys(this.history_copy).length > 0) {
                    this.history_copy = this.history_copy.filter(item => {
                        return item.title.includes(keyword)
                            || item.description.includes(keyword)
                            || item.status.includes(keyword);
                    });
                }
            },
            restoreTask(id) {
                this.$emit('restoreTask', id);
            },
        },
        computed: {
            origHistory() {
                return this.history;
            },
        },
        watch: {
            origHistory(new_val, old_val) {
                this.history_copy = this.history;
            },
        },
    }
</script>

<style scoped>

</style>
