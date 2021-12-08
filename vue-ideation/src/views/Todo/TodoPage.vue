<template lang="">
    <div>
        <section class="grid grid-cols-5">
            <div class="col-span-1" >

            </div>
            <div class="col-span-2">
                <h2>Todo List</h2>
                <todo-list :project="project" ></todo-list>
            </div>
            <div class="col-span-2">
                <div class="center" v-if="!todo" >click a task title to its detail </div>
                <div v-else class="todo-update">
                    <div class="update-bar">
                        <div >
                            <input type="checkbox"  id="complete-checkbox"> 
                            <input class="update-bar-item" type="date"  id="">
                        </div>
                        <div>
                            <button>
                                <font-awesome-icon icon="trash-alt"></font-awesome-icon>
                            </button>
                        </div>
                    </div>

                    <div class="update-content">
                        <div>
                            <input type="text" name="" id="" class="task-input" :value="todo.task">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
import { mapGetters } from 'vuex'
import TodoListVue from '../../components/TodoList.vue'

export default {
    name: 'TodoPage',
    components: {
        'todo-list': TodoListVue
    },

    computed: {
        ...mapGetters([
            'project',
            'todo'
        ]),
    }
    
}
</script>
<style lang="scss" scoped>
    section > div {
        background: #fff;
        height: 100vh;
        border-right: 1px solid #adb5bd;
        padding: 5px 5px;
        margin: 0;
    }

    .center {
        display: flex;
        justify-content: center;
        align-items: center;
        height: inherit;
    }

    .todo-update {
        padding: 10px 10px
    }

    .update-bar-item {
        margin-left: 10px;
        padding-left: 10px;
    }


    .update-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #adb5bd;
        padding-bottom: 1rem;
    }

    .update-content {
        margin-top: 1rem;
    }

    .task-input {
        border: none;
        font-weight: bold;
        font-size: 1.25rem;
    }

    .task-input:focus {
        border: none;
        outline: none;
    }



</style>