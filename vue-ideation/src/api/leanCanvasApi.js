import api from './config'

export default {

    async addContent(projectId, payload) {
        return api.post(`api/projects/${projectId}/leancanvas`, payload)
    },


    async getAllContent(projectId) {
        return api.get(`api/projects/${projectId}/leancanvas`)
    },

    async deleteContent(contentId, contentType) {
        return api.delete(`api/projects/leancanvas/${contentType}/${contentId}`)
    }
}