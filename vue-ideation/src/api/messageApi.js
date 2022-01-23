import api from './config'

export default {

    getMessages(projectId) {
        return api.get(`api/projects/${projectId}/message`)
    },

    deleteMessage(projectId, chatId) {
        return api.delete(`api/projects/${projectId}/message/${chatId}`)
    },

    postMessage(projectId, $message) {
        return api.post(`api/projects/${projectId}/message`, $message)
    },
}