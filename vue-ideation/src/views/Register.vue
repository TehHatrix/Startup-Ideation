<template lang="">
    <section class="mt-10">
        <div class="w-full max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-md ">
          <div class="px-6 py-4">
              <h2 class="text-3xl font-bold text-center text-gray-700 ">Startup Ideation</h2>

              <h3 class="mt-1 text-xl font-medium text-center text-gray-600 ">We are glad to serve you</h3>

              <form @submit.prevent="register">
                  <div class="w-full mt-4">
                      <input class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-md  focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" 
                      type="text" 
                      placeholder="name" 
                      aria-label="name"
                      v-model="form.name"
                      required />
                  </div>
                  
                  <div class="w-full mt-4">
                      <input class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-md  focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" 
                      type="email" 
                      placeholder="Email Address" 
                      aria-label="Email Address"
                      v-model="form.email"
                      required />
                  </div>

                  <div class="w-full mt-4">
                      <input class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-md  focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" 
                      type="password" 
                      placeholder="Password" 
                      aria-label="Password"
                      v-model="form.password"
                      required />
                  </div>

                  <div class="w-full mt-4">
                      <input class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-md  focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" 
                      type="password" 
                      placeholder="Confirm Password" 
                      aria-label="Confirm Password"
                      
                      v-model="form.password_confirmation"
                      required />
                  </div>

                  <div class="flex items-center justify-end mt-4">
                      <!-- <a href="#" class="text-sm text-gray-600 dark:text-gray-200 hover:text-gray-500">Forget Password?</a> -->
                      <button class="px-4 py-2 leading-5 w-24 text-white transition-colors duration-200 transform bg-blue-500 rounded hover:bg-gray-600 focus:outline-none" type="submit">Register</button>
                  </div>
              </form>
          </div>

          <div class="flex items-center justify-center py-4 text-center bg-gray-50 dark:bg-gray-700">
              <span class="text-sm text-gray-600 dark:text-gray-200">already have an account? </span>

              <a href="#" class="mx-2 text-sm font-bold text-blue-500 dark:text-blue-400 hover:underline">Login</a>
          </div>
        </div>
      </section> 
</template>
<script>
import auth from '@/api/authApi'

export default {
    name: 'Register',
    data() {
        return {
            form: {
                'name': '',
                'email': '',
                'password': '',
                'password_confirmation': '',
            },
            isRegisterSuccess: false
        }
    },
    methods: {
        async register() {
            try {
                await auth.createSession()
                let res = await auth.register(this.form)
                console.log(res)
                if(res.data.success === true) {
                    this.$router.push({name: 'Login'})
                }
                // if(!res.errors) {
                //     console.log(res.data.errors.email)
                // }
            } catch(error) {
                console.log(error)
                // console.log(res)
            } 
        }
    }
    
}
</script>
<style lang="">
    
</style>