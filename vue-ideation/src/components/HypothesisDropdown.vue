
<template>
  <div class="container">
    <div class="select-box" :class="{disable: disableDropdown}">
      <div class="options-container" :class="{ active: selectedActive }">
        <div v-if="currentStep == 1 && disableDropdown == false">
          <div v-for="(option, index) in optionsValueFirst" :key="index">
            <div class="option" @click="handleOptions(option)">
              <input type="radio" class="radio" name="category" />
              <label :for="option">{{ option }}</label>
            </div>
          </div>
        </div>
        <transition name="fade" appear>
          <div
            v-if="
              currentStep == 2 && dropdownType == 'pain' && disableDropdown == false
            "
          >
            <div v-for="(option, index) in optionsValueSecond" :key="index">
              <div class="option" @click="handleOptions(option)">
                <input type="radio" class="radio" name="category" />
                <label :for="option">{{ option }}</label>
              </div>
            </div>
          </div>
        </transition>
      </div>
      <div class="selected" :class="{disable: disableDropdown}" :value="selectedValue" @click="toggleSelected">
        <div v-if="defaultDisplayCondition">Define {{ dropdownType }}</div>
        <div v-else>
          {{ selectedDisplay }}
        </div>
      </div>
    </div>
  </div>
</template>
  
<script>
export default {
  props: {
    dropdownType: {
      type: String,
    },
    optionsValueFirst: {
      type: Array,
      required: false,
    },
    optionsValueSecond: {
      type: Array,
      required: false,
    },
    currentIndex: {
      type: Number,
    },
    disableDropdown: {
      type: Boolean,
      default: false,
      required: false,
    },
    passedFrequency: {
      type: String,
      required: false,
      default: "",
    },
    passedSeverity: {
      type: String,
      required: false,
      default: "",
    },
    passedFeedback: {
      type: String,
      required: false,
      default: "",
    },
  },
  data() {
    return {
      selectedValue: {
        index: this.currentIndex,
        frequency: this.passedFrequency,
        severity: this.passedSeverity,
        feedback: this.passedFeedback,
      },
      selectedActive: false,
      currentStep: 1,
    };
  },
  mounted() {
    // if (
    //   this.$store.state.hypothesisRepository.hypothesis[this.currentIndex] !==
    //   undefined
    // ) {
    //   if (this.dropdownType == "pain") {
    //     let stateFrequency =
    //       this.$store.state.hypothesisRepository.hypothesis[this.currentIndex]
    //         .pain.frequency;
    //     let stateSeverity =
    //       this.$store.state.hypothesisRepository.hypothesis[this.currentIndex]
    //         .pain.severity;
    //     this.selectedValue.frequency = stateFrequency;
    //     this.selectedValue.severity = stateSeverity;
    //   } else if (this.dropdownType == "feedback") {
    //     let stateFeedback =
    //       this.$store.state.hypothesisRepository.hypothesis[this.currentIndex]
    //         .feedbackCycle;
    //     this.selectedValue.feedback = stateFeedback;
    //   }
    // }
  },
  computed: {
    selectedDisplay() {
      if (this.dropdownType == "pain") {
        return (
          this.selectedValue.frequency.substr(
            0,
            this.selectedValue.frequency.indexOf(" ")
          ) +
          " & " +
          this.selectedValue.severity.substr(
            0,
            this.selectedValue.severity.indexOf(" ")
          )
        );
      } else {
        return this.selectedValue.feedback;
      }
    },
    defaultDisplayCondition() {
      if (this.dropdownType == "pain") {
        return (
          this.dropdownType == "pain" &&
          this.selectedValue.frequency === "" &&
          this.selectedValue.severity === ""
        );
      } else if (this.dropdownType == "feedback") {
        return (
          this.dropdownType == "feedback" && this.selectedValue.feedback === ""
        );
      } else return console.log("Define Dropdown");
    },
  },
  methods: {
    toggleSelected() {
      if (this.disableDropdown == false) {
        this.selectedActive = !this.selectedActive;
      }
    },
    handleOptions(value) {
      if (this.currentStep == 1) {
        if (this.dropdownType == "pain") {
          this.currentStep = 2;
          this.selectedValue.frequency = value;
        } else if (this.dropdownType == "feedback") {
          this.toggleSelected();
          this.selectedValue.feedback = value;
          this.$emit("getHypothesisData", this.selectedValue);
        }
      } else if (this.currentStep == 2) {
        this.toggleSelected();
        setTimeout(() => {
          this.currentStep = 1;
        }, 230);
        this.selectedValue.severity = value;
        this.$emit("getHypothesisData", this.selectedValue);
      }
    },
  },
};
</script>

<style scoped lang = 'scss'>
.select-box {
  position: relative;
  display: flex;
  width: 200px;
  flex-direction: column;
  transition: all 0.3s ease 0s;
  /* &:hover {
    transform: translateY(-7px);
    z-index: 2;
  } */
  /* z-index: 99; */
}

.select-box .options-container {
  position: absolute;
  top: 55px;
  background: #2f3640;
  color: #f5f6fa;
  max-height: 0;
  width: 100%;
  opacity: 0;
  transition: all 0.4s;
  border-radius: 8px;
  overflow: hidden;
  order: 1;
  z-index: 99;
  transition: all 0.3s ease 0s;
  box-shadow: 0px 8px 15px rgb(0 0 0 / 21%);
  &:hover {
    transform: translateY(-7px);
  }
}

.selected {
  background: #2f3640;
  border-radius: 8px;
  margin-bottom: 8px;
  color: #f5f6fa;
  position: relative;
  order: 0;
}

.selected::after {
  content: "";
  background: url("../assets/img/arrow-down.svg");
  background-size: contain;
  background-repeat: no-repeat;

  position: absolute;
  height: 100%;
  width: 32px;
  right: 10px;
  top: 5px;

  transition: all 0.4s;
}

.select-box .options-container.active {
  max-height: 240px;
  opacity: 1;
  overflow-y: scroll;
}

.select-box .options-container.active + .selected::after {
  transform: rotateX(180deg);
  top: -6px;
}

.select-box .options-container::-webkit-scrollbar {
  width: 8px;
  background: #0d141f;
  border-radius: 0 8px 8px 0;
}

.select-box .options-container::-webkit-scrollbar-thumb {
  background: #525861;
  border-radius: 0 8px 8px 0;
}

.select-box .option,
.selected {
  padding: 12px 24px;
  cursor: pointer;
}

.disable{
  cursor:default;
  opacity: 0.9;
}

.select-box .option:hover {
  background: #414b57;
}

.select-box label {
  cursor: pointer;
}


.select-box .option .radio {
  display: none;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>

        