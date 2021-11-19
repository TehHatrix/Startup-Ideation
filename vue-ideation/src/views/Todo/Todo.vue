<template lang="">
    <div>
        <section class="container">
            <!-- form add task  -->
            <div>
                <form @submit.prevent="addTask">

                </form>
            </div>

            <!-- display task -->
            <div class="card-white">
                <div v-for="task in tasks" :key="task.id">
                    <task 
                    :task="task" 
                    :collab="project.collaborator"
                    :projectId="project.id"
                    @todoStatusChanged="updateTaskStatus($event)" ></task>
                </div>
            </div>
            <!-- test -->
            <!-- <div>
                <table class="c-tb">
                    <tr>
                        <th>input</th>
                        <th>task</th>
                        <th>collab</th>
                    </tr>
                    <tr v-for="(task, index) in tasks" :key="index">
                        <td><input type="checkbox" v-model="task.completed" name="" id=""></td>
                        <td>{{task.task}}</td>
                        <td>{{task.assigned_to}}</td>
                    </tr>
                </table>
            </div> -->
        </section>
    </div>
</template>
<script>
import {mapGetters} from 'vuex'
import Task from '@/components/Task.vue'
import api from '@/api/todoApi'

export default {
    name: 'Todo',
    
    data() {
        return {
        }
    },

    async created() {
        try {
            await this.$store.dispatch('getTodos', this.$route.params.projectId)
        } catch (error) {
            console.log(error)
        }
    },

    components: {
        'task': Task,
    },

    computed: {
        ...mapGetters([
            'tasks',
            'project'
        ])
    },

    methods: {
        async addTask() {

        },

        async updateTaskStatus(task) {
            try {

                const updatedTask = {
                    'task': task.task,
                    'assigned_to': task.assigned_to,
                    'due_date': task.due_date,
                    'completed': task.completed
                }

                let { data } = await api.updateTask({
                    'projectId': this.project.id,
                    'taskId': task.id
                }, updatedTask)

                console.log(data.task)

                if(data.success) { 
                    await this.$store.dispatch('getTodos', this.$route.params.projectId)
                } else {
                    console.log('task not updated')
                }
            } catch(errors) {
                console.log(errors)
            }
        }


    }
}
</script>
<style scoped>

</style>