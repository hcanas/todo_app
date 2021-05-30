<template>
    <div class="w-full h-full flex flex-col lg:flex-row space-y-4 lg:space-x-4 lg:space-y-0 p-6 lg:p-12 bg-gray-200">
        <div class="w-full lg:w-1/2 h-1/2 lg:h-full bg-white p-4 rounded overflow-y-auto">
            <task-list v-if="list !== null" :list="list" @add-task="show_modal = true" @done-task="doneTask" @delete-task="deleteTask"></task-list>
        </div>
        <div class="w-full lg:w-1/2 h-1/2 lg:h-full bg-white p-4 rounded overflow-y-auto">
            <task-history v-if="history !== null" :history="history" @restore-task="restoreTask"></task-history>
        </div>
    </div>
    <modal v-if="show_modal" @close="show_modal = false">
        <form>
            <div class="flex flex-col my-2">
                <form-label>Title</form-label>
                <form-input type="text" :value="form_data.title" @input="form_data.title = $event.target.value"></form-input>
            </div>

            <div class="flex flex-col my-2">
                <form-label>Description</form-label>
                <form-input type="text" :value="form_data.description" @input="form_data.description = $event.target.value"></form-input>
            </div>

            <div class="flex space-x-2 my-2">
                <button-secondary type="button" @click="show_modal = false" :class="`w-1/2`">Cancel</button-secondary>
                <button-primary type="button" @click="addTask" :class="`w-1/2`">Save</button-primary>
            </div>
        </form>
    </modal>
</template>

<script>
    import TaskList from "./components/TaskList";
    import TaskHistory from "./components/TaskHistory";
    import FormLabel from "./components/FormLabel";
    import FormInput from "./components/FormInput";
    import ButtonSecondary from "./components/ButtonSecondary";
    import ButtonPrimary from "./components/ButtonPrimary";
    import Modal from "./components/Modal";

    export default {
        name: "App",
        components: {
            Modal,
            ButtonPrimary,
            ButtonSecondary,
            FormInput,
            FormLabel,
            TaskHistory,
            TaskList,
        },
        data() {
            return {
                list: null,
                history: null,
                show_modal: false,
                form_data: {
                    title: '',
                    description: '',
                },
            }
        },
        async created() {
            axios.get('/api/tasks')
                .then(response => this.list = response.data)
                .catch(error => this.list = {});

            axios.get('/api/history')
                .then(response => this.history = response.data)
                .catch(error => this.history = {});
        },
        methods: {
            addTask() {
                axios.post(`/api/tasks`, this.form_data)
                    .then(response => {
                        this.show_modal = false;

                        if (Object.keys(this.list).length > 0) {
                            this.list.unshift(response.data);
                        } else {
                            this.list = [response.data];
                        }
                    })
                    .catch(error => {});
            },
            doneTask(id) {
                const task = this.list.filter(task => task.id === id);

                axios.put(`/api/tasks/${task[0].id}`, { status: 'done' })
                    .then(response => {
                        task[0].status = 'done';
                        this.list = this.list.filter(task => task.id !== id);

                        if (Object.keys(this.history).length > 0) {
                            this.history.unshift(task[0]);
                        } else {
                            this.history = task;
                        }
                    })
                    .catch(error => {});
            },
            deleteTask(id) {
                const task = this.list.filter(task => task.id === id);

                axios.put(`/api/tasks/${task[0].id}`, { status: 'deleted' })
                    .then(response => {
                        task[0].status = 'deleted';
                        this.list = this.list.filter(task => task.id !== id);

                        if (Object.keys(this.history).length > 0) {
                            this.history.unshift(task[0]);
                        } else {
                            this.history = task;
                        }
                    })
                    .catch(error => {});
            },
            restoreTask(id) {
                const task = this.history.filter(task => task.id === id);

                axios.put(`/api/tasks/${task[0].id}`, { status: 'pending' })
                    .then(response => {
                        task[0].status = 'pending';
                        this.history = this.history.filter(task => task.id !== id);

                        if (Object.keys(this.list).length > 0) {
                            this.list.unshift(task[0]);
                        } else {
                            this.list = task;
                        }
                    })
                    .catch(error => {});
            },
        },
    }
</script>

<style scoped>

</style>
