<template>
  <div class="card">
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
          <h3>Survey completed! Thank you!</h3>
        </transition>
      </div>

      <div v-else-if="endQuestion === false">
        <div class="concludeQuestionContainer">
          <transition name="fade" appear>
            <div class="concludeQuestion" :key="currentQuestion">
              {{ appendProductQuestion(steps[currentStepsIndex].question) }}
            </div>
          </transition>
        </div>
        <!-- If answer is Objectives -->
        <div v-if="answerType === 'mcq'" class="concludeAnswerSubjective">
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
              v-model="currentMCQAnswer"
            />
            <label class="cbx" :for="index"
              ><span
                ><svg width="12px" height="9px" viewbox="0 0 12 9">
                  <polyline points="1 5 4 8 11 1"></polyline></svg></span
              ><span>{{ item }}</span></label
            >
          </div>
        </div>
        <!-- ! TODO: Create Handle Next/Step method -->
        <general-button @click.native="handleStep"> Next </general-button>
        <!-- If answer is Subjective -->
        <!-- <div class="concludeAnswer">
        <div class="answerCard" @click="handleStep('Yes')">
          <check></check> Yes
        </div>
        <div class="answerCard" @click="handleStep('No')">
          <x-Mark :toggleHover="false"></x-Mark> No
        </div>
      </div> -->
      </div>
    </div>
  </div>
</template>

<script>
// import xMark from "@/components/icons/x-mark.vue";
// import check from "@/components/icons/check.vue";
import CircularProgress from "../../components/CircularProgress.vue";
import Vue from "vue";
import VueConfetti from "vue-confetti";
import customerApi from "@/api/customerApi.js";
import { mapGetters } from "vuex";
import GeneralButton from "../../components/GeneralButton.vue";

Vue.use(VueConfetti);

export default {
  components: {
    // xMark,
    // check,
    CircularProgress,
    GeneralButton,
  },
  computed: {
    percentagePerSteps() {
      return 100 / this.steps.length;
    },
    answerType() {
      return this.steps[this.currentStepsIndex].type;
    },
    answers() {
      return this.steps[this.currentStepsIndex].answer;
    },

    ...mapGetters(["currentID", "interviewIndex"]),
  },

  data() {
    return {
      productName: "Mall Navigator",
      endQuestion: false,
      currentStepsIndex: 0,
      currentScore: 0,
      currentpercentageConclude: 0,
      currentMCQAnswer: "",
      customerAnswer: {
        discover: "",
        dissapointed: "",
        reasonDissapoint: "",
        alternative: "",
        benefits: "",
        recommendAny: "",
        personBenefit: "",
        improveSuggest: "",
        contacts: "",
      },
      addedScore: 1,
      steps: [
        {
          question: "How did you discover productName?",
          type: "mcq",
          answerQuestion: "discover",
          answer: [
            "Search engine (e.g. Google, Yahoo!)",
            "Facebook",
            "Twitter",
            "Blog",
            "Friend or colleague",
            "Other",
          ],
        },
        {
          question:
            "How would you feel if you could no longer use productName?",
          type: "mcq",
          answerQuestion: "dissapointed",
          answer: [
            "Very Disappointed",
            "Somewhat Disappointed",
            "Not Disappointed",
          ],
        },
        {
          question:
            "If productName is no longer available, what would you use as an alternative?",
          answerQuestion: "alternative",
          type: "mcq",
          answer: ["I probably wouldn’t use an alternative", "I would use"],
        },
        {
          question:
            "What is the primary benefit you received from productName?",
          answerQuestion: "benefits",
          type: "subjective",
          answer: "textinput",
        },
        {
          question: "Have you recommended productName to anyone?",
          answerQuestion: "recommendAny",
          type: "mcq",
          answer: ["No", "Yes"],
        },
        {
          question:
            "What type of person do you think would benefit most from productName?",
          answerQuestion: "personBenefit",
          type: "subjective",
          answer: "textinput",
        },
        {
          question: "How can we improve productName to better meet your needs?",
          answerQuestion: "improveSuggest",
          type: "subjective",
          answer: "textinput",
        },
        {
          question:
            "Would it be okay if we followed up by email to request a clarification to one or more of your responses?",
          answerQuestion: "contacts",
          type: "mcq",
          answer: ["No", "Yes"],
        },
      ],
    };
  },

  methods: {
    appendProductQuestion(question) {
      return question.replace("productName", this.productName);
    },

    handleStep() {
      this.checkAnswer();
      if (this.checkAnswer()) {
        this.customerAnswer[this.steps.answerQuestion] = this.currentMCQAnswer;
        this.currentMCQAnswer = "";
        console.log(this.customerAnswer);
        this.currentStepsIndex += 1;

        this.updatePercentage();
        this.checkEnd();
      }
    },
    checkAnswer() {
      if (this.currentMCQAnswer === "") {
        this.$store.commit("setTypeToast", "Error");
        this.$store.commit(
          "setMessage",
          "You have not checked the answer yet!"
        );
        this.$store.commit("showToast");
        return false;
      }
      return true;
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

    async updateScoreDatabase() {
      let conclude = {
        score: this.currentScore,
        interviewID: this.interviewIndex,
      };
      let updateScore = await customerApi.updateScoreCustomer(
        this.currentID,
        conclude
      );
      if (updateScore.success == false) {
        throw new Error("Could not update Customer Score");
      } else {
        setTimeout(() => {
          this.$router.go();
        }, 2300);
      }
    },
  },

  mounted() {},
};
</script>

<style lang="scss" scoped>
.checkboxGroup {
  margin: 15px;
}

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