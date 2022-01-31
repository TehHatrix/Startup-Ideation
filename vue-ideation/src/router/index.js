import Vue from "vue";
import VueRouter from "vue-router";
import Hypothesis from "../views/Hypothesis.vue";
import middleware from "./middleware";
import Interview from "../views/Interviews/Interview.vue";
import LandingEditor from "../views/LandingMaker/LandingEditor.vue";
import LandingPage from "../views/LandingMaker/LandingPage.vue";
import LandingDashboard from "../views/LandingMaker/LandingDashboard.vue";
import LandingChooseTemplates from "../views/LandingMaker/LandingChooseTemplates.vue";
import FirstTemplate from "../views/LandingMaker/Templates/FirstTemplate.vue";
import SecondTemplate from "../views/LandingMaker/Templates/SecondTemplate.vue";
import Survey from "../views/Survey/Survey.vue";
import SurveySummary from "@/views/Survey/SummarySurvey.vue";
import SurveyDashboard from "@/views/Survey/SurveyDashboard.vue";
import LandingThankYou from "../views/LandingMaker/ThankYouPage.vue"
import store from '@/store'

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "HomeGuest",
    component: () => import("../views/Authentication/Authentication.vue"),
    meta: { requiresAuth: false },
    // beforeEnter: middleware.user
  },
  {
    path: "/hypothesis",
    name: "Hypothesis",
    component: Hypothesis,
    meta: { requiresAuth: true },
    // beforeEnter: middleware.guest,
  },
  {
    path: "/interview/:id",
    name: "Interview",
    component: Interview,
    meta: { requiresAuth: true },
    // beforeEnter: middleware.guest,
  },
  {
    path: "/templates/landing",
    name: "LandingChooseTemplates",
    component: LandingChooseTemplates,
    meta: { requiresAuth: true },
    // beforeEnter: middleware.guest,
  },
  {
    path: "/templates/first",
    name: "FirstTemplate",
    component: FirstTemplate,
    meta: { requiresAuth: true },
    // beforeEnter: middleware.guest,
  },
  {
    path: "/templates/second",
    name: "SecondTemplate",
    component: SecondTemplate,
    meta: { requiresAuth: true },
    // beforeEnter: middleware.guest,
  },
  // {
  //   path: "/templates/landing",
  //   name: "LandingChooseTemplates",
  //   component: LandingChooseTemplates,
  //   meta: { requiresAuth: true },
  //   // beforeEnter: middleware.guest,
  // },
  {
    path: "/editor/landing",
    name: "LandingEditor",
    component: LandingEditor,
    meta: { requiresAuth: true },
    // beforeEnter: middleware.guest,
  },
  {
    path: "/landingpage/",
    name: "LandingPage",
    component: LandingPage,
    meta: { requiresAuth: true },
    // beforeEnter: middleware.guest,
  },
  {
    path: "/landingpage/:landingID",
    name: "LandingPageShare",
    component: LandingPage,
    // meta: { requiresAuth: true },
    // beforeEnter: middleware.guest,
  },
  {
    path: "/landing/dashboard",
    name: "LandingDashboard",
    component: LandingDashboard,
    meta: { requiresAuth: true },
    // beforeEnter: middleware.guest,
  },
  {
    path: "/landing/thankyou",
    name: "LandingThankYou",
    component: LandingThankYou,
    // meta: { requiresAuth: true },
    // beforeEnter: middleware.guest,
  },
  {
    path: "/survey",
    name: "Survey",
    component: Survey,
    meta: { requiresAuth: true },
    // beforeEnter: middleware.guest,
  },
  {
    path: "/survey/share/:projectID",
    name: "SurveyShare",
    component: Survey,
    // meta: { requiresAuth: true },
    // beforeEnter: middleware.guest,
  },
  {
    path: "/survey/summary/:projectID",
    name: "SurveySummary",
    component: SurveySummary,
    meta: { requiresAuth: true },
    // beforeEnter: middleware.guest,
  },
  {
    path: "/survey/dashboard/:projectID",
    name: "SurveyDashboard",
    component: SurveyDashboard,
    meta: { requiresAuth: true },
    // beforeEnter: middleware.guest,
  },
  {
    path: "/test",
    name: "Test",
    component: () => import("../views/ProjectDashboard.vue"),
  },

  {
    path: "/projects",
    name: "ProjectsList",
    component: () => import("../views/Project/ProjectsList.vue"),
    meta: { requiresAuth: true },
    // beforeEnter: middleware.guest,
  },
  {
    path: "/projects/:id",
    name: "Project",
    component: () => import("../views/Project/Project.vue"),
    meta: { requiresAuth: true },
    // beforeEnter: middleware.guest,
  },
  {
    path: "/projects/:id/todos",
    name: "TodoPage",
    component: () => import("../views/Todo/TodoPage.vue"),
    meta: { requiresAuth: true },
    // beforeEnter: middleware.guest,
  },

  {
    path: "/projects/:id/leancanvas",
    name: "LeanCanvas",
    component: () => import("../views/LeanCanvas/LeanCanvas.vue"),
    meta: { requiresAuth: true },
    // beforeEnter: middleware.guest,
  },
  {
    path: '/projects/:id/freecanvas',
    name: 'FreeCanvas',
    component: () => import('../views/FreeCanvas/FreeCanvas.vue'),
    // beforeEnter: middleware.guest
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
    
  },

  {
    path: '/lean-canvas/learnmore',
    name: 'LeanCanvasInformation',
    component: () => import('../views/LeanCanvasInformation'),
  }
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

router.beforeEach((to, from, next) => {
  if(to.name === 'HomeGuest'){
    if(store.getters['authenticated']){
      next({name: 'ProjectsList'})
    }
  }
  if (to.matched.some(record => record.meta.requiresAuth)) {
    // this route requires auth, check if logged in
    // if not, redirect to login page.
    if (!store.getters['authenticated']) {
      next({name: 'HomeGuest'})
    } else {
      next()
    }
  } else {
    next() // make sure to always call next()!
  }
})

export default router;
