import api from '@/api/freeCanvasApi'

const state = {
    freeCanvas: null,
    canvas: null
}

const getters = {
    freeCanvas: state => state.freeCanvas,
    canvas: state => state.canvas
}

const mutations = {
    GET_CANVAS(state, payload) {
        state.freeCanvas = payload
    },

    GET_ONE_CANVAS(state, payload) {
        state.canvas = payload
    },

    SET_FREE_CANVAS_NULL(state) {
        state.freeCanvas = null
        state.canvas = null
    }
}

const actions = {
    async getCanvas({ commit }, payload) {
        try {
            let res = await api.getFreeCanvas(payload) 
            if(res.data.success) {
                commit('GET_CANVAS', res.data.FreeCanvas)
            }

            return res
        } catch (error) {
            console.log(error)
        }
    },

    async showCanvas({ commit }, payload) {
        try {
            let res = await api.showCanvas(payload.id, payload.canvasId)
            if(res.data.success) {
                commit('GET_ONE_CANVAS', res.data.FreeCanvas)
            }
            
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