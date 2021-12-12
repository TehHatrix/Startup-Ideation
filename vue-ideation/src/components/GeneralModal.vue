<template>
  <div id="modal-comp">
    <general-button class="button" @click.native="showModal = true">
      Start Interview
    </general-button>
    <transition name="fade" appear>
      <div
        class="modal-overlay"
        v-if="showModal"
        @click="showModal = false"
      ></div>
    </transition>
    <transition name="slide" appear>
      <div class="modal" v-if="showModal">
        <h1>Pre-Interview Form</h1>
        <p>Choose Learning Objectives</p>
        <p>Customize Interview Script</p>
        <general-button class="button" @click.native="showModal = false">
          Close</general-button
        >
        <general-button class="button" @click.native="routeInterview">
          Start Interview</general-button
        >
      </div>
    </transition>
  </div>
</template>

<script>
import GeneralButton from "./GeneralButton.vue";
export default {
  components: { GeneralButton },
  data() {
    return {
      showModal: false,
    };
  },
  methods: {
    routeInterview() {
      this.$emit("routeInterview");
    },
  },
};
</script>

<style lang = 'scss' scoped>
.modal {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 99;

  width: 100%;
  max-width: 500px;
  background-color: #fff;
  border-radius: 16px;

  padding: 25px;

  p {
    padding-top: 2px;
    padding-bottom: 3px;
  }
  .button {
    margin-right: 20px;
  }
}

.modal-overlay {
  position: absolute;
  top: 0;
  right: 0;
  left: 0;
  bottom: 0;
  z-index: 99;
  background-color: rgba(0, 0, 0, 0.3);
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}

.slide-enter-active,
.slide-leave-active {
  transition: transform 0.5s;
}

.slide-enter,
.slide-leave-to {
  transform: translateY(-50%) translateX(100vw);
}
</style>