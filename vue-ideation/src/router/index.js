import Vue from 'vue'
import VueRouter from 'vue-router'
import Hypothesis from '../views/Hypothesis.vue'
import Interview from '../views/Interviews/Interview.vue'
import store from '@/store'
import Login from '../views/Login.vue'
import Test from "../views/Test.vue"
import LandingEditor from "../views/LandingMaker/LandingEditor.vue"
import LandingEditor2 from "../views/LandingMaker/LandingEditor2.vue"
import LandingPage from "../views/LandingMaker/LandingPage.vue"


Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'HomeGuest',
    component: () => import('../views/Authentication/Authentication.vue')
  },
  {    
    path: '/about',
    name: 'About',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
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
    path: '/editor/landing2',
    name: 'LandingEditor2',
    component: LandingEditor2
  },
  {
    path: '/landingpage',
    name: 'LandingPage',
    component: LandingPage
  },
  {
    path: '/test',
    name: 'Test',
    component: Test
  },
  {
    path: '/login',
    name: 'Login',
    component: Login,
    beforeEnter: (to, from, next) => {
      if(store.getters['authenticated']) {
        next({name: 'ProjectsDashboard'})
      } else {
        next()
      }
    }
  },
  {
    path: '/register',
    name: 'Register',
    component: () => import('../views/Register.vue')
  },
  {
    path: '/projects',
    name: 'ProjectsDashboard',
    component: () => import('../views/Project/ProjectsDashboard.vue'),
    beforeEnter: (to, from, next) => {
      if(store.getters['authenticated']) {
        next()
      } else {
        next({name: 'Login'})
      }
    }
  },
  {
    path: '/projects/:id',
    name: 'Project',
    component: () => import('../views/Project/Project.vue')
  },
  {
    path: '/projects/:projectId/todos',
    name: 'Todo',
    component: () => import('../views/Todo/Todo.vue')
  },

]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
