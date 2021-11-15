import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import '@/assets/style.css'
import Axios from 'axios'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faStar,faCircleExclamation,faUsers, faBullseye, faScroll, faListCheck, faCheck, faXmark,faArrowLeft,faArrowRight } from '@fortawesome/free-solid-svg-icons'
// import { faCirclePlus } from '@fortawesome/free-regular-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
// import vSelect from 'vue-select'
// import {vsSelect } from 'vuesax'
// import 'vuesax/dist/vuesax.css'

// Vue.component('v-select', vSelect)
// Vue.use(vsSelect)
/* add icons to the library */
library.add(faStar,faCircleExclamation,faUsers,faBullseye,faScroll,faListCheck,faCheck,faXmark,faArrowLeft,faArrowRight)

/* add font awesome icon component */
Vue.component('font-awesome-icon', FontAwesomeIcon)

Vue.config.productionTip = false
Vue.prototype.$http = Axios;


new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
