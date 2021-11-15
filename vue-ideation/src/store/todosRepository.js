import api from '@/api/todoApi'

const state = {
    tasks: null
}

const getters = {
    tasks: state => state.tasks
}

const mutations = {
    GET_TASKS(state, payload) {
        state.tasks = payload
    }
}

const actions = {
    async getTodos({ commit }, payload) {
        let res = await api.getTask(payload)
        // console.log(res)
        commit('GET_TASKS', res.data.tasks)
    },

    // async addTask(payload) {
    //     let {data} = await api.addTask(payload.projectId, payload.form)
    //     if(data.success) {
    //         this.getTodos
    //     } else {
    //         console.log(data.errors)
    //     }
    // }

}

export default {
    state,
    getters,
    mutations,
    actions
}