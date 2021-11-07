<template>
  <div id="app">
    <router-view></router-view>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
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
    ...mapGetters(["authenticated", "project"]),
  },
};
</script>

  <style>
/* @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap");
#app {
  background: url("~@/assets/double-bubble-outline.png");
  z-index: -1;
  background-size: 200px 200px;
  background-repeat: repeat;
  font-family: "Poppins", sans-serif;
  font-size: 14px;
  line-height: 20px;
  letter-spacing: 0.1px;
} */
</style>

