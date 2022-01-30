import api from '@/api/todoApi'

const state = {
    tasks: null,
    defaultTask: null,
    completedTask: null,
    forMeTask: null,
    next7: null,
}

const getters = {
    tasks: state => state.tasks,
    defaultTask: state => state.defaultTask,
    completedTask: state => state.completedTask,
    forMeTask: state => state.forMeTask,
    next7: state => state.next7,
}

const mutations = {
    GET_TASKS(state, payload) {
        state.tasks = payload
    },
    SET_TASKS_NULL(state) {
        state.tasks = null
        state.completedTask = null
        state.defaultTask = null
        state.forMeTask = null
        state.next7 = null
    },

    SET_TASK_DEFAULT(state, payload) {
        let defaultTasks = payload.filter( task => !task.completed)
        defaultTasks.sort( (a, b) => {
            let da = new Date(a.due_date ? a.due_date : 0),
                db = new Date(b.due_date ? b.due_date : 0)
            
            return da - db
        })
        
        state.defaultTask = defaultTasks
    },

    SET_COMPLETED_TASK(state, payload) {
        let tasksCompleted = payload.filter( (task) => task.completed)
        state.completedTask = tasksCompleted
    },

    SET_FOR_ME_TASK(state, payload) {
        let taskForMe = payload.tasks.filter( task => {
            return task.assigned_to === payload.userId || task.assigned_to === null ? true : false
        })
        let tasksnew = taskForMe.filter( task => !task.completed)

        state.forMeTask = tasksnew

    }


}

const actions = {
    async getTodos({ commit }, payload) {
        let res = await api.getTask(payload.projectId)
        if(res.data.success) {
            commit('GET_TASKS', res.data.tasks)
            commit('SET_TASK_DEFAULT', res.data.tasks)
            commit('SET_COMPLETED_TASK', res.data.tasks)
            commit('SET_FOR_ME_TASK', {tasks: res.data.tasks, user: payload.userId})
        }
        return res
    },



}

export default {
    state,
    getters,
    mutations,
    actions
}