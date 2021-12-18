<template>
  <div id="app">
    <div v-if="authenticated">
      <button @click="logout">Logout</button>
    </div>
    <transition name="toast">
      <div v-if="toastBoolean">
        <general-toast></general-toast>
      </div>
    </transition>

    <router-view> </router-view>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import GeneralToast from "./components/GeneralToast.vue";
export default {
  components: {
    GeneralToast,
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
/* .toast-enter-from {
  opacity: 0;
  transform: translateY(-60px);
}
.toast-enter-to {
  opacity: 1;
  transform: translateY(0);
} */

.toast-enter-active {
  transition: all 0.5s ease;
  /* transition: wobble 0.5s ease; */
}

.toast-leave-from {
  opacity: 1;
  transform: translateY(0);
}

.toast-leave-to {
  opacity: 0;
  transform: translateY(-60px);
}

.toast-leave-active {
  transition: all 0.3s ease;
}

@keyframes wobble {
  0% {
    transform: translateY(-60px);
    opacity: 0;
  }
  50% {
    transform: translateY(0px);
    opacity: 1;
  }
  60% {
    transform: translateX(8px);
  }
  70% {
    transform: translateX(-8px);
  }
  80% {
    transform: translateX(4px);
  }
  90% {
    transform: translateX(-4px);
  }
  100% {
    transform: translateX(0);
  }
}
</style>

