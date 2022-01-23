import Vue from 'vue'
import Vuex from 'vuex'
import authRepository from './authRepository.js'
import projectRepository from './projectRepository'
import todosRepository from './todosRepository'
import landingRepository from './landingRepository'
import leanCanvasRepository from './leanCanvasRepository'
import communicationRepository from './communicationRepository'
import freeCanvasRepository from './freeCanvasRepository' 
import freeCanvasContentRepository from './FreeCanvasContentRepository'
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
        todosRepository,
        landingRepository,
        leanCanvasRepository,
        communicationRepository,
        freeCanvasRepository,
        freeCanvasContentRepository
    }
    
})