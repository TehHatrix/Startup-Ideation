<template>
  <div id="app">
    <div v-if="authenticated" class="flex flex-row justify-center gap-4 my-5">
      <button @click="logout" class="px-4 py-2 leading-5 text-white transition-colors duration-200 transform bg-blue-500 rounded hover:bg-gray-600 focus:outline-none">Logout</button>
      <router-link :to="{name: 'ProjectsDashboard'}" class="px-4 py-2 leading-5 text-white transition-colors duration-200 transform bg-blue-500 rounded hover:bg-gray-600 focus:outline-none">Project Dashboard</router-link>
      <router-link :to="{name: 'Todo', params: {'projectId': project.id}}" class="px-4 py-2 leading-5 text-white transition-colors duration-200 transform bg-blue-500 rounded hover:bg-gray-600 focus:outline-none" v-if="project !== null" >Todo List</router-link>
    </div>
    <div v-else class="flex justify-center mt-10 gap-4">
      <router-link :to="{name: 'Login'}" class="p-1 border-2 border-green-300 border-opacity-75 bg-green-100 shadow-md">Login</router-link>
      <router-link :to="{name: 'Register'}" class="p-1 border-2 border-green-300 border-opacity-75 bg-green-100 shadow-md">Register</router-link>
    </div>
    <router-view></router-view>
  </div>
</template>

<script>
import {mapGetters} from 'vuex'
export default {
  methods: {
    async logout() {
      try {
        await this.$store.dispatch("logout");
        await this.$router.push({ name: "Login" });
      } catch (err) {
        console.log(err);
      }
    },
  },
  
  computed: {
    ...mapGetters([
      'authenticated',
      'project'
    ])
  }
};
</script>

