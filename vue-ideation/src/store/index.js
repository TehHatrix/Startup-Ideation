import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate';
import authRepository from './authRepository.js'
import projectRepository from './projectRepository'
import todosRepository from './todosRepository'
import landingRepository from './landingRepository'
import leanCanvasRepository from './leanCanvasRepository'
import hypothesisRepository from "./hypothesisRepository"
import toastRepository from "./toastRepository"
import interviewRepository from "./interviewRepository"
import customerRepository from "./customerRepository"
import communicationRepository from './communicationRepository'
import freeCanvasRepository from './freeCanvasRepository' 
import freeCanvasContentRepository from './FreeCanvasContentRepository'
Vue.use(Vuex)

export default new Vuex.Store( {
    state: {

    },
    plugins:[createPersistedState()],
    
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
        hypothesisRepository,
        toastRepository,
        interviewRepository,
        customerRepository,
        communicationRepository,
        freeCanvasRepository,
        freeCanvasContentRepository
    }
    
})