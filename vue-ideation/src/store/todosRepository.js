import api from '@/api/todoApi'

const state = {
    tasks: null,
}

const getters = {
    tasks: state => state.tasks,
    completedTask: state => {
        let tempArr = []
        state.tasks.forEach(task => {
            if(task.completed) {
                tempArr.push(task)
            }
        })

        return tempArr 
    }
}

const mutations = {
    GET_TASKS(state, payload) {
        state.tasks = payload
    },

}

const actions = {
    async getTodos({ commit }, payload) {
        let res = await api.getTask(payload)
        // console.log(res)
        commit('GET_TASKS', res.data.tasks)
    },



}

export default {
    state,
    getters,
    mutations,
    actions
}