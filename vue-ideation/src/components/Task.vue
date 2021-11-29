<template lang="">
    <div>
    
        <div v-if="task.completed === false" >
            <div class="task-list" :class="task.completed ? 'line' : '' " >
                <input type="checkbox" v-model="task.completed" @change="changeStatusTodo" class="task-checkbox col-span-2" >
                <span id="task" >{{ task.task }}</span>
                <span>{{ task.due_date ? task.due_date : ' ' }}</span>
                <div v-for="(user, index) in collab" :key="index" >
                    <span v-if="user.id === task.assigned_to" >{{user.name}}</span>
                </div>
                <div>
                    <button @click="showUpdateModal = true" >
                        <font-awesome-icon icon="edit" class="update-button" ></font-awesome-icon>
                    </button>
                    <button @click="deleteTodo" >
                        <font-awesome-icon icon="trash-alt"></font-awesome-icon>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- update modal  -->
        <div>
            <update-modal
            :showModal="showUpdateModal"
            @close="showUpdateModal = false" >

                <h1>Update Task</h1>
                <form @submit.prevent="updateTask" >
                    <input type="text" v-model="updatedTaskForm.task" >
                    <select v-model="updatedTaskForm.assigned_to" >
                        <option v-for="(collaborator, index) in project.collaborator" :key="index" :value="collaborator.id" >{{ collaborator.name }}</option>
                    </select>
                    <input v-model="updatedTaskForm.due_date" type="date" >
                    <button type="submit">update task</button>
                </form>
            </update-modal>
        </div>  

    </div>
</template>
<script>
import api from '@/api/todoApi'
import ProjectModal from '@/components/ProjectModal.vue'
import {mapGetters} from 'vuex'

export default {
    name: 'Task',
    props: {
        task: Object, 
        collab: Array,
        projectId: Number
    },

    components: {
        'update-modal': ProjectModal
    },

    data() {
        return {
            params: {
                projectId: this.$route.params.id,
                taskId: this.task.id,
            },

            updatedTask: {
                task: this.task.task,
            },

            showUpdateModal: false,

            updatedTaskForm: {
                task: this.task.task,
                assigned_to: this.task.assigned_to,
                due_date: this.task.due_date,
                completed: false
            }
        }
    },

    methods: {
        async changeStatusTodo() {
            try {
                let taskForm = this.updatedTaskForm
                taskForm.completed = true
                let {data} = await api.updateTask(this.params, taskForm)
                if(data.success) {
                    this.$store.dispatch('getTodos', this.project.id)
                }
            } catch (error) {
                console.log(error)
            }
        },

        async deleteTodo() {
            // this.$emit('deleteTodo', this.task)
            try {
                let {data} = await api.deleteTask(this.params)
                if(data.success) {
                    console.log(this.task.id + ' is deleted successfully')
                    this.$store.dispatch('getTodos', this.params.projectId)
                }
            } catch (error) {
                console.log(error)
            }
        },

        async updateTask() {
            try {
                let {data} = await api.updateTask(this.params, this.updatedTaskForm)
                if(data.success) {
                    this.$store.dispatch('getTodos', this.project.id)
                    this.showUpdateModal = false
                }
            } catch (error) {
                console.log(error)
            }
        }
    },

    computed: {
        ...mapGetters([
            'project'
        ])
    }

}
</script>
<style lang="css" scoped>
    .test {
        display: flex;
        gap: 0.5rem;
    }

    .task-list {
        display: flex;
        justify-content: space-between;
        border-bottom: 1px solid #ccc;
        padding: 0.5rem 0.5rem;
        flex: 1 1 0px
    }

    .task-checkbox {
        margin-right: 1rem;
    }

    .task-list > #task {
        text-align: center;
    }

    .line {
        text-decoration: line-through;
    }

    .task-topic {
        background: #634d9a;
        border-radius: 20px;
        box-shadow: 30px 30px 30px 0px #dcd7e8;
    }
</style>