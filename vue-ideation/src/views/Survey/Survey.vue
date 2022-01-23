<template>
  <div>
    <div class="card">
      <div class="concludeContent">
        <div class="concludeHeader">
          <circular-progress></circular-progress>
          <p class="score">
            <strong>Current Score </strong>
            <span class="scoreNumber"
              ><strong>4</strong><font-awesome-icon icon="fa-solid fa-star"
            /></span>
          </p>
        </div>
        <div class="concludeQuestion">How did you discover Mall Navigator?</div>
        <div class="concludeAnswer">
          <div class="answerCard"><check></check> Sad</div>
          <div class="answerCard">
            <x-Mark :toggleHover="false"></x-Mark> Doesn't care
          </div>
        </div>
        <div
          class="checkboxGroup"
          v-for="(item, index) in answers"
          :key="index"
        >
          <input
            class="inp-cbx"
            :id="index"
            type="radio"
            style="display: none"
            :value="item"
            v-model ="currentAnswer"
          />
          <label class="cbx" :for="index"
            ><span
              ><svg width="12px" height="9px" viewbox="0 0 12 9">
                <polyline points="1 5 4 8 11 1"></polyline></svg></span
            ><span>{{ item }}</span></label
          >
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import circularProgress from "@/components/CircularProgress.vue";
import xMark from "@/components/icons/x-mark.vue";
import check from "@/components/icons/check.vue";
export default {
  components: {
    circularProgress,
    xMark,
    check,
  },
  data() {
    return {
      answers: ["Search engine (e.g. Google, Yahoo!)", "Facebook", "Twitter","Blog","Friend or colleague","Other (please specify)"],
      questions: ["How did you discover Mall Navigator?","How would you feel if you could no longer use Mall Navigator?"],
      currentQuestion: "",
      currentAnswer:"",
    };
  },
  methods: {
  },
};
</script>

<style lang="scss" scoped>
.card {
  border-radius: 7px;
  margin-left: 40px;
  background-color: #ffffff;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
  transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
  width: 95%;
  height: 600px;
  &:hover {
    box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
  }
}

.concludeContent {
  padding-top: 20px;
  padding-left: 30px;
}
.concludeHeader {
  display: flex;
  align-items: center;
  gap: 50px;
  .score {
    font-size: 20px;
  }
  .scoreNumber {
    font-size: 30px;
  }
}

.concludeQuestion {
  font-size: 40px;
  font-weight: bold;
  margin-top: 20px;
  margin-left: 30px;
}

.concludeAnswer {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 20px;
  gap: 100px;
  .answerCard {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    height: 160px;
    width: 160px;
    border-radius: 15px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
    cursor: pointer;
    transition: 0.2s ease-out;
    font-size: 40px;
    font-weight: bold;
    &:hover {
      transform: scale(1.1, 1.1);
      box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
        0 10px 10px rgba(0, 0, 0, 0.22);
    }
  }
}

.fa-star {
  color: #e67100;
  font-size: 20px;
}

.cbx {
  -webkit-user-select: none;
  user-select: none;
  -webkit-tap-highlight-color: transparent;
  cursor: pointer;
}

.cbx span {
  display: inline-block;
  vertical-align: middle;
  transform: translate3d(0, 0, 0);
}

.cbx span:first-child {
  position: relative;
  width: 24px;
  height: 24px;
  border-radius: 50%;
  transform: scale(1);
  vertical-align: middle;
  border: 1px solid #b9b8c3;
  transition: all 0.2s ease;
}

.cbx span:first-child svg {
  position: absolute;
  z-index: 1;
  top: 8px;
  left: 6px;
  fill: none;
  stroke: white;
  stroke-width: 2;
  stroke-linecap: round;
  stroke-linejoin: round;
  stroke-dasharray: 16px;
  stroke-dashoffset: 16px;
  transition: all 0.3s ease;
  transition-delay: 0.1s;
  transform: translate3d(0, 0, 0);
}

.cbx span:first-child:before {
  content: "";
  width: 100%;
  height: 100%;
  background: #506eec;
  display: block;
  transform: scale(0);
  opacity: 1;
  border-radius: 50%;
  transition-delay: 0.2s;
}

.cbx span:last-child {
  margin-left: 8px;
}

.cbx span:last-child:after {
  content: "";
  position: absolute;
  top: 8px;
  left: 0;
  height: 1px;
  width: 100%;
  background: #b9b8c3;
  transform-origin: 0 0;
  transform: scaleX(0);
}

.cbx:hover span:first-child {
  border-color: #626263;
}

.inp-cbx:checked + .cbx span:first-child {
  border-color: #626263;
  background: linear-gradient(180deg, #8743ff 0%, #4136f1 100%);
  animation: check 0.6s ease;
}

.inp-cbx:checked + .cbx span:first-child svg {
  stroke-dashoffset: 0;
}

.inp-cbx:checked + .cbx span:first-child:before {
  transform: scale(2.2);
  opacity: 0;
  transition: all 0.6s ease;
}

@keyframes check {
  50% {
    transform: scale(1.2);
  }
}
</style>