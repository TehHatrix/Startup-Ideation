import api from '@/api/freeCanvasApi'

const state = {
    FreeCanvasContent: '',
    canvasFull: ''
}

const getters = {
    FreeCanvasContent: state => state.FreeCanvasContent,
    canvasFull: state => state.canvasFull,
}

const mutations = {
    GET_CONTENT(state, payload) {
        state.FreeCanvasContent = payload.content
        state.canvasFull = payload
    },

}

const actions = {
    async getFreeCanvasContent({ commit }, payload) {
        try {
            // get canvas id 
            let res = await api.getFreeContent(payload) 
            if(res.data.success) {
                commit('GET_CONTENT', res.data.content)   
            }

            return res.data
        } catch (error) {
            console.log(error)
        }
    },



}


export default {
    state,
    getters,
    mutations,
    actions
}