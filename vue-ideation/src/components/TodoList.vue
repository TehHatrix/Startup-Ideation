<template lang="">
    <div>
        <form @submit.prevent="addTask" >
            <div class="grid grid-cols-5 form-todo">
                <input type="text" v-model="form.task" placeholder="Add Task" class="col-span-2" >
                <select v-model="form.assigned_to" >
                    <option v-for="(collaborator, index) in project.collaborator"  :key="index" :value="collaborator.id" >{{ collaborator.name }}</option>
                </select>
                <input v-model="form.due_date" type="date" >
                <button type="submit">create task</button>
            </div>
        </form>
        <!-- {{tasks}} -->
        <div class="overflow-scroll">
            <div v-for="(task, index) in tasks" :key="index" >
                    <task 
                    :task="task" 
                    :collab="project.collaborator"
                    :projectId="project.id"
                    @todoStatusChanged="updateTaskStatus($event)" ></task>
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
                    this.form.task = ''
                    this.form.due_date = null
                    this.form.assigned_to = null
                } 
            } catch(error) {
                console.log(error)
            }
        },

    },
    computed: {
        ...mapGetters(['user', 'tasks'])
    }
    
}
</script>
<style lang="scss" scoped>
    .overflow-scroll {
        overflow: auto;
        max-height: 15rem;
    }

    .form-todo {
        margin: 0.5rem 0px;

        input{
            padding: 0.25rem 0.10rem;
        }
    }


    
    
</style>