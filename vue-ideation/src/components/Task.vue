<template lang="">
    <div class="task-list" :class="task.completed ? 'line' : '' " >
        <!-- <div v-for="(task, index) in tasks" :key="index" class="test" >
            <p>{{ task.task }}</p>
            <p>{{ task.due_date ? task.due_date : "null" }}</p>
            <div v-for="user in collab" :key="user.id">
                <p v-if="user.id === task.assigned_to" >{{user.name}}</p>
            </div>
            <input type="checkbox" :id="task.id"   >
        </div> -->

        <input type="checkbox" v-model="task.completed" @change="setComplete" class="task-checkbox" >
        <span id="task" >{{ task.task }}</span>
        <span>{{ task.due_date ? task.due_date : '' }}</span>
        <div v-for="(user, index) in collab" :key="index" >
            <span v-if="user.id === task.assigned_to" >{{user.name}}</span>
        </div>
    </div>
</template>
<script>
import api from '@/api/todoApi'

export default {
    name: 'Task',
    props: {
        task: Object, 
        collab: Array,
        projectId: Number
    },

    data() {
        return {
            params: {
                projectId: this.$route.params.id,
                taskId: this.task.id,
            },

            updatedTask: {
                task: this.task.task,
            }
        }
    },

    methods: {
        async setComplete() {
            try {
                this.task.completed = true
                let {data} = await api.updateTask(this.params, this.task)
                if(data.success) {
                    this.$store.dispatch('getTodos', this.params.projectId)
                }
            } catch(error) {
                console.log(error)
            }
        }
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
</style>