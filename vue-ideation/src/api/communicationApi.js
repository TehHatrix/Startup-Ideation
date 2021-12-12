import api from './config'

export default {

    async getAnnouncement(projectId) {
        return api.get(`api/projects/${projectId}/announcement`)
    }, 

    async postAnnouncement(projectId, payload) {
        return api.post(`api/projects/${projectId}/announcement`, payload)
    }
}