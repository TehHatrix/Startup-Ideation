<template>
  <div class="tick-slider">
    <!-- <div class="tick-slider-header">
                <h5><label for="weightSlider">Total weight</label></h5>
                <h5>kg</h5>
            </div> -->
    <div v-if="type == 'Frequency'" class="tick-slider-value-container">
      <div id="weightLabelMin" class="tick-slider-label" ref="weightValueMin">
        Daily
      </div>
      <div id="weightLabelMax" class="tick-slider-label" ref="weightValueMax">
        Yearly
      </div>
      <div id="weightValue" class="tick-slider-value" ref="weightValue">
        {{ SliderLabelValue }}
      </div>
    </div>
    <div v-else-if="type == 'Severity'" class="tick-slider-value-container">
      <div id="weightLabelMin" class="tick-slider-label" ref="weightValueMin">
        Mild
      </div>
      <div id="weightLabelMax" class="tick-slider-label" ref="weightValueMax">
        Severe
      </div>
      <div id="weightValue" class="tick-slider-value" ref="weightValue">
        {{ SliderLabelValue }}
      </div>
    </div>
    <div v-else-if="type == 'Feedback'" class="tick-slider-value-container">
      <div id="weightLabelMin" class="tick-slider-label" ref="weightValueMin">
        Days
      </div>
      <div id="weightLabelMax" class="tick-slider-label" ref="weightValueMax">
        Months
      </div>
      <div id="weightValue" class="tick-slider-value" ref="weightValue">
        {{ SliderLabelValue }}
      </div>
    </div>
    <div class="tick-slider-background" id="slider-background"></div>
    <div
      id="weightProgress"
      class="tick-slider-progress"
      ref="weightProgress"
    ></div>
    <div
      id="weightTicks"
      class="tick-slider-tick-container"
      ref="weightTicks"
    ></div>
    <input
      id="weightSlider"
      class="tick-slider-input"
      type="range"
      ref="slider"
      :min="sliderMin"
      :max="sliderMax"
      step="1"
      v-model="modelValue"
      @input="onSliderInput()"
      @resize="onResize()"
      data-tick-step="1"
      data-tick-id="weightTicks"
      data-value-id="weightValue"
      data-progress-id="weightProgress"
      data-handle-size="18"
      data-min-label-id="weightLabelMin"
      data-max-label-id="weightLabelMax"
    />
  </div>
</template>

<script>
export default {
  props: {
    type: { type: String, modelValue: Number },
  },
  data() {
    return {
      SliderType: this.type,
      SliderLabelValue: "",
      modelValue: this.modelValue,
      sliderMin: 0,
      sliderMax: 3,
      currentSliderWidth: 0,
      currentValueWidth: 0,
    };
  },

  computed: {
    getSliderWidth: function () {
      return this.$refs.slider.getBoundingClientRect().width;
    },
    getValueWidth: function () {
      return this.$refs.weightValue.getBoundingClientRect().width;
    },
  },
  methods: {
    init: function () {
      // slider.oninput = onSliderInput;
      this.updateValue();
      this.updateValuePosition();
      this.updateLabels();
      this.updateProgress();
    },
    onSliderInput: function () {
      this.changeValue();
      this.updateValue();
      this.updateValuePosition();
      this.updateLabels();
      this.updateProgress();
    },
    changeValue() {
      this.$emit("input", this.modelValue);
    },

    updateValue: function () {
      let TextValue = "";
      if (this.SliderType === "Frequency") {
        if (this.modelValue === "0") {
          TextValue = "Daily";
          this.SliderLabelValue = TextValue;
        } else if (this.modelValue === "1") {
          TextValue = "Weekly";
          this.SliderLabelValue = TextValue;
        } else if (this.modelValue === "2") {
          TextValue = "Monthly";
          this.SliderLabelValue = TextValue;
        } else if (this.modelValue === "3") {
          TextValue = "Yearly";
          this.SliderLabelValue = TextValue;
        }
      }
      if (this.SliderType === "Severity") {
        if (this.modelValue === "0") {
          TextValue = "Mild";
          this.SliderLabelValue = TextValue;
        } else if (this.modelValue === "1") {
          TextValue = "Moderate";
          this.SliderLabelValue = TextValue;
        } else if (this.modelValue === "2") {
          TextValue = "Major";
          this.SliderLabelValue = TextValue;
        } else if (this.modelValue === "3") {
          TextValue = "Severe";
          this.SliderLabelValue = TextValue;
        }
      }
      if (this.SliderType === "Feedback") {
        if (this.modelValue === "0") {
          TextValue = "Days";
          this.SliderLabelValue = TextValue;
        } else if (this.modelValue === "1") {
          TextValue = "Weeks";
          this.SliderLabelValue = TextValue;
        } else if (this.modelValue === "2") {
          TextValue = "1 Month";
          this.SliderLabelValue = TextValue;
        }
        else if (this.modelValue === "3") {
          TextValue = "Months";
          this.SliderLabelValue = TextValue;
        }
      }
    },

    getSliderPercent: function () {
      const range = this.sliderMax - this.sliderMin;
      const absValue = this.modelValue - this.sliderMin;
      return absValue / range;
    },
    updateValuePosition: function () {
      //Issues:  Value not sync with width
      const percent = this.getSliderPercent(); //Progress Position
      // const sliderWidth = this.$refs.slider.getBoundingClientRect().width;
      const sliderWidth = this.getSliderWidth;
      const valueWidth = this.$refs.weightValue.getBoundingClientRect().width;
      const handleSize = this.$refs.slider.dataset.handleSize;
      let left =
        percent * (sliderWidth - handleSize) + handleSize / 2 - valueWidth / 2;

      left = Math.min(left, sliderWidth - valueWidth);
      left = this.modelValue === this.sliderMin ? 0 : left - 9;

      this.$refs.weightValue.style.left = left + "px";
    },
    updateLabels: function () {
      const value = this.$refs.weightValue;
      const minLabel = this.$refs.weightValueMin;
      const maxLabel = this.$refs.weightValueMax;

      const valueRect = value.getBoundingClientRect();
      const minLabelRect = minLabel.getBoundingClientRect();
      const maxLabelRect = maxLabel.getBoundingClientRect();

      const minLabelDelta = valueRect.left - minLabelRect.left;
      const maxLabelDelta = maxLabelRect.left - valueRect.left;

      const deltaThreshold = 32;

      if (minLabelDelta < deltaThreshold) minLabel.classList.add("hidden");
      else minLabel.classList.remove("hidden");

      if (maxLabelDelta < deltaThreshold) maxLabel.classList.add("hidden");
      else maxLabel.classList.remove("hidden");
    },
    updateProgress: function () {
      // let progress = document.getElementById(slider.dataset.progressId);
      let progress = this.$refs.weightProgress;
      const percent = this.getSliderPercent();
      progress.style.width = percent * 100 + "%";
    },
    setTicks: function () {
      let container = this.$refs.weightTicks;
      let slider = this.$refs.slider;
      const spacing = parseFloat(slider.dataset.tickStep);
      const sliderRange = this.sliderMax - this.sliderMin;
      const tickCount = sliderRange / spacing + 1; // +1 to account for
      for (let ii = 0; ii < tickCount; ii++) {
        let tick = document.createElement("span");
        tick.className = "tick-slider-tick";
        container.appendChild(tick);
      }
    },
    onResize: function () {
      // const sliders = document.getElementsByClassName("tick-slider-input");
      // for (let slider of sliders) {
      this.updateValuePosition();
      // }
    },
  },
  mounted() {
    this.init();
    // this.setTicks();
    // this.currentSliderWidth = this.getSliderWidth
    // this.currentValueWidth = this.getValueWidth
    // window.onload = updateValuePosition();
    // updateValuePosition();

    // }
    // function onSliderInput(event) {
    //   updateValue(event.target);
    //   updateValuePosition(event.target);
    //   updateLabels(event.target);
    //   updateProgress(event.target);
    // }
    // function updateValue(slider) {
    //   let value = document.getElementById(slider.dataset.valueId);
    //   var TextValue = "";
    //   if ($slidertype.type === "Frequency") {
    //     if (slider.value === "0") {
    //       TextValue = "Daily";
    //       value.innerHTML = "<div>" + TextValue + "</div>";
    //     } else if (slider.value === "1") {
    //       TextValue = "Weekly";
    //       value.innerHTML = "<div>" + TextValue + "</div>";
    //     } else if (slider.value === "2") {
    //       TextValue = "Monthly";
    //       value.innerHTML = "<div>" + TextValue + "</div>";
    //     } else if (slider.value === "3") {
    //       TextValue = "Yearly";
    //       value.innerHTML = "<div>" + TextValue + "</div>";
    //     } else {
    //       value.innerHTML = "<div>" + slider.value + "</div>";
    //     }
    //   } else if ($slidertype.type === "Severity") {
    //     if (slider.value === "0") {
    //       TextValue = "Mild";
    //       value.innerHTML = "<div>" + TextValue + "</div>";
    //     } else if (slider.value === "1") {
    //       TextValue = "Moderate";
    //       value.innerHTML = "<div>" + TextValue + "</div>";
    //     } else if (slider.value === "2") {
    //       TextValue = "Major";
    //       value.innerHTML = "<div>" + TextValue + "</div>";
    //     } else if (slider.value === "3") {
    //       TextValue = "Severe";
    //       value.innerHTML = "<div>" + TextValue + "</div>";
    //     } else {
    //       value.innerHTML = "<div>" + slider.value + "</div>";
    //     }
    //   }
    // }
    // function updateValuePosition(slider) {
    //   let value = document.getElementById(slider.dataset.valueId);
    //   const percent = this.getSliderPercent(slider);
    //   const sliderWidth = slider.getBoundingClientRect().width;
    //   const valueWidth = value.getBoundingClientRect().width;
    //   const handleSize = slider.dataset.handleSize;
    //   let left =
    //     percent * (sliderWidth - handleSize) + handleSize / 2 - valueWidth / 2;
    //   left = Math.min(left, sliderWidth - valueWidth);
    //   left = slider.value === slider.min ? 0 : left;
    //   value.style.left = left + "px";
    // }
    // function getSliderPercent(slider) {
    //   const range = slider.max - slider.min;
    //   const absValue = slider.value - slider.min;
    //   return absValue / range;
    // }
  },
};
</script>

<style lang = 'scss' scoped>
@import url("https://fonts.googleapis.com/css?family=Hind+Madurai:300,600|Poppins:300&display=swap");

* {
  box-sizing: border-box;
}

#sliderContainer {
  width: 100%;
  max-width: 400px;
  padding: 56px 40px;
}

/* .tick-slider-header {
  display: flex;
  justify-content: space-between;
  margin-bottom: 24px;
}

.tick-slider-header > h5 {
  margin: 2;

  font-family: "Poppins", sans-serif;
  font-size: 18px;
  font-weight: 300;
  color: #71738b;
} */

.tick-slider {
  position: relative;
  max-width: 400px;
  width: 100%;
}

.tick-slider-value-container {
  position: relative;
  width: 100%;

  display: flex;
  justify-content: space-between;
  align-items: center;

  margin-bottom: 12px;

  font-family: "Hind Madurai", sans-serif;
  font-size: 18px;
  color: #71738b;
}

.tick-slider-value {
  position: absolute;
  top: 0;
  font-weight: bold;

  color: #34385a;

  border-radius: 2px;
  animation: bulge 0.3s ease-out;
}

.tick-slider-value::v-deep div {
  animation: bulge 0.3s ease-out;
}

.tick-slider-background,
.tick-slider-progress,
.tick-slider-tick-container {
  position: absolute;
  bottom: 5px;
  left: 0;

  height: 6px;

  pointer-events: none;

  border-radius: 4px;

  z-index: 0;
}

.tick-slider-background {
  width: 100%;
  background-color: #e3e4e8;
}

.tick-slider-progress {
  background: linear-gradient(180deg, #8743ff 0%, #4136f1 100%);
}

.tick-slider-tick-container {
  width: 100%;

  display: flex;
  justify-content: space-between;
  align-items: center;

  padding: 0 calc(14px / 2);
}

.tick-slider-tick {
  width: 2px;
  height: 2px;

  border-radius: 50%;

  background-color: white;
}

.tick-slider-label {
  opacity: 0.85;
  transition: opacity 0.1s ease;
}

.tick-slider-label.hidden {
  opacity: 0;
}

@keyframes bulge {
  0% {
    transform: scale(1);
  }

  25% {
    transform: scale(1.1);
  }

  100% {
    transform: scale(1);
  }
}

input[type="range"] {
  -webkit-appearance: none;
  width: 100%;
  height: auto;
  background: transparent;
  outline: none;
  margin: 5px 0;
}

input[type="range"]::-webkit-slider-thumb {
  -webkit-appearance: none;

  border: none;
}

input[type="range"]:focus {
  outline: none;
}

input[type="range"]::-moz-focus-outer {
  border: 0;
}

input[type="range"]::-webkit-slider-thumb {
  -webkit-appearance: none;

  width: 14px;
  height: 14px;

  background: linear-gradient(180deg, #8743ff 0%, #4136f1 100%);

  border-radius: 2px;

  cursor: pointer;

  margin-top: -4px;

  -webkit-transform: scale(1);
  transform: scale(1);

  transition: transform 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

input[type="range"]:hover::-webkit-slider-thumb,
input[type="range"]:focus::-webkit-slider-thumb {
  transform: scale(1.2);
}

input[type="range"]::-moz-range-thumb {
  -webkit-appearance: none;

  width: 14px;
  height: 14px;

  background: linear-gradient(180deg, #8743ff 0%, #4136f1 100%);

  border: none;
  border-radius: 2px;

  cursor: pointer;

  transition: transform 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

input[type="range"]:hover::-moz-range-thumb,
input[type="range"]:focus::-moz-range-thumb {
  transform: scale(1.2);
}

input[type="range"]::-webkit-slider-runnable-track {
  width: 100%;
  height: 6px;

  cursor: pointer;

  background: none;

  border-radius: 4px;
}

input[type="range"]::-moz-range-track {
  width: 100%;
  height: 6px;

  cursor: pointer;

  background: none;

  border-radius: 4px;
}

input[type="range"]:focus::-webkit-slider-runnable-track {
  background: none;
}
input[type="range"]:active::-webkit-slider-runnable-track {
  background: none;
}
</style>