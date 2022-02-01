import api from '@/api/leanCanvasApi'

const state = {
    leanContent: [],
    errors: [],
    customerSegment: [],
    leanProblem: [],
}

const getters = {
    leanContent: state => state.leanContent,
    customerSegment: state => state.customerSegment,
    leanProblem: state => state.leanProblem,
}

const mutations = {
    SET_CONTENTS(state, payload) {
        state.leanContent = payload
    },

    DESTROY_CONTENT(state) {
        state.leanContent = []
    },

    SET_CUSTOMER_SEGMENT(state, payload) {
        state.customerSegment = payload
    },

    SET_LEAN_PROBLEM(state, payload) {
        state.leanProblem = payload
    },
}

const actions = {
    async getContents({commit}, payload) {
        // payload === project id 
        let res = await api.getAllContent(payload);
        if(res.data.success) {
            commit('SET_CONTENTS', res.data.content)
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
