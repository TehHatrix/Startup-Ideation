<template>
  <div id="app">
    <div v-if="authenticated">
      <button @click="logout">Logout</button>
    </div>
    <div v-if="toastBoolean">
      <transition name="toast">
        <general-toast></general-toast>
      </transition>
    </div>
    <router-view> </router-view>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import GeneralToast from "./components/GeneralToast.vue";
export default {
  components: {
    GeneralToast
  },
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
    toastBoolean() {
      return this.$store.state.toastRepository.showToast;
    },
  },
};
</script>

<style>
.toast-enter-from {
  opacity: 0;
  transform: translateY(-60px);
}
.toast-enter-to {
  opacity: 1;
  transform: translateY(0);
}
.toast-enter-active {
  transition: all 0.3s ease;
}
</style>

