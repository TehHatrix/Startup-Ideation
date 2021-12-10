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
        let {data} = await api.getAllContent(payload);
        if(data.success) {
            commit('SET_CONTENTS', data.content)
        } 
        
        
        console.log()

    }
}

export default {
    state,
    getters,
    mutations,
    actions
}
