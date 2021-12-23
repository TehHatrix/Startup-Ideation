import store from '@/store'

export default (to, from, next) => {
    if(store.getters['authenticated']) {
        next({name: 'ProjectsList'})
    } else next({name: 'HomeGuest'})
}