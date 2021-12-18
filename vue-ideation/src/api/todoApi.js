import api from './config'

export default {

    async getTask(projectId) {
        return api.get(`api/projects/${projectId}/todos`)
    },

    async addTask(projectId, payload) {
        return api.post(`api/projects/${projectId}/todos`, payload)
    },

    async updateTask(projectId, todoId, payload) {
        return api.put(`api/projects/${projectId}/todos/${todoId}`, payload)
    },

    async deleteTask(projectId, taskId) {
        return api.delete(`api/projects/${projectId}/todos/${taskId}`)
    },



    
    

}