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
    },

    async updateFreeCanvas(projectId, canvasId, payload) {
        return api.put(`api/projects/${projectId }/free-canvas/${canvasId}`, payload)
    },

    async deleteFreeCanvas(projectId, canvasId) {
        return api.delete(`api/projects/${projectId }/free-canvas/${canvasId}`)
    },

    async getFreeContent(canvasId) {
        return api.get(`api/free-canvas/${canvasId}/content`)
    },

    async updateFreeContent(canvasId, payload) {
        return api.put(`api/free-canvas/${canvasId}/content`, payload)
    }


}