import api from './config'

export default {

    async getTask(projectId) {
        return api.get(`api/projects/${projectId}/todos`)
    }

}