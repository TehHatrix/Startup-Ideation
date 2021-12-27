import api from './config'

export default {
    async addFreeCanvas(projectId, payload) {
        return api.post(`api/projects/${projectId}/free-canvas`, payload)
    },

    async getFreeCanvas(projectId) {
        return api.get(`api/projects/${projectId}/free-canvas`)
    }, 

    async showCanvas(projectId, canvasId) {
        return api.get(`api/projects/${projectId}/free-canvas/${canvasId}`)
    }
}