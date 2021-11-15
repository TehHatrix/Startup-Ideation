import api from './config'

export default {

    async addContent(params, payload) {
        return api.post(`api/projects/${params}/leancanvas`, payload)
    },


    async getAllContent() {

    }
}