<template>
  <div id="app">
    <transition name="toast">
      <div v-if="toastBoolean">
        <general-toast></general-toast>
      </div>
    </transition>
    <sidebar v-if="authenticated && noSidebarRoute === false">
      <transition name="fade">
        <router-view> </router-view>
      </transition>
    </sidebar>
    <transition v-else name="fade">
      <router-view> </router-view>
    </transition>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import GeneralToast from "./components/GeneralToast.vue";
import Sidebar from "./components/Sidebar.vue";
export default {
  components: {
    GeneralToast,
    Sidebar,
  },
  computed: {
    ...mapGetters(["authenticated", "project"]),
    noSidebarRoute() {
      if (
        this.$route.name === "LandingEditor" ||
        this.$route.name === "LandingPage" || this.$route.name === "SurveyShare"
      ) {
        return true;
      }
      return false;
    },

    toastBoolean() {
      return this.$store.state.toastRepository.showToast;
    },
  },
};
</script>

<style>
#confetti-canvas {
  z-index: 1000;
}
/* .toast-enter-from {
  opacity: 0;
  transform: translateY(-60px);
}
.toast-enter-to {
  opacity: 1;
  transform: translateY(0);
} */

.fade-enter-active,
.fade-leave-active {
  transition-property: opacity;
  transition-duration: 0.25s;
}

.fade-enter-active {
  transition-delay: 0.25s;
}

.fade-enter,
.fade-leave-active {
  opacity: 0;
}

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

