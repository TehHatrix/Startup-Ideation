import api from '@/api/communicationApi'
import chatApi from '@/api/messageApi'

const state = {
    announcement: null,
    chatMessages: [],

}

const getters = {
    announcement: state => state.announcement,
    chatMessages: state => state.chatMessages,
}

const mutations = {
    SET_ANNOUNCEMENT(state, payload) {
        state.announcement = payload
    },

    SET_ANNOUNCEMENT_NULL(state) {
        state.announcement = null
        state.chatMessages = []
    },
    
    APPEND_MESSAGES(state, payload) {
        state.chatMessages.push = payload
    },

    SET_CHAT_MESSAGES(state, payload) {
        state.chatMessages = payload
    }
}

const actions = {
    async getAnnouncement({ commit }, payload) {
        let res = await api.getAnnouncement(payload)        
        commit('SET_ANNOUNCEMENT', res.data.announcements)
        return res;
    },

    async getMessages({ commit }, payload) {
        let res = await chatApi.getMessages(payload) 
        if(res.data.success) {
            commit('SET_CHAT_MESSAGES', res.data.messages)
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