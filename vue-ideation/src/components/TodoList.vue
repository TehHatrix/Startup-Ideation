<template lang="">
    <div>
        <form @submit.prevent="addTask" >
            <input type="text" v-model="form.task" >
            <select v-model="form.assigned_to" >
                <option v-for="(collaborator, index) in project.collaborator" :key="index" :value="collaborator.id" >{{ collaborator.name }}</option>
            </select>
            <input v-model="form.due_date" type="date" >
            <button type="submit">create task</button>
        </form>
        <!-- {{tasks}} -->
        <div class="overflow-scroll">
            <div v-for="(task, index) in tasks" :key="index" >
                <task :task="task" :collab="project.collaborator" >

                </task>

            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters } from 'vuex'
import api from '@/api/todoApi'
import Task from './Task.vue'

export default {
    name: 'TodoList',

    components: {
        'task': Task
    },

    props: {
        project: Object,
    },

    data() {
        return {
            form: {
                task: '',
                due_date: null,
                assigned_to: null
            },

            projectId: this.$route.params.id

        }
    },

    async created() {
        try {
            await this.$store.dispatch('getTodos', this.projectId)
        } catch (error) {
            console.log(error)
        }
    }, 

    methods: {
        async addTask() {
            try {
                let {data} = await api.addTask(this.project.id, this.form)
                if(data.success) {
                    await this.$store.dispatch('getTodos', this.project.id)
                } 
            } catch(error) {
                console.log(error)
            }
        }
    },
    computed: {
        ...mapGetters(['user', 'tasks'])
    }
    
}
</script>
<style lang="css" scoped>
    .overflow-scroll {
        overflow: auto;
        max-height: 15rem;
    }
</style>