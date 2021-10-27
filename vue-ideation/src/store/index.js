import Vue from 'vue'
import Vuex from 'vuex'
import authRepository from './authRepository.js'
import projectRepository from './projectRepository'
import todosRepository from './todosRepository'

Vue.use(Vuex)

export default new Vuex.Store( {
    state: {

    },
    getters: {

    },
    mutations: {

    },
    actions: {

    },
    modules: {
        authRepository,
        projectRepository,
        todosRepository
    }
    
})