import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import '@/assets/style.css'
import Axios from 'axios'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faStar, faList, faCircleExclamation,faUsers, faBullseye, faScroll, faListCheck, faCheck, faXmark,faArrowLeft,faArrowRight, faPlusSquare, faEdit, faTrashAlt, faCalendarWeek, faCog, faBrain, faChalkboard, faUserEdit,faUserPlus, faPlus } from '@fortawesome/free-solid-svg-icons'
import { faCircleCheck } from '@fortawesome/free-regular-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import VueApexCharts from "vue-apexcharts";

/* add icons to the library */
library.add(faStar,faCircleExclamation,faUsers,faBullseye,faScroll,faListCheck,faCheck,faXmark,faArrowLeft,faArrowRight, faPlusSquare, faEdit, faTrashAlt, faCalendarWeek, faCog, faList,  faBrain, faChalkboard, faUserEdit, faUserPlus, faPlus,faCircleCheck)
Vue.use(VueApexCharts);


/* add font awesome icon component */
Vue.component('font-awesome-icon', FontAwesomeIcon)
Vue.component('apexchart', VueApexCharts)

// import { library } from '@fortawesome/fontawesome-svg-core'
// import { faPlusSquare, faEdit, faTrashAlt } from '@fortawesome/free-solid-svg-icons'
// import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

// library.add(faPlusSquare, faEdit, faTrashAlt)

// Vue.component('font-awesome-icon', FontAwesomeIcon)

// Vue.component('v-select', vSelect)
// Vue.use(vsSelect)
Vue.config.productionTip = false
Vue.prototype.$http = Axios;


new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
