import api from '@/api/leanCanvasApi'

const state = {
    leanContent: [],
    errors: []
}

const getters = {
    leanContent: state => state.leanContent,
    customerSegment: state => state.leanContent[0]
}

const mutations = {
    SET_CONTENTS(state, payload) {
        state.leanContent = payload
        // localStorage.setItem('leanContent', JSON.parse(payload))
    },

    DESTROY_CONTENT(state) {
        state.leanContent = []
    }
}

const actions = {
    async getContents({commit}, payload) {
        // payload === project id 
        let res = await api.getAllContent(payload);
        if(res.data.success) {
            commit('SET_CONTENTS', res.data.content)
        } 
        
        return res

    }
}

export default {
    state,
    getters,
    mutations,
    actions
}
