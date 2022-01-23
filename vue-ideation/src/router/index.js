import Vue from 'vue'
import VueRouter from 'vue-router'
import Hypothesis from '../views/Hypothesis.vue'
import middleware from './middleware'
import Interview from '../views/Interviews/Interview.vue'
import LandingEditor from "../views/LandingMaker/LandingEditor.vue"
import LandingPage from "../views/LandingMaker/LandingPage.vue"
import LandingPageTest from "../views/LandingMaker/LandingPageTest.vue"
import LandingDashboard from "../views/LandingMaker/LandingDashboard.vue"
import Survey from "../views/Survey/Survey.vue"
import SurveySummary from "@/views/Survey/SummarySurvey.vue"
import SurveyDashboard from "@/views/Survey/SurveyDashboard.vue"



Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'HomeGuest',
    component: () => import('../views/Authentication/Authentication.vue'),
    beforeEnter: middleware.user
  },
  {
    path: '/hypothesis',
    name: 'Hypothesis',
    component: Hypothesis,
  },
  {
    path: '/interview',
    name: 'Interview',
    component: Interview
  },
  {
    path: '/editor/landing',
    name: 'LandingEditor',
    component: LandingEditor
  },
  {
    path: '/landingpage',
    name: 'LandingPage',
    component: LandingPage
  },
  {
    path: '/landingpage/dashboard',
    name: 'LandingDashboard',
    component: LandingDashboard
  },
  {
    path: '/survey',
    name: 'survey',
    component: Survey
  },
  {
    path: '/survey/summary',
    name: 'SurveySummary',
    component: SurveySummary
  },
  {
    path: '/survey/dashboard',
    name: 'SurveyDashboard',
    component: SurveyDashboard
  },

  {
    path: '/landingpagetest',
    name: 'LandingPageTest',
    component: LandingPageTest
  },
  {
    path: '/test',
    name: 'Test',
    component: () => import('../views/Project/test.vue'),
    beforeEnter: middleware.guest,
  },
  // {
  //   path: '/login',
  //   name: 'Login',
  //   beforeEnter: middleware.user,
  // },
  // {
  //   path: '/register',
  //   name: 'Register',
  //   component: () => import('../views/Register.vue'),
  //   beforeEnter: middleware.guest

  // },
  {
    path: '/projects',
    name: 'ProjectsList',
    component: () => import('../views/Project/ProjectsList.vue'),
    beforeEnter: middleware.guest
    // beforeEnter: (to, from, next) => {
    //   if(store.getters['authenticated']) {
    //     next()
    //   } else {
    //     next({name: 'HomeGuest'})
    //   }
    // }
  },
  {
    path: '/projects/:id',
    name: 'Project',
    component: () => import('../views/Project/Project.vue'),
    beforeEnter: middleware.guest
  },
  {
    path: '/projects/:id/todos',
    name: 'TodoPage',
    component: () => import('../views/Todo/TodoPage.vue'),
    beforeEnter: middleware.guest

  },

  {
    path: '/projects/:id/leancanvas',
    name: 'LeanCanvas',
    component: () => import('../views/LeanCanvas/LeanCanvas.vue'),
    beforeEnter: middleware.guest

  },

  {
    path: '/projects/:id/freecanvas',
    name: 'FreeCanvas',
    component: () => import('../views/FreeCanvas/FreeCanvas.vue'),
    beforeEnter: middleware.guest
  },

  {
    path: '/projects/:id/freecanvas/:canvasId',
    name: 'EditorPage',
    component: () => import('../views/FreeCanvas/EditorPage.vue'),
    beforeEnter: middleware.guest,
  },
  {
    path: '/project/:id/projectchat',
    name: 'ChatPage',
    component: () => import('../views/Chat/ChatPage.vue'),
    beforeEnter: middleware.guest,
  }


]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
