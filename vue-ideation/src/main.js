import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import '@/assets/style.css'
import Axios from 'axios'
import vSelect from 'vue-select'
import vsSelect  from 'vuesax'
import 'vuesax/dist/vuesax.css'

import { library } from '@fortawesome/fontawesome-svg-core'
import { faPlusSquare } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faPlusSquare)

Vue.component('font-awesome-icon', FontAwesomeIcon)

Vue.component('v-select', vSelect)
Vue.use(vsSelect)
Vue.config.productionTip = false
Vue.prototype.$http = Axios;


new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
