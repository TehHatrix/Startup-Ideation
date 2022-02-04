import api from './config'

export default {

    async addContent(projectId, payload) {
        return api.post(`api/projects/${projectId}/leancanvas`, payload)
    },


    async getAllContent(projectId) {
        return api.get(`api/projects/${projectId}/leancanvas`)
    },

    async deleteContent(canvasId, type) {
        return api.delete(`api/projects/leancanvas/${canvasId}/type/${type}`)
    },

    async updateContent(contentId, type, payload) {
        return api.put(`api/projects/leancanvas/${contentId}/type/${type}`, payload)
    },

    async getSegment(canvasId, type) {
        return api.get(`api/projects/leancanvas/${canvasId}/type/${type}`)
    },

    async getAllSegment(canvasId) {
        return api.get(`api/projects/leancanvas/${canvasId}/all`)
    },

    async getStatusValidate(canvasId) {
        return api.get(`api/projects/leancanvas/${canvasId}/status`)
    }
}