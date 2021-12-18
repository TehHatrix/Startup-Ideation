import api from './config'

export default {

    async getAnnouncement(projectId) {
        return api.get(`api/projects/${projectId}/announcement`)
    }, 

    async postAnnouncement(projectId, payload) {
        return api.post(`api/projects/${projectId}/announcement`, payload)
    },

    async updateAnnouncement(projectId, annId, payload) {
        return api.put(`api/projects/${projectId}/announcement/${annId}`, payload)
    },

    async deleteAnnouncement(projectId, annId) {
        return api.delete(`api/projects/${projectId}/announcement/${annId}`)
    }
}