import api from '@/api/communicationApi'

const state = {
    announcement: null,

}

const getters = {
    announcement: state => state.announcement,
}

const mutations = {
    SET_ANNOUNCEMENT(state, payload) {
        state.announcement = payload
    }
}

const actions = {
    async getAnnouncement({ commit }, payload) {
        let res = await api.getAnnouncement(payload)
        // console.log(res.data.announcements)
        // if(!res.data.sucess) {
        //     return res.data
        // }
        
        commit('SET_ANNOUNCEMENT', res.data.announcements)
    },

    

}


export default {
    state,
    getters,
    mutations,
    actions
}