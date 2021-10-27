import api from '@/api/todoApi'

const state = {
    tasks: null
}

const getters = {
    tasks: state => state.tasks
}

const mutations = {
    SET_TASKS(state, payload) {
        state.tasks = payload
    }
}

const actions = {
    async getTodos({ commit }, payload) {
        let res = await api.getTask(payload)
        console.log(res)
        commit('SET_TASKS', res)
    },

    async setTodo() {
        
    }

}

export default {
    state,
    getters,
    mutations,
    actions
}