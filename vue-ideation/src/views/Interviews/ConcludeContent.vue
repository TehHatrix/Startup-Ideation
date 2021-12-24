<template>
  <div class="concludeContent">
    <div class="concludeHeader">
      <circular-progress
        :passedPercentage="currentpercentageConclude"
      ></circular-progress>
      <p class="score">
        <strong>Current Score </strong>
        <transition name="fade" appear>
          <span class="scoreNumber" :key="currentScore"
            ><strong>{{ currentScore }}</strong
            ><font-awesome-icon icon="fa-solid fa-star"
          /></span>
        </transition>
      </p>
      <!-- <general-button class="stepbackButton" v-if="currentStepsIndex > 0 && endQuestion == false" @click.native="reduceStep()">Step Back</general-button> -->
    </div>

    <div class="showFinal" v-if="endQuestion === true">
      <transition name="fade" appear>
        <h3>Interview has been concluded and Score updated!</h3>
      </transition>
    </div>

    <div v-else-if="endQuestion === false">
      <div class="concludeQuestionContainer">
        <transition name="fade" appear>
          <div class="concludeQuestion" :key="currentQuestion">
            {{ currentQuestion }}
          </div>
        </transition>
      </div>
      <div class="concludeAnswer">
        <div class="answerCard" @click="handleStep('Yes')">
          <check></check> Yes
        </div>
        <div class="answerCard" @click="handleStep('No')">
          <x-Mark :toggleHover="false"></x-Mark> No
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import xMark from "@/components/icons/x-mark.vue";
import check from "@/components/icons/check.vue";
import CircularProgress from "../../components/CircularProgress.vue";
import Vue from "vue";
import VueConfetti from "vue-confetti";
import customerApi from "@/api/customerApi.js";
import { mapGetters } from 'vuex';

Vue.use(VueConfetti);

export default {
  components: {
    xMark,
    check,
    CircularProgress,
  },
  computed: {
    percentagePerSteps() {
      return 100 / this.steps.length;
    },
    ...mapGetters(['currentID'])
  },

  data() {
    return {
      endQuestion: false,
      currentStepsIndex: 0,
      currentScore: 0,
      currentQuestion: "Does this person care about the problem?",
      currentpercentageConclude: 0,
      addedScore: 1,
      steps: [
        {
          question: "Does this person care about the problem?",
          answer: "Yes",
          score: 1,
        },
        {
          question: "Is the problem frequent for him?",
        },
        {
          question: "Is the problem severe for him?",
        },
        {
          question: "Does he have a way to solve the problem?",
          answer: "No",
          score: 1,
        },
        {
          question:
            "Has he taken steps to find OR create a different solution?",
          answer: "Yes",
          score: 1,
        },
        {
          question: "Did he describe a specific solution WITHOUT your help?",
          answer: "Yes",
          score: 1,
        },
        {
          question: "Will he pay in advance for a solution?",
          answer: "Yes",
          score: 0.5,
        },
        {
          question: "Will he take part in more interviews?",
          answer: "Yes",
          score: 0.5,
        },
      ],
    };
  },

  methods: {
    handleStep(answer) {
      this.checkAnswer(answer);
      this.currentStepsIndex += 1;
      this.updatePercentage();
      this.checkEnd();
    },
    checkAnswer(answer){
      if (answer === this.steps[this.currentStepsIndex].answer) {
        this.currentScore += this.steps[this.currentStepsIndex].score;
      } else {
        if (
          this.steps[this.currentStepsIndex].question ===
            "Does he have a way to solve the problem?" ||
          this.steps[this.currentStepsIndex].question ===
            "Does this person care about the problem?"
        ) {
          this.endQuestionMethod();
        }
      }
    },
    checkEnd() {
      if (this.currentStepsIndex >= this.steps.length) {
        this.endQuestionMethod();
      } else {
        this.currentQuestion = this.steps[this.currentStepsIndex].question;
      }
    },

    endQuestionMethod() {
      this.endQuestion = true;
      this.updateScoreDatabase();
      this.$confetti.start();
      setTimeout(() => {
        this.$confetti.stop();
      }, 2000);
    },

    updatePercentage() {
      if (this.endQuestion) {
        this.currentpercentageConclude = 100;
      } else {
        this.currentpercentageConclude =
          this.percentagePerSteps * this.currentStepsIndex;
      }
    },

    async updateScoreDatabase(){
      // console.log(this.currentScore);
      // console.log(this.currentID);
      let conclude = {
        score: this.currentScore
      }
      let updateScore = await customerApi.updateScoreCustomer(this.currentID,conclude);
      if (updateScore.success == false){
        throw new Error('Could not update Customer Score')
      }
    }
    // reduceStep() {
    //   // this.currentStepsIndex -= 1;
    // },
  },

  mounted() {},
};
</script>

<style lang="scss" scoped>
.showFinal {
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  font-size: 40px;
}

.fa-star {
  color: #e67100;
  font-size: 20px;
}

.stepbackButton {
  margin-left: 400px;
}

.concludeHeader {
  display: flex;
  align-items: center;
  gap: 50px;
  .score {
    font-size: 20px;
  }
  .scoreNumber {
    position: absolute;
    margin-top: -10px;
    margin-left: 10px;
    font-size: 30px;
  }
}

.concludeQuestionContainer {
  position: relative;
  height: 50px;
  width: 100%;
}

.concludeQuestion {
  position: absolute;
  top: 0;
  left: 0;
  font-size: 40px;
  font-weight: bold;
  margin-top: 20px;
  margin-left: 30px;
}

.concludeAnswer {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 100px;
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

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>