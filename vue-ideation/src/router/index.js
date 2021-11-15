import Vue from 'vue'
import VueRouter from 'vue-router'
import Hypothesis from '../views/Hypothesis.vue'
import store from '@/store'
import middleware from './middleware'

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
    component: Hypothesis
  },
  {
    path: '/login',
    name: 'Login',
    beforeEnter: middleware.user,
    // beforeEnter: (to, from, next) => {
    //   if(store.getters['authenticated']) {
    //     next({name: 'ProjectsList'})
    //   } else {
    //     next()
    //   }
    // }
  },
  {
    path: '/register',
    name: 'Register',
    component: () => import('../views/Register.vue'),
    beforeEnter: middleware.guest

  },
  {
    path: '/projects',
    name: 'ProjectsList',
    component: () => import('../views/Project/ProjectsList.vue'),
    beforeEnter: (to, from, next) => {
      if(store.getters['authenticated']) {
        next()
      } else {
        next({name: 'HomeGuest'})
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

  {
    path: '/projects/:id/leancanvas',
    name: 'LeanCanvas',
    component: () => import('../views/LeanCanvas/LeanCanvas.vue'),
  }

]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
