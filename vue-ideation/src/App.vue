<template>
  <div id="app" >
    <div v-if="authenticated" > 
      <button @click="logout" >Logout</button>
    </div>
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
        await this.$router.push({ name: "HomeGuest" });
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
</style>

