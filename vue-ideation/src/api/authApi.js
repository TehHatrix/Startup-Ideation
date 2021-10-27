import api from './config'

export default {
    async createSession() {
        return api.get('/sanctum/csrf-cookie')
    },

    async login(params) {
        return api.post('/api/login', params)
    },

    async register(params) {
        return api.post('/api/register', params)
    },

    async logout() {
        return api.delete('/api/logout')
    }

}