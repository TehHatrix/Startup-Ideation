import auth from '@/api/authApi'

const state = {
    user: localStorage.user ? JSON.parse(localStorage.getItem('user')) : null
}

const getters = {
    user: state => state.user,
    authenticated: state => state.user !==null
}

const mutations = {
    SET_USER(state, payload) {
        state.user = payload
    }
}

const actions = {
    async login ({ commit }, payload) {
        await auth.createSession()
        const { data } = await auth.login(payload)

        commit('SET_USER', data.user)

        localStorage.user = JSON.stringify(data.user)

        return data
    },

    async logout({commit}) {
        let { data } = await auth.logout()
        if(data.success) {
            commit('SET_USER', null)
            localStorage.removeItem('user')
        } else {
            console.log('fail to logout')
        }
    },

}


export default {
    state,
    getters,
    mutations,
    actions
}