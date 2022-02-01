<template>
  <div id="app">
    <div v-if="toastBoolean" class="wrapperToast">
      <transition name="fade">
        <general-toast></general-toast>
      </transition>
    </div>


    <sidebar v-if="authenticated && noSidebarRoute === false">
      <transition name="fade">
        <side-navbar>
          <router-view> </router-view>
        </side-navbar>
      </transition>
    </sidebar>

    <transition v-else name="fade">
      <navbar v-if="noNavbarRoute === false">
        <router-view> </router-view>
      </navbar>
      <router-view v-else></router-view>
    </transition>
    
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import GeneralToast from "./components/GeneralToast.vue";
import Sidebar from "./components/Sidebar.vue";
import SideNavbar from "./components/SidebarNav.vue";
// import Navbar from "./components/Navbar.vue";
export default {
  components: {
    GeneralToast,
    Sidebar,
    SideNavbar,
    // Navbar,
  },
  mounted() {
    console.log(this.$route.name)
  },
  computed: {
    ...mapGetters(["authenticated", "project"]),
    noNavbarRoute(){
      if (
        this.$route.name === "HomeGuest" || this.$route.name === "LandingEditor" || this.$route.name === "LandingPage" || this.$route.name === "SurveyShare" ||this.$route.name === "LandingPageShare" || this.$route.name === "LandingThankYou" ) {
        return true;
      }
      return false;
    },

    noSidebarRoute() {
      if (
        this.$route.name === "LandingEditor" ||
        this.$route.name === "LandingPage" ||
        this.$route.name === "SurveyShare" ||
        this.$route.name === "ProjectsList" || this.$route.name === "HomeGuest"  || this.$route.name === "LandingPageShare" || this.$route.name === "LandingThankYou"
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
/* .wrapperToast{
position:fixed;
top:0;
left: 0;
z-index: 10000000000000;
} */

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
  /* transition: all 0.5s ease; */
  transition: wobble 0.5s ease;
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

