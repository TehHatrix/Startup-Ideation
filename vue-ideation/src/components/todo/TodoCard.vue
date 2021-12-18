<template lang="">
    <div>
        <div class="todo-card">
            <table >
                <thead>
                    <tr>
                        <th class="t-center"><font-awesome-icon icon="fa-check-double"></font-awesome-icon></th>
                        <th colspan="3" class="t-center">Task</th>
                        <th>Assigned To</th>
                        <th>Due Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(task, index) in tasks" :key="index"  >
                        <td v-if="!task.completed" class="t-center"><input type="checkbox" @change="setComplete(task)" v-model="task.completed" ></td>
                        <td v-if="!task.completed" colspan="3" >{{ task.task }}</td>
                        <td v-if="!task.completed" >
                            <span v-if="task.assigned_to === null">Everyone</span>
                            <div v-for="(user, index) in project.collaborator" :key="index">
                                <span v-if="user.id === task.assigned_to">{{ user.name }}</span>
                            </div>
                        </td>
                        <td v-if="!task.completed" >{{ task.due_date === null ? 'no due date' : task.due_date }}</td>
                        <td v-if="!task.completed" class="action-container">
                            <span class="edit" @click="openUpdateModal">
                                <font-awesome-icon  icon="fa-pen"></font-awesome-icon>
                            </span>
                            <span class="trash" @click="openDeleteModal(task)">
                                <font-awesome-icon  icon="trash-alt"></font-awesome-icon>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- confirm delete modal -->
        <modal 
         :showModal="showConfirmModal"
         @close="closeDeleteModal">
            <h2>Confirm Delete</h2>
            <div class="btn-container">
                <button class="c-btn-primary-outline" @click="closeDeleteModal" >Cancel</button>
                <button class="c-btn-danger" @click="deleteTask" >Delete</button>
            </div>
        </modal>

        <!-- update Modal -->
        <modal
         :showModal="showUpdateModal"
         @close="showUpdateModal = false">
            <h2>Update Task</h2>
            <form @submit.prevent="">
                <div class="input-container">
                    <input type="text" id="task" v-model="taskForm.task">                    
                </div>
                <div>
                    
                </div>
            </form>
        </modal>
    </div>
</template>
<script>
import ProjectModalVue from '../ProjectModal.vue'
import api from '@/api/todoApi'
import { mapGetters } from 'vuex'

export default {
    name: 'TodoCard',

    props: ['project', 'user'],
    computed: {
        ...mapGetters([
            'tasks'
        ]),
    },

    components: {
        'modal': ProjectModalVue
    },

    data() {
        return {
            showConfirmModal: false,
            tempTask: null,

            showUpdateModal: false,
            taskForm: {
                task: '',
                due_date: null,
                assigned_to: null,
            },
        }
    },

    methods: {
        async setComplete(task) {
            try {
                let res = await api.updateTask(this.project.id, task.id, task )                
                if(res.data.success) {
                    await this.$store.dispatch('getTodos', this.project.id)
                } else {
                    console.table(res.data.errors)
                }
            } catch (error) {
                console.log(error)
            }
        },

        async deleteTask() {
            try {
                let { data } = await api.deleteTask(this.project.id, this.tempTask.id)
                if(data.success) {
                    await this.$store.dispatch('getTodos', this.project.id)
                    this.closeDeleteModal()
                } else {
                    console.log(data)
                }
            } catch (error) {   
                console.log(error)
            }
        },

        openUpdateModal(task) {
            this.taskForm.task = task.task
            this.taskForm.due_date = task.due_date
            this.taskForm.assigned_to = task.assigned_to
            this.showUpdateModal = true
        }, 
        
        closeUpdateModal() {
            this.showUpdateModal = false
            this.taskForm.task = ''
            this.taskForm.due_date = null
            this.taskForm.assigned_to = null
        },

        openDeleteModal(task) {
            this.tempTask = task
            this.showConfirmModal = true
        },

        closeDeleteModal() {
            this.showConfirmModal = false
            this.tempTask = null
        }
        
    },
    
}
</script>
<style lang="scss" scoped>
    .todo-card {
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 0 40px rgb(0 0 0 / 5%);
        height: 30rem;
        max-height: 30rem;
        padding: 2rem 1rem;
        overflow: scroll;
    }
    
    .t-center {
        text-align: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
        border: 1px solid white;
        th {
            background-color: #14213d;   
            color: #fff;
            padding: .5rem .5rem;
            font-weight: 500;
            text-align: left;
        }
    }

    td {
        padding: .7rem .5rem;
        border-bottom: .5px solid rgb(0, 0, 0, .8);
    }

    .action-container {
        text-align: left;
    }

    .edit {
        background: #68b288;
        color: #fff;
        padding: .3rem .3rem;
        border-radius: 8px;
        font-size: 1rem;
        margin-right: 1rem;
        cursor: pointer;
    }
    .trash {
        background: #FF5677;
        color: #fff;
        padding: .3rem .3rem;
        border-radius: 8px;
        font-size: 1rem;
        cursor: pointer;
    }

    .btn-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
</style>