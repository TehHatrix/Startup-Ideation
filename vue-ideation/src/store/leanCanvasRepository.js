import api from '@/api/leanCanvasApi'

const state = {
    leanContent: [],
    errors: [],
    customerSegment: [],
    leanProblem: [],
    leanRevenue: [],
    leanSolution: [],
    uniqueValueProposition: [],
    leanChannel: [],
    keyMetric: [],
    costStructure: [],
    unfairAdvantage: [],

}

const getters = {
    leanContent: state => state.leanContent,
    customerSegment: state => state.customerSegment,
    leanProblem: state => state.leanProblem,
    leanRevenue: state => state.leanRevenue,
    leanSolution: state => state.leanSolution,
    uniqueValueProposition: state => state.uniqueValueProposition,
    leanChannel: state => state.leanChannel,
    keyMetric: state => state.keyMetric,
    costStructure: state => state.costStructure,
    unfairAdvantage: state => state.unfairAdvantage
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

    SET_LEAN_REVENUE(state, payload) {
        state.leanRevenue = payload
    },
    
    SET_LEAN_SOLUTION(state, payload) {
        state.leanSolution = payload
    },

    SET_UNIQUE_VALUE_PROPOSITION(state, payload) {
        state.uniqueValueProposition = payload
    },

    SET_LEAN_CHANNEL(state, payload) {
        state.leanChannel = payload
    },

    SET_KEY_METRIC(state, payload) {
        state.keyMetric = payload
    },

    SET_COST_STRUCTURE(state, payload) {
        state.costStructure = payload
    },

    SET_UNFAIR_ADVANTAGE(state, payload) {
        state.unfairAdvantage = payload
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
