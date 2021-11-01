<template>
  <div id="app" >

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

<style>
#app{
  font-family: 'Poppins', 'sans-serif';
}
</style>

