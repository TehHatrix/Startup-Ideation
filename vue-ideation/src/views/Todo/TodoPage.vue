<template lang="">
    <div>
        <div class="c-container" v-if="!loading">
            <section class="grid grid-cols-5 gap-4">
                <div class="col-span-1">
                    <!-- category card -->
                    <div class="todo-categories">
                        <div class="title" >
                            Categories
                        </div>
                        <div class="body" @click="currentCategory = categoriesArr[0]" :class="currentCategory === categoriesArr[0] ? 'selected-category' : '' " >
                            {{ categoriesArr[0] }}
                        </div>
                        <div class="body" @click="currentCategory = categoriesArr[1]" :class="currentCategory === categoriesArr[1] ? 'selected-category' : '' " >
                            {{ categoriesArr[1] }}
                        </div>
                        <div class="body" @click="currentCategory = categoriesArr[2]" :class="currentCategory === categoriesArr[2] ? 'selected-category' : '' " >
                            {{ categoriesArr[2] }}
                        </div>
                        <div class="body" @click="currentCategory = categoriesArr[3]" :class="currentCategory === categoriesArr[3] ? 'selected-category' : '' " >
                            {{ categoriesArr[3] }}
                        </div>

                    </div>
                </div>
                <div class="col-span-4">
                    <!-- header card -->
                    <div class="todo-title">
                        <span>Todo List  --  {{ currentCategory }}  --  </span>
                        <button v-if="!showAddCard" class="general-button-colored" @click="showAddCard = true">Create Task</button>
                        <button v-else class="general-button-danger" @click="closeAddCard" >Close</button>
                    </div>
                    <!-- create task card -->
                    <transition name="slide-fade" >
                        <div v-if="showAddCard" class="add-task-card">
                            <span id="add-task" >Add Task</span>
                            <form @submit.prevent="addTask">
                                <div class="task-form-container">
                                    <input type="text" id="task" v-model="taskForm.task" placeholder="Task" required>
                                    <select id="assigned_to" v-model="taskForm.assigned_to">
                                        <option :value="null" selected>Everyone</option>
                                        <option v-for="(user, index) in project.collaborator" :key="index" :value="user.id">{{ user.name }}</option>
                                    </select>
                                    <input id="due_date" type="date" v-model="taskForm.due_date">
                                </div>
                                <div >
                                    <button class="general-button">Create Task</button>
                                </div>
                            </form>
                        </div>
                    </transition>
        
                    <!-- all task card -->
                    <div v-if="currentCategory === categoriesArr[0] ">
                            <todo-card
                            :project="project"
                            :user="user"
                            :tasks="defaultTask"></todo-card>
                    </div>
                    <div v-if="currentCategory === categoriesArr[1] ">
                            <todo-card
                            :project="project"
                            :user="user"
                            :tasks="completedTask"></todo-card>
                    </div>
                    <div v-if="currentCategory === categoriesArr[2] ">
                            <todo-card
                            :project="project"
                            :user="user"
                            :tasks="forMeTask"></todo-card>
                    </div>
                </div>
            </section>
        </div>
        <div v-else>
            <loading-screen />
        </div>

    </div>
</template>
<script>
import { mapGetters } from 'vuex'
import TodoCardVue from '../../components/todo/TodoCard.vue'
import api from '@/api/todoApi'
import LoadingScreen from '@/components/general/LoadingScreen.vue'
export default {
    name: 'TodoPage',
    components: {
        'todo-card': TodoCardVue,
        'loading-screen': LoadingScreen,
    },

    data() {
        return {
            loading: true,
            disabled: false,
            showAddCard: false,
            projectId: this.$route.params.id,
            categoriesArr: [
                'All Task',
                'Completed Task',
                'For Me',
                'Next 7 Days'
            ],
            currentCategory: null,

            taskForm: {
                task: '',
                assigned_to: null,
                due_date: null,
            },

            processing: false,
        }
    },

    async created() {
        this.connect()
        try {
            this.currentCategory = this.categoriesArr[0]
            let {data} = await this.$store.dispatch('getTodos', {projectId: this.projectId, userId: this.user.id})
            if(data.success) {
                this.loading = false
            }
        } catch (error) {
            console.log(error)
        } 
    },

    beforeDestroy() {
        this.disconnect()
    },

    computed: {
        ...mapGetters([
            'project',
            'user',
            'tasks',
            'defaultTask',
            'completedTask',
            'forMeTask',
        
        ]),

    },

    methods: { 
        async addTask() {
            try {
                if(!this.processing && this.showAddCard) {
                    this.processing = true
                    let {data} = await api.addTask(this.projectId, this.taskForm)
                    if(data.success) {
                        this.processing = false
                        this.closeAddCard()
                    } else {
                        this.processing = false
                    }

                }
            } catch(error) {
                console.log(error)
            }
        },

        closeAddCard() {
            this.showAddCard = false
            this.taskForm.task = ''
            this.taskForm.assigned_to = null
            this.taskForm.due_date = null
        },

        connect() {
            window.Echo.private(`Project.${this.projectId}`)
                        .listen('TaskUpdated', async () => {
                            await this.$store.dispatch('getTodos', {projectId: this.projectId, userId: this.user.id})
                        })
        }, 

        disconnect() {
            window.Echo.leaveChannel(`Project.${this.projectId}`)
            console.log('disconnect')
        }

        



    },
    
}
</script>
<style lang="scss" scoped>

    .selected-category {
        background: #d1d9e1;
        &:hover {
            background: #d1d9e1 !important;
        }
    }

    .todo-categories {
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 0 40px rgb(0 0 0 / 5%);
        margin-bottom: 2rem;

        .title {
            // background: #14213d;
            background: linear-gradient(180deg, #8743FF 0%, #4136F1 100%);
            color: #fff;
            text-align: center;
            font-weight: 600;
            letter-spacing: .2rem;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
            padding: .5rem .5rem;


        }
        .body {
            border-bottom: 1px solid #14213d;
            padding: .5rem .5rem;
            font-weight: 500;
            cursor: pointer;

            &:last-child {
                border: none;
                border-bottom-left-radius: 1rem;
                border-bottom-right-radius: 1rem;


            }

            &:hover {
                background: #f5f5f5;
            }
        }
    }

    .todo-title {
        background: #fff;
        
        border-radius: 1rem;
        box-shadow: 0 0 40px rgb(0 0 0 / 5%);
        margin-bottom: 2rem;
        min-height: 2rem;
        padding: 1rem 1rem;

        display: flex;
        align-items: center;
        justify-content: space-between;

        span {
            letter-spacing: 0.2rem;
            font-weight: bold;
            font-size: 2rem;
        }
    }

    .add-task-card {
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 0 40px rgb(0 0 0 / 5%);
        margin-bottom: 2rem;
        min-height: 2rem;
        padding: 1rem 1rem;

        transition: all .2s .3s;

        span {
            font-weight: 500;
            font-size: 1rem;
        }
    }

    .add-button {
        border: none;
        border-radius: .4rem;
        // background: #14213d;
        color: white;
        border: 1px solid #14213d;
        padding: .5rem .5rem;
        cursor: pointer;
        transition: all 0.5s ease-in 0.3s;
    }

    
    .close-button {
        border-radius: .4rem;
        border: 1px solid #14213d;
        color: #14213d;
        background: #fff;
        padding: .5rem .5rem;
        cursor: pointer;
        outline: none;
        width: 5rem;
        
        &:hover {
            background: #14213d;
            color: #fff;
            -moz-transition: all 0.25s ease-in-out;
            -webkit-transition: all 0.25s ease-in-out;
            -ms-transition: all 0.25s ease-in-out;
            transition: all 0.25s ease-in-out;
            -webkit-appearance: none;
        }
    }

    #add-task {
        font-size: 1rem;
        font-weight: 600;
        letter-spacing: .2rem
    }

    .task-form-container {
        margin-top: 1rem;
        margin-bottom: 1rem;
        #task {
            width: 70%;
            height: 2rem;
            outline: none;  

            border: 1px solid #222021;
            outline: 0;
            background: white;
            border-radius: .5rem;
            color: #343434;
            margin: auto;
            padding: 0 .5rem 0 .5rem;
        }
        #assigned_to {

            cursor: pointer;
            width: 15%;
            height: 2rem;

        }
        #due_date {
            width: 15%;
            height: 2rem;

            border: 1px solid #222021;
            outline: 0;
            background: white;
            border-radius: .5rem;
            color: #343434;
            margin: auto;
            padding: 0 .5rem 0 .5rem;

        }

        & + div {
            text-align: right;
        }
    }

    .slide-fade-enter-active {
        transition: all .3s ease;
    }
    .slide-fade-leave-active {
        transition: all .3s ease;
    }
    .slide-fade-enter, .slide-fade-leave-to
        /* .slide-fade-leave-active below version 2.1.8 */ {
        transform: translateX(10px);
        opacity: 0;
    }

</style>