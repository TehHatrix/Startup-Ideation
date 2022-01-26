import axios from 'axios'


let instance = axios.create({
    baseURL: 'http://localhost',
    withCredentials: true
})

instance.interceptors.request.use( request => {
    request.headers.common['Accept'] = 'application/json'
    // request.headers.common['Accept'] = 'multipart/form-data'
    // request.headers.common['Access-Control-Allow-Origin'] = '*';
    // request.headers.common['content-type'] = 'application/json' 
    // request.headers.common['Content-Type'] = 'multipart/form-data'
    return request
})

instance.interceptors.response.use( 
    response => response,
    error => {
        if(error.response.status === 401) {
            localStorage.removeItem('user')
            window.location.reload()
        }
        return Promise.reject(error)
    }
)

export default instance
    

