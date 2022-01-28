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
                        <!-- <td class="t-center"><input type="checkbox" @change="setComplete(task)" v-model="task.completed" ></td> -->
                        <td>

                            <label class="c-toggle-switch" >
                                <input type="checkbox" class="c-toggle-checkbox" @change="setComplete(task)" v-model="task.completed" >
                                <span class="c-switch-btn"></span>
                            </label>    
                        </td>
                        <td colspan="3" >{{ task.task }}</td>
                        <td >
                            <span v-if="task.assigned_to === null">Everyone</span>
                            <div v-for="(user, index) in project.collaborator" :key="index">
                                <span v-if="user.id === task.assigned_to">{{ user.name }}</span>
                            </div>
                        </td>
                        <td>{{ task.due_date === null ? 'no due date' : task.due_date }}</td>
                        <td class="action-container">
                            <span class="edit" @click="openUpdateModal(task)">
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
            <form @submit.prevent="updateTask">
                <div class="input-container">
                    <input type="text" id="task" class="material-input" v-model="taskForm.task" required>                    
                    <label for="task" class="material-label" >Task</label>
                </div>
                <div class="select input-container">
                    <select class="select-text" v-model="taskForm.assigned_to" >
                        <option :value="null" selected>Everyone</option>

                        <option v-for="(user, index) in project.collaborator" :key="index" :value="user.id" >{{ user.name }}</option>
                    </select>

                    <span class="select-highlight"></span>
                    <span class="select-bar"></span>
                    <label  class="select-label">Assigned To</label>
                </div>
                <div class="input-container">
                    <input type="date" class="material-input" id="date" v-model="taskForm.due_date" >
                    <label for="date" class="material-label" >Date</label>
                </div>
                <div class="btn-container">
                    <button class="general-button">Submit</button>
                </div>
            </form>
        </modal>

        <!-- loading modal -->
        <loading-modal :showModal="loadingApi">

        </loading-modal>
    </div>
</template>
<script>
import ProjectModalVue from '../ProjectModal.vue'
import api from '@/api/todoApi'
import LoadingModalVue from '../LoadingModal.vue'
// import { mapGetters } from 'vuex'

export default {
    name: 'TodoCard',

    props: ['project', 'user', 'tasks'],
    computed: {
        // ...mapGetters([
        //     'tasks'
        // ]),
    },

    components: {
        'modal': ProjectModalVue,
        'loading-modal': LoadingModalVue
    },

    data() {
        return {
            showConfirmModal: false,
            tempTask: null,

            showUpdateModal: false,
            taskForm: {
                id: null,
                task: '',
                due_date: null,
                assigned_to: null,
                completed: false
            },

            projectId: this.$route.params.id,

            loadingApi: false,
        }
    },

    methods: {
        async setComplete(task) {
            try {
                this.loadingApi = true
                let res = await api.updateTask(this.projectId, task.id, task )        
                if(res.data.success) {
                    await this.$store.dispatch('getTodos', {projectId: this.projectId, userId: this.user.id})
                    this.loadingApi = false
                } 
            } catch (error) {
                console.log(error)
            } 
        },

        async deleteTask() {
            try {
                let { data } = await api.deleteTask(this.projectId, this.tempTask.id)
                if(data.success) {
                    await this.$store.dispatch('getTodos', {projectId: this.projectId, userId: this.user.id})
                    this.closeDeleteModal()
                } else {
                    console.log(data)
                }
            } catch (error) {   
                console.log(error)
            }
        },

        async updateTask() {
            try {
                let { data } = await api.updateTask(this.projectId, this.taskForm.id, this.taskForm)
                if(data.success) {
                    await this.$store.dispatch('getTodos', {projectId: this.projectId, userId: this.user.id})
                    this.closeUpdateModal()
                }
            } catch (error) {
                console.log(error)
            }
        },

        openUpdateModal(task) {
            this.taskForm.task = task.task
            this.taskForm.due_date = task.due_date
            this.taskForm.assigned_to = task.assigned_to
            this.taskForm.id = task.id
            this.showUpdateModal = true
            // console.table(this.taskForm)
        }, 
        
        closeUpdateModal() {
            this.showUpdateModal = false
            this.taskForm.task = ''
            this.taskForm.due_date = null
            this.taskForm.id = null
            this.taskForm.assigned_to = null
        },

        openDeleteModal(task) {
            this.tempTask = task
            this.showConfirmModal = true
        },

        closeDeleteModal() {
            this.showConfirmModal = false
            this.tempTask = null
        },



        
    },
    
}
</script>
<style lang="scss" scoped>
    .todo-card {
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 0 40px rgb(0 0 0 / 5%);
        height: 80vh;
        max-height: 80vh;
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

    /* select starting stylings ------------------------------*/
    .select {
        position: relative;
    }

    .select-text {
        position: relative;
        font-family: inherit;
        background-color: transparent;
        width: stretch;
        padding: 10px 10px 10px 0;
        font-size: 18px;
        border-radius: 0;
        border: none;
        border-bottom: 1px solid rgba(0,0,0, 0.12);
    }

    /* Remove focus */
    .select-text:focus {
        outline: none;
        border-bottom: 1px solid rgba(0,0,0, 0);
    }

        /* Use custom arrow */
    .select .select-text {
        appearance: none;
        -webkit-appearance:none
    }

    .select:after {
        position: absolute;
        top: 18px;
        right: 10px;
        /* Styling the down arrow */
        width: 0;
        height: 0;
        padding: 0;
        content: '';
        border-left: 6px solid transparent;
        border-right: 6px solid transparent;
        border-top: 6px solid rgba(0, 0, 0, 0.12);
        pointer-events: none;
    }


    /* LABEL ======================================= */
    .select-label {
        color: rgba(0,0,0, 0.5);
        font-size: 18px;
        font-weight: normal;
        position: absolute;
        pointer-events: none;
        left: 0;
        top: 10px;
        transition: 0.2s ease all;
    }

    /* active state */
    .select-text:focus ~ .select-label, .select-text:valid ~ .select-label {
        color: #2F80ED;
        top: -20px;
        transition: 0.2s ease all;
        font-size: 14px;
    }

    /* BOTTOM BARS ================================= */
    .select-bar {
        position: relative;
        display: block;
        width: stretch;
    }

    .select-bar:before, .select-bar:after {
        content: '';
        height: 2px;
        width: 0;
        bottom: 1px;
        position: absolute;
        background: #2F80ED;
        transition: 0.2s ease all;
    }

    .select-bar:before {
        left: 50%;
    }

    .select-bar:after {
        right: 50%;
    }

    /* active state */
    .select-text:focus ~ .select-bar:before, .select-text:focus ~ .select-bar:after {
        width: 50%;
    }

    /* HIGHLIGHTER ================================== */
    .select-highlight {
        position: absolute;
        height: 60%;
        width: stretch;
        top: 25%;
        left: 0;
        pointer-events: none;
        opacity: 0.5;

    }
    
</style>