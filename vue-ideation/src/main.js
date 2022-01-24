import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import '@/assets/style.css'
// import Axios from 'axios'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faStar, faList, faCircleExclamation,faUsers, faBullseye, faScroll, faListCheck, faCheck, faXmark,faArrowLeft,faArrowRight, faPlusSquare, faEdit, faTrashAlt, faCalendarWeek, faCog, faBrain, faChalkboard, faUserEdit,faUserPlus, faPlus, faCheckDouble, faPen, faCommentDots,faArrowUpFromBracket, faTrashCan,faPenToSquare,faMoneyCheckDollar } from '@fortawesome/free-solid-svg-icons'
import { faCircleCheck } from '@fortawesome/free-regular-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import VueApexCharts from "vue-apexcharts";
import 'remixicon/fonts/remixicon.css'
import Echo from 'laravel-echo'

import api from '@/api/config'
/* add icons to the library */
library.add(faStar,faCircleExclamation,faUsers,faBullseye,faScroll,faListCheck,faCheck,faXmark,faArrowLeft,faArrowRight, faPlusSquare, faEdit, faTrashAlt, faCalendarWeek, faCog, faList,  faBrain, faChalkboard, faUserEdit, faUserPlus, faPlus, faCheckDouble, faPen, faCommentDots,faCircleCheck,faArrowUpFromBracket,faTrashCan,faPenToSquare,faMoneyCheckDollar )
Vue.use(VueApexCharts);

// setup laravel echo for pusher 
window.Pusher = require('pusher-js')
window.Echo = new Echo({
  broadcaster: 'pusher',
  key: process.env.VUE_APP_PUSHER_KEY,
  cluster: process.env.VUE_APP_PUSHER_CLUSTER,
  encrypted: true,
  // eslint-disable-next-line no-unused-vars
  authorizer: (channel, options) => {
    return {
        authorize: (socketId, callback) => {
            api.post('api/broadcasting/auth', {
                socket_id: socketId,
                channel_name: channel.name
            })
            .then(response => {
                callback(false, response.data);
            })
            .catch(error => {
                callback(true, error);
            });
        }
    };
},
})


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
// Vue.prototype.$http = Axios;


new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
