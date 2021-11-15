import api from './config'

export default {

    async getTask(projectId) {
        return api.get(`api/projects/${projectId}/todos`)
    },

    async addTask(projectId, payload) {
        return api.post(`api/projects/${projectId}/todos`, payload)
    },

    async updateTask(params, payload) {
        return api.put(`api/projects/${params.projectId}/todos/${params.taskId}`, payload)
    }

}