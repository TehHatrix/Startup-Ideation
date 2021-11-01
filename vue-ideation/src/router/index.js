import Vue from 'vue'
import VueRouter from 'vue-router'
import Hypothesis from '../views/Hypothesis.vue'
import store from '@/store'


Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'HomeGuest',
    component: () => import('../views/Authentication/Authentication.vue')
  },
  {
    path: '/hypothesis',
    name: 'Hypothesis',
    component: Hypothesis
  },
  {
    path: '/login',
    name: 'Login',
    
    // component: Login,
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
    component: () => import('../views/Register.vue')
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

]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
