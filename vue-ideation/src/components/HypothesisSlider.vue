<template>
    <div class="tick-slider">
      <!-- <div class="tick-slider-header">
                <h5><label for="weightSlider">Total weight</label></h5>
                <h5>kg</h5>
            </div> -->
      <div v-if="type == 'Frequency'" class="tick-slider-value-container">
        <div id="weightLabelMin" class="tick-slider-label">Daily</div>
        <div id="weightLabelMax" class="tick-slider-label">Yearly</div>
        <!-- <div id="weightValue" class="tick-slider-value">
          {{ SliderLabelValue }}
        </div> -->
        <div id="weightValue" class="tick-slider-value"></div>
      </div>
      <div v-else-if="type == 'Severity'" class="tick-slider-value-container">
        <div id="weightLabelMin" class="tick-slider-label">Mild</div>
        <div id="weightLabelMax" class="tick-slider-label">Severe</div>
        <!-- <div id="weightValue" class="tick-slider-value" ref="weightValue">
          {{ SliderLabelValue }}
        </div> -->
        <div id="weightValue" class="tick-slider-value"></div>
      </div>
      <div class="tick-slider-background" id="slider-background"></div>
      <div id="weightProgress" class="tick-slider-progress"></div>
      <div id="weightTicks" class="tick-slider-tick-container"></div>
      <input
        id="weightSlider"
        class="tick-slider-input"
        type="range"
        ref="slider"
        min="0"
        max="3"
        step="1"
        value="0"
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
    type: { type: String },
  },
  data() {
    return {
      SliderType: this.type,
      SliderValue: 0,
      SliderLabelValue: "",
      sliderMin: 0,
      sliderMax: 3,
      // sliderValue: 0,
      // sliderValuePosition: 0,
      // sliderLabel: 'meow',
      // sliderProgress: 0,
    };
  },
  // methods: {
  //   init: function () {
  //     setTicks(slider);
  //     const sliders = document.getElementsByClassName("tick-slider-input");

  //     for (let slider of sliders) {
  //       slider.oninput = onSliderInput;
  //       updateValue(slider, SliderType);
  //       updateValuePosition(slider);
  //       updateLabels(slider);
  //       updateProgress(slider);
  //       setTicks(slider);
  //     }
  //   },
  // onSliderInput: function () {
  //   this.updateValue();
  //   this.updateValuePosition();
  //   this.updateLabels();
  //   this.updateProgress();
  // },
  // updateValue: function () {
  //   // let value = document.getElementById(slider.dataset.valueId);
  //   let TextValue = "";
  //   if (this.SliderType === "Frequency") {
  //     if (this.SliderValue === "0") {
  //       TextValue = "Daily";
  //       // value.innerHTML = "<div>" + TextValue + "</div>";
  //       this.SliderLabelValue = TextValue;
  //     } else if (this.SliderValue === "1") {
  //       TextValue = "Weekly";
  //       this.SliderLabelValue = TextValue;
  //       // value.innerHTML = "<div>" + TextValue + "</div>";
  //     } else if (this.SliderValue === "2") {
  //       TextValue = "Monthly";
  //       this.SliderLabelValue = TextValue;
  //     } else if (this.SliderValue === "3") {
  //       TextValue = "Yearly";
  //       this.SliderLabelValue = TextValue;
  //     } else {
  //       this.SliderLabelValue = TextValue;
  //       // value.innerHTML = "<div>" + slider.value + "</div>";
  //     }
  //   }
  // },
  // updateValuePosition: function () {
  //   // let value = document.getElementById(slider.dataset.valueId);
  //   const percent = this.getSliderPercent;
  //   const sliderWidth = this.$refs.slider.getBoundingClientRect().width;
  //   const valueWidth = this.$refs.weightValue.getBoundingClientRect().width;
  //   const handleSize = 18;

  //   let left =
  //     percent * (sliderWidth - handleSize) + handleSize / 2 - valueWidth / 2;

  //   left = Math.min(left, sliderWidth - valueWidth);
  //   left = this.SliderValue === this.sliderMin ? 0 : left;

  //   return left;

  //   value.style.left = left + "px";
  // },
  // getSliderPercent: function () {
  //   const range = sliderMax - sliderMin;
  //   const absValue = SliderValue - sliderMin;

  //   return absValue / range;
  // },
  //   updateLabels: function () {
  //     const value = document.getElementById(slider.dataset.valueId);
  //     const minLabel = document.getElementById(slider.dataset.minLabelId);
  //     const maxLabel = document.getElementById(slider.dataset.maxLabelId);

  //     const valueRect = value.getBoundingClientRect();
  //     const minLabelRect = minLabel.getBoundingClientRect();
  //     const maxLabelRect = maxLabel.getBoundingClientRect();

  //     const minLabelDelta = valueRect.left - minLabelRect.left;
  //     const maxLabelDelta = maxLabelRect.left - valueRect.left;

  //     const deltaThreshold = 32;

  //     if (minLabelDelta < deltaThreshold) minLabel.classList.add("hidden");
  //     else minLabel.classList.remove("hidden");

  //     if (maxLabelDelta < deltaThreshold) maxLabel.classList.add("hidden");
  //     else maxLabel.classList.remove("hidden");
  //   },
  //   updateProgress: function () {
  //     let progress = document.getElementById(slider.dataset.progressId);
  //     const percent = getSliderPercent(slider);

  //     progress.style.width = percent * 100 + "%";
  //   },

  //   setTicks: function () {
  //     let container = document.getElementById(slider.dataset.tickId);
  //     const spacing = parseFloat(slider.dataset.tickStep);
  //     const sliderRange = slider.max - slider.min;
  //     const tickCount = sliderRange / spacing + 1; // +1 to account for

  //     for (let ii = 0; ii < tickCount; ii++) {
  //       let tick = document.createElement("span");

  //       tick.className = "tick-slider-tick";

  //       container.appendChild(tick);
  //     }
  //   },
  //   onResize: function () {
  //     const sliders = document.getElementsByClassName("tick-slider-input");

  //     for (let slider of sliders) {
  //       updateValuePosition(slider);
  //     }
  //   },
  // },
  mounted() {
    let $slidertype = this;
    function init() {
      const sliders = document.getElementsByClassName("tick-slider-input");

      for (let slider of sliders) {
        slider.oninput = onSliderInput;
        updateValue(slider);
        updateValuePosition(slider);
        updateLabels(slider);
        updateProgress(slider);
        setTicks(slider);
      }
    }

    function onSliderInput(event) {
      updateValue(event.target);
      updateValuePosition(event.target);
      updateLabels(event.target);
      updateProgress(event.target);
    }

    function updateValue(slider) {
      let value = document.getElementById(slider.dataset.valueId);
      var TextValue = "";
      if ($slidertype.type === "Frequency") {
        if (slider.value === "0") {
          TextValue = "Daily";
          value.innerHTML = "<div>" + TextValue + "</div>";
        } else if (slider.value === "1") {
          TextValue = "Weekly";
          value.innerHTML = "<div>" + TextValue + "</div>";
        } else if (slider.value === "2") {
          TextValue = "Monthly";
          value.innerHTML = "<div>" + TextValue + "</div>";
        } else if (slider.value === "3") {
          TextValue = "Yearly";
          value.innerHTML = "<div>" + TextValue + "</div>";
        } else {
          value.innerHTML = "<div>" + slider.value + "</div>";
        }
      }
      else if ($slidertype.type === "Severity") {
        if (slider.value === "0") {
          TextValue = "Mild";
          value.innerHTML = "<div>" + TextValue + "</div>";
        } else if (slider.value === "1") {
          TextValue = "Moderate";
          value.innerHTML = "<div>" + TextValue + "</div>";
        } else if (slider.value === "2") {
          TextValue = "Major";
          value.innerHTML = "<div>" + TextValue + "</div>";
        } else if (slider.value === "3") {
          TextValue = "Severe";
          value.innerHTML = "<div>" + TextValue + "</div>";
        } else {
          value.innerHTML = "<div>" + slider.value + "</div>";
        }
      }
    }

    function updateValuePosition(slider) {
      let value = document.getElementById(slider.dataset.valueId);

      const percent = getSliderPercent(slider);
      const sliderWidth = slider.getBoundingClientRect().width;
      const valueWidth = value.getBoundingClientRect().width;
      const handleSize = slider.dataset.handleSize;

      let left =
        percent * (sliderWidth - handleSize) + handleSize / 2 - valueWidth / 2;

      left = Math.min(left, sliderWidth - valueWidth);
      left = slider.value === slider.min ? 0 : left;

      value.style.left = left + "px";
    }

    function updateLabels(slider) {
      const value = document.getElementById(slider.dataset.valueId);
      const minLabel = document.getElementById(slider.dataset.minLabelId);
      const maxLabel = document.getElementById(slider.dataset.maxLabelId);

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
    }

    function updateProgress(slider) {
      let progress = document.getElementById(slider.dataset.progressId);
      const percent = getSliderPercent(slider);

      progress.style.width = percent * 100 + "%";
    }

    function getSliderPercent(slider) {
      const range = slider.max - slider.min;
      const absValue = slider.value - slider.min;

      return absValue / range;
    }

    function setTicks(slider) {
      let container = document.getElementById(slider.dataset.tickId);
      const spacing = parseFloat(slider.dataset.tickStep);
      const sliderRange = slider.max - slider.min;
      const tickCount = sliderRange / spacing + 1; // +1 to account for

      for (let ii = 0; ii < tickCount; ii++) {
        let tick = document.createElement("span");

        tick.className = "tick-slider-tick";

        container.appendChild(tick);
      }
    }

    function onResize() {
      const sliders = document.getElementsByClassName("tick-slider-input");

      for (let slider of sliders) {
        updateValuePosition(slider);
      }
    }

    window.onload = init();
    window.addEventListener("resize", onResize);
  },
};
</script>

<style lang = 'scss' scoped>
@import url("https://fonts.googleapis.com/css?family=Hind+Madurai:300,600|Poppins:300&display=swap");

/* :root {
  --yellow: #ffd049;
  --purple: #4136f1;
  --light-yellow: #fdf2d2;
  --orange: #ffa929;
  --light-gray: #e3e4e8;
  --gray: #71738b;
  --light-blue: #7a7c93;
  --blue: #34385a;

  --slider-handle-size: 14px;
  --slider-handle-border-radius: 2px;
  --slider-handle-margin-top: -4px;
  --slider-track-height: 6px;
  --slider-track-border-radius: 4px;
} */

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