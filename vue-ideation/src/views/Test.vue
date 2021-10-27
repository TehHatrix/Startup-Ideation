<template>
  <div>
    <!-- <img alt="Vue logo" src="../assets/logo.png"> -->
    <!-- <Modal /> -->
    <dropdown> </dropdown>
    <!-- <v-select></v-select> -->
    <GeneralModal></GeneralModal>
    <Slider type = "Frequency"></Slider>
  </div>
</template>

<script>
// @ is an alias to /s1rc
import Dropdown from "@/components/Dropdown.vue";
import GeneralModal from "@/components/GeneralModal.vue";
import Slider from "@/components/HypothesisSlider.vue";
// import Modal from "@/components/Modal.vue";
export default {
  name: "Test",
  components: {
    Dropdown,
    GeneralModal,
    Slider,
  },
  methods: {
    show() {
      this.$modal.show("my-first-modal");
    },
    hide() {
      this.$modal.hide("my-first-modal");
    },
  },
  // mounted() {
  //   this.show();
  // },
};
</script>

