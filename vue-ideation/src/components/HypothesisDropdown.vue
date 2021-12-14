
<template>
  <div class="container">
    <div class="select-box">
      <div class="options-container" :class="{ active: selectedActive }">
        <div v-if="currentStep == 1">
          <div v-for="(option, index) in optionsValueFirst" :key="index">
            <div class="option" @click="handleOptions(option)">
              <input type="radio" class="radio" name="category" />
              <label :for="option">{{ option }}</label>
            </div>
          </div>
        </div>
        <transition name="fade" appear>
          <div v-if="currentStep == 2 && dropdownType == 'pain'">
            <div v-for="(option, index) in optionsValueSecond" :key="index">
              <div class="option" @click="handleOptions(option)">
                <input type="radio" class="radio" name="category" />
                <label :for="option">{{ option }}</label>
              </div>
            </div>
          </div>
        </transition>
      </div>
      <div class="selected" :value="selectedValue" @click="toggleSelected">
        <div v-if="choosed == false">Define {{ dropdownType }}</div>
        <div v-else-if="choosed">
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
    },
    optionsValueSecond: {
      type: Array,
      required: false
    },
  },
  data() {
    return {
      selectedValue: {
        frequency: "",
        severity: "",
        feedback: "",
      },
      choosed: false,
      selectedActive: false,
      currentStep: 1,
    };
  },
  mounted() {},
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
  },
  methods: {
    toggleSelected() {
      this.selectedActive = !this.selectedActive;
    },
    toggleChoose() {
      this.choosed = true;
    },
    handleOptions(value) {
      if (this.currentStep == 1) {
        if (this.dropdownType == "pain") {
          this.currentStep = 2;
          this.selectedValue.frequency = value;
        } else if (this.dropdownType == "feedback") {
          this.toggleSelected();
          this.toggleChoose();
          this.selectedValue.feedback = value;
        }
      } else if (this.currentStep == 2) {
        this.toggleSelected();
        this.toggleChoose();
        setTimeout(() => {
          this.currentStep = 1;
        }, 230);
        this.selectedValue.severity = value;
      }
    },
  },
};
</script>

<style scoped lang = 'scss'>
.select-box {
  display: flex;
  width: 200px;
  flex-direction: column;
  z-index: 99;
}

.select-box .options-container {
  background: #2f3640;
  color: #f5f6fa;
  max-height: 0;
  width: 100%;
  opacity: 0;
  transition: all 0.4s;
  border-radius: 8px;
  overflow: hidden;
  order: 1;
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

        