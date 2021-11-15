import api from './config'

export default {
    async getProjects() {
        return api.get('/api/projects')
    },
    
    async setProject(payload) {
        return api.post('/api/projects', payload)
    },

    async getProject(params) {
        return api.get(`/api/projects/${params}`)
    },

    async deleteProject(params) {
        return api.delete(`api/projects/${params}`)
    },

    async updateProject(params, payload) {
        return api.put(`api/projects/${params}`, payload)
    }
}