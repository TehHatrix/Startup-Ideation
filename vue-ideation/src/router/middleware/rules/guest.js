import store from '@/store'

export default (to, from, next) => {
    if(store.getters['authenticated']) {
        next()
    } else {
        console.log(store.getters['authenticated'])
        console.log('from router guest failed')
        next({name: 'HomeGuest'})
    }
}