<template>
  <div class="container">
    <h1 :class="{ 'show-final': showFinal }">
      Thank you for your registration, {{ registerSteps[0].value }}
    </h1>
    <div
      class="register"
      :class="{
        wrong: wrongColor,
        wronganimation: wrongAnimation,
        okanimation: okAnimation,
        close: closeRegister,
      }"
      ref="register"
    >
      <x-mark
        v-if="position === 0"
        class="closeButton"
        @click.native="closeForm"
      ></x-mark>
      <arrow-left
        v-else
        class="previousButton"
        @click.native="previousStep"
      ></arrow-left>
      <arrow-right
        class="forwardButton"
        @click.native="checkStep"
      ></arrow-right>
      <div id="inputContainer" :class="{ showContainer: showContainer }">
        <form @submit.prevent="checkStep">
          <input
            id="inputField"
            :type="inputType"
            v-model="inputValue"
            ref="registerinput"
            required
          />
          <label id="inputLabel">{{ inputLabel }}</label>
        </form>
        <div id="inputProgress"></div>
      </div>
    </div>
  </div>
</template>

<script>
import xMark from "@/components/icons/x-mark.vue";
import ArrowLeft from "../../components/icons/arrow-left.vue";
import ArrowRight from "../../components/icons/arrow-right.vue";
export default {
  components: {
    xMark,
    ArrowLeft,
    ArrowRight,
  },
  data() {
    return {
      position: 0,
      inputLabel: "",
      inputType: "text",
      inputValue: "",
      showContainer: false,
      showFinal: false,
      progress: "0%",
      wrongAnimation: false,
      wrongColor: false,
      okAnimation: false,
      closeRegister: false,

      registerSteps: [
        {
          label: "What's Customer Name?",
          type: "text",
          value: "",
          pattern: /.+/,
        },
        {
          label: "What's Customer Occupation?",
          type: "text",
          value: "",
          pattern: /.+/,
        },
        {
          label: "What's Customer Email?",
          type: "text",
          value: "",
          pattern: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
        },
        {
          label: "Create your Phone Number",
          type: "phone",
          value: "",
          pattern: /^\d{10}$/,
        },
      ],
    };
  },
  methods: {
    closeForm() {
      this.$emit("closeForm");
    },
    setStep() {
      this.inputLabel = this.registerSteps[this.position].label;
      this.inputType = this.registerSteps[this.position].type;
      this.inputValue = this.registerSteps[this.position].value;
      this.$refs.registerinput.focus();
      this.showStep();
    },
    showStep() {
      setTimeout(() => {
        this.showContainer = true;
      }, 100);
    },
    hideStep(callback) {
      this.showContainer = false;
      setTimeout(callback, 100);
    },
    previousStep() {
      this.position -= 1;
      this.wrongColor = false;
      this.wrongAnimation = false;
      this.okAnimation = false;
      this.hideStep(this.setStep);
      this.setProgress();
    },
    checkStep() {
      if (!this.registerSteps[this.position].pattern.test(this.inputValue)) {
        this.wrongColor = true;
        this.wrongAnimation = true;
        setTimeout(() => {
          this.wrongAnimation = false;
        }, 500);
        this.$refs.registerinput.focus();
      } else {
        this.wrongColor = false;
        this.wrongAnimation = false;
        this.okAnimation = true;
        setTimeout(() => {
          this.okAnimation = false;
        }, 200);
        this.registerSteps[this.position].value = this.inputValue;
        this.position += 1;
        if (this.registerSteps[this.position]) {
          this.hideStep(this.setStep);
        } else {
          this.hideStep(() => {
            this.closeRegister = true;
            setTimeout(() => {
              this.showFinal = true;
            }, 1000);
          });
        }
      }
      this.setProgress();
    },
    setProgress() {
      this.progress = (this.position / this.registerSteps.length) * 100 + "%";
    },
  },
  mounted() {
    this.setStep();
  },
};
</script>

<style lang = 'scss' scoped>
.register {
  position: relative;
  width: 480px;
  height: 80px;
  padding: 10px;
  box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2), 0 10px 10px rgba(0, 0, 0, 0.2);
  background-color: #fff;
  
  &.close {
    width: 0;
    padding: 10px 0;
    overflow: hidden;
    transition: 0.8s ease-in-out;
    box-shadow: 0 16px 24px 2px rgba(0, 0, 0, 0.2);
  }
}

.closeButton {
  position: absolute;
  height: 25px;
  width: 25px;
  font-size: 1rem;
  margin-top: -5px;
  cursor: pointer;
  z-index: 20;
}

.previousButton {
  position: absolute;
  left: 20px;
  top: 12px;
  font-size: 1rem;
  color: #9e9e9e;
  cursor: pointer;
  z-index: 20;
}

.forwardButton {
  position: absolute;
  top: 20px;
  right: 20px;
  font-size: 3rem;
  color: #8743ff;
  cursor: pointer;
  z-index: 20;
}

.wrong .forwardButton {
  color: #d93f38;
}
.close .forwardButton,
.close .previousButton {
  color: #fff;
}

#inputContainer {
  position: relative;
  padding: 30px 20px 20px 20px;
  margin-right: 60px;
  opacity: 0;
  transition: opacity 0.3s ease-in-out;
  input {
    position: relative;
    width: 100%;
    font-size: 1.35rem;
    font-weight: bold;
    outline: 0;
    background: transparent;
    box-shadow: none;
    border: none;
    &:valid + #inputLabel {
      top: 3px;
      left: 42px;
      font-size: 0.7rem;
      font-weight: normal;
      color: #999;
    }
  }
}

#inputLabel {
  position: absolute;
  top: 32px;
  left: 20px;
  font-size: 1.35rem;
  font-weight: bold;
  pointer-events: none;
  transition: 0.2s ease-in-out;
}

#inputProgress {
  width: 0%;
  border-bottom: 6px solid #e7daff;
  transition: width 0.6s ease-in-out;
}

h1 {
  position: absolute;
  width: max-content;
  font-size: 2rem;
  color: #fff;
  opacity: 0;
  transition: 0.8s ease-in-out;

  &.show-final {
    opacity: 1;
  }
}

.wrong #inputProgress {
  border-color: #d93f38;
}
.showContainer {
  opacity: 1 !important;
  #inputProgress {
    width: 100%;
  }
}

.wronganimation {
  animation: 0.5s linear 0s 1 wrong-animation;
}
.okanimation {
  animation: 0.2s linear 0s 1 ok-animation;
}
@keyframes wrong-animation {
  0% {
    transform: translateX(0);
  }
  20% {
    transform: translateX(-20px);
  }
  40% {
    transform: translateX(20px);
  }
  60% {
    transform: translateX(-20px);
  }
  80% {
    transform: translateX(20px);
  }
  100% {
    transform: translateX(0);
  }
}
@keyframes ok-animation {
  0% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(10px);
  }
  100% {
    transform: translateY(0);
  }
}
</style>