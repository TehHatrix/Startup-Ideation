<template lang="">
    <div>
      <!-- <div class="auth-card">
        <div class="auth-body">
            <h2>Startup Ideation</h2>

            <h3 class="text-xl font-medium text-center">Welcome Back</h3>

            <p class="mt-1 text-center text-gray-500 ">Login or create account</p>

            <form @submit.prevent="login">
                <div class="w-full mt-4">
                    <input class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-md dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" 
                    type="email" 
                    placeholder="Email Address" 
                    aria-label="Email Address"
                    v-model="form.email"
                    required />
                </div>

                <div class="w-full mt-4">
                    <input class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-md dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" 
                    type="password" 
                    placeholder="Password" 
                    aria-label="Password"
                    v-model="form.password"
                    required />
                </div>

                <div class="flex items-center justify-between mt-4">
                    <a href="#" class="text-sm text-gray-600 dark:text-gray-200 hover:text-gray-500">Forget Password?</a>

                    <button class="px-4 py-2 leading-5 text-white transition-colors duration-200 transform bg-blue-500 rounded hover:bg-gray-600 focus:outline-none" type="submit">Login</button>
                </div>
            </form>
        </div>

        <div class="flex items-center justify-center py-4 text-center bg-gray-50 dark:bg-gray-700">
            <span class="text-sm text-gray-600 dark:text-gray-200">Don't have an account? </span>

            <a href="#" class="mx-2 text-sm font-bold text-blue-500 dark:text-blue-400 hover:underline">Register</a>
        </div>
      </div> -->

      
    </div>
</template>
<script>
export default {
  name: "Login",
  data() {
    return {
      form: {
        email: "",
        password: "",
      },
    };
  },
  methods: {
    async login() {
      try {
        await this.$store.dispatch("login", this.form);
        await this.$router.push({ name: "ProjectsDashboard" });
      } catch (error) {
        console.log(error);
      }
    },
  },
};
</script>
<style lang="">
</style>