<template>
  <div>
    <!-- <img alt="Vue logo" src="../assets/logo.png"> -->
    <!-- <Modal /> -->
    <dropdown> </dropdown>
    <!-- <v-select></v-select> -->
    <GeneralModal></GeneralModal>
    <Slider type="Frequency" v-model="sliderValue[0]"></Slider>
    <div>{{ sliderValue[0] }}</div>
    <Slider type="Severity" v-model="sliderValue[1]"></Slider>
    <div>{{ sliderValue[1] }}</div>
    <Slider type="Frequency" v-model="sliderValue[2]"></Slider>
    <div>{{ sliderValue[2] }}</div>
    <Slider type="Frequency" v-model="sliderValue[3]"></Slider>
    <div>{{ sliderValue[3] }}</div>
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
  data() {
    return {
      sliderValue: [],
    };
  },
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
  mounted() {
    console.log(this)
    // this.show();
    // function setTicks(slider) {
    //   let container = document.getElementById(slider.dataset.tickId);
    //   const spacing = parseFloat(slider.dataset.tickStep);
    //   const sliderRange = slider.max - slider.min;
    //   const tickCount = sliderRange / spacing + 1; // +1 to account for
    //   for (let ii = 0; ii < tickCount; ii++) {
    //     let tick = document.createElement("span");
    //     tick.className = "tick-slider-tick";
    //     container.appendChild(tick);
    //   }
    // }
    // function init() {
    //   const sliders = document.getElementsByClassName("tick-slider-input");
    //   for (let slider of sliders) {
    //     // slider.oninput = onSliderInput;
    //     // updateValue(slider);
    //     // updateValuePosition(slider);
    //     // updateLabels(slider);
    //     // updateProgress(slider);
    //     setTicks(slider);
    //   }
    // }
    // function onResize() {
    //   const sliders = document.getElementsByClassName("tick-slider-input");
    //   for (let slider of sliders) {
    //     this.updateValuePosition(slider);
    //   }
    // }
    // window.onload = init();
    // window.addEventListener("resize", onResize);
  },
};
</script>

