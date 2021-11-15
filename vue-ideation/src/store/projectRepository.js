import api from '@/api/projectApi'

const state = {
    projects: {},
    project: sessionStorage.project ? JSON.parse(sessionStorage.project) : {}
}

const getters = {
    projects: state => state.projects,
    project: state => state.project    
}

const mutations = {
    SET_PROJECTS(state, payload) {
        state.projects = payload
    },

    SET_PROJECT_LOCALLY(state, payload) {
        state.project = payload
    },

    DESTROY_PROJECT_LOCALLY(state) {
        state.project = {}
    },

    UPDATE_PROJECT(state) {
        state.project
    }

    
}

const actions = {
    async getProjects({ commit }) {
        let res = await api.getProjects()
        // console.log(res.data.projects + 'from getProject api')
        commit('SET_PROJECTS', res.data.projects)
        return api.getProjects()
    },

    async setProjects({ commit }, payload) {
        let res = await api.setProjects(payload)
        // console.log(res)
        if(res.data.success) {
            let { data } = await api.getProjects()
            commit('SET_PROJECTS', data.project)
        }

        return res
    },

    async getProject({ commit }, payload) {
        let res = await api.getProject(payload)
        // console.log(res)
        if(res.data.success === false) return res
        commit('SET_PROJECT_LOCALLY', res.data.project)
        sessionStorage.project = JSON.stringify(res.data.project)
    },

    async updateProject({commit}, payload) {
        let {data} = await api.updateProject(payload.project_id, payload.updateProjectForm)
        if(data.success) {
            commit('UPDATE_PROJECT', data.project)
        }
    }
}


export default {
    state,
    getters,
    mutations,
    actions
}