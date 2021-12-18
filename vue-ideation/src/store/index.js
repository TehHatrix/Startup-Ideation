import Vue from 'vue'
import Vuex from 'vuex'
import authRepository from './authRepository.js'
import projectRepository from './projectRepository'
import todosRepository from './todosRepository'
import landingRepository from './landingRepository'
import leanCanvasRepository from './leanCanvasRepository'
import hypothesisRepository from "./hypothesisRepository"
import toastRepository from "./toastRepository"
import interviewRepository from "./interviewRepository"

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
        hypothesisRepository,
        toastRepository,
        interviewRepository,
    }
    
})