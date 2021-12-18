<template lang="">
    <div class="container">
        <section class="grid grid-cols-5 gap-4">
            <div class="col-span-1">
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

                </div>
            </div>
            <div class="col-span-4">
                <div class="todo-title">
                    <span>Todo List  --  {{ currentCategory }}  --  </span>
                    <button v-if="!showAddCard" class="add-button" @click="showAddCard = true">Create Task</button>
                    <button v-else class="close-button" @click="closeAddCard" >Close</button>
                </div>

                <div v-if="showAddCard" class="add-task-card">
                    <span>Add Task</span>
                    <form @submit.prevent="addTask">
                        <div class="task-form-container">
                            <input type="text" id="task" v-model="taskForm.task" placeholder="Task" required>
                            <select id="assigned_to" v-model="taskForm.assigned_to">
                                <option :value="null" selected>Everyone</option>
                                <option v-for="(user, index) in project.collaborator" :key="index" :value="user.id">{{ user.name }}</option>
                            </select>
                            <input id="due_date" type="date" v-model="taskForm.due_date">
                        </div>
                        <div>
                            <button>Create Task</button>
                        </div>
                    </form>
                </div>

                <!-- all task card -->
                <div v-if="currentCategory === categoriesArr[0] ">
                        <todo-card 
                        :project="project"
                        :user="user" ></todo-card>
                </div>

            </div>

        </section>
    </div>
</template>
<script>
import { mapGetters } from 'vuex'
import TodoCardVue from '../../components/todo/TodoCard.vue'
import api from '@/api/todoApi'

export default {
    name: 'TodoPage',
    components: {
        'todo-card': TodoCardVue
    },

    data() {
        return {
            disabled: false,
            showAddCard: false,

            categoriesArr: [
                'All Task',
                'Completed Task',
                'For Me'
            ],
            currentCategory: null,

            taskForm: {
                task: '',
                assigned_to: null,
                due_date: null,
            },
        }
    },

    async created() {
        try {
            this.currentCategory = this.categoriesArr[0]
            if(this.tasks === null) {
                await this.$store.dispatch('getTodos', this.project.id)
            }
            
        } catch (error) {
            console.log(error)
        }
    },

    computed: {
        ...mapGetters([
            'project',
            'user',
            'tasks',
        ]),
    },

    methods: { 
        async addTask() {
            try {

                let {data} = await api.addTask(this.project.id, this.taskForm)
                if(data.success) {
                    await this.$store.dispatch('getTodos', this.project.id)
                    this.closeAddCard()
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
    },
    
}
</script>
<style lang="scss" scoped>

    .selected-category {
        background: #d1d9e1;
        &:hover {
            background: #d1d9e1 ;
        }
    }

    .todo-categories {
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 0 40px rgb(0 0 0 / 5%);
        margin-bottom: 2rem;
        min-height: 15rem;
        max-height: 15rem;
    
        .title {
            background: #14213d;
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
            font-weight: 600;
            font-size: 1.2rem;
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
        background: #14213d;
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


    .task-form-container {
        margin-top: 1rem;
        #task {
            width: 70%;
            height: 2rem;
            outline: none;  

        }
        #assigned_to {

            cursor: pointer;
            width: 15%;
            height: 2rem;

        }
        #due_date {
            width: 15%;
            height: 2rem;

        }
    }

</style>