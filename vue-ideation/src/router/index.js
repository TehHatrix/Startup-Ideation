import Vue from 'vue'
import VueRouter from 'vue-router'
import Hypothesis from '../views/Hypothesis.vue'
import middleware from './middleware'
import Interview from '../views/Interviews/Interview.vue'
import store from '@/store'
import Login from '../views/Login.vue'
import Test from "../views/Test.vue"
import LandingEditor from "../views/LandingMaker/LandingEditor.vue"


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
    path: '/test',
    name: 'Test',
    component: Test
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
    path: '/projects/:projectId/todos',
    name: 'Todo',
    component: () => import('../views/Todo/Todo.vue'),
    beforeEnter: middleware.guest

  },

  {
    path: '/projects/:id/leancanvas',
    name: 'LeanCanvas',
    component: () => import('../views/LeanCanvas/LeanCanvas.vue'),
    beforeEnter: middleware.guest

  },


]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
