import auth from '@/api/authApi'

const state = {
    user: null,
    authenticated: false,
}

const getters = {
    user: state => state.user,
    authenticated: state => state.authenticated
}

const mutations = {
    SET_USER(state, payload) {
        state.user = payload
    },
    SET_AUTHENTICATED(state,boolean){
        state.authenticated = boolean
    },

    SET_USER_NULL(state) {
        state.user = null
        state.authenticated = false 
    }
}

const actions = {
    async login ({ commit }, payload) {
        await auth.createSession()
        let res = await auth.login(payload)
        if(res.data.success) {
            commit('SET_USER', res.data.user)
            commit('SET_AUTHENTICATED',true)
        }
        // state.user = JSON.stringify(data.user)
        return res
    },

    async logout({commit}) {
        let { data } = await auth.logout() 
        if(data.success) {
            commit('SET_USER', null)
            commit('SET_AUTHENTICATED', false)
            // localStorage.removeItem('user')
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