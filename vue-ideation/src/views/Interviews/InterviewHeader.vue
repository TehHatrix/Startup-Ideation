<template>
  <div>
    <div class="card">
      <div class="overallScore">
        <p>Current Overall Score</p>
      </div>
      <div class="ratingStar">
        <span class="starsContainer">
          <h2 class="rating">{{ rating }} <stars class="star"></stars></h2>
        </span>
        <p class="totalInterview">{{ interviewGoals }} Interviews</p>
      </div>
      <div class="ratingCustomers">
        <span class="fiveStar">
          5 <font-awesome-icon icon="fa-solid fa-star" />
          <star-bar
            :currentInterviewNumber="getRatingCustomer(5)"
            :maxInterview="customerScoresLength"
          ></star-bar>
        </span>
        <span class="fourStar">
          4 <font-awesome-icon icon="fa-solid fa-star" />
          <star-bar
            :currentInterviewNumber="getRatingCustomer(4)"
            :maxInterview="customerScoresLength"
          ></star-bar>
        </span>
        <span class="threeStar"
          >3 <font-awesome-icon icon="fa-solid fa-star" />
          <star-bar
            :currentInterviewNumber="getRatingCustomer(3)"
            :maxInterview="customerScoresLength"
          ></star-bar
        ></span>
        <span class="twoStar"
          >2 <font-awesome-icon icon="fa-solid fa-star" />
          <star-bar
            :currentInterviewNumber="getRatingCustomer(2)"
            :maxInterview="customerScoresLength"
          ></star-bar
        ></span>
        <span class="oneStar"
          >1 <font-awesome-icon icon="fa-solid fa-star" />
          <star-bar
            :currentInterviewNumber="getRatingCustomer(1)"
            :maxInterview="customerScoresLength"
          ></star-bar
        ></span>
      </div>
      <div class="interviewData">
        <span class="problemSegment">
          <p>
            <font-awesome-icon icon="fa-solid fa-circle-exclamation" />
            <strong> Current Problem</strong> : {{ currentProblem }}
          </p>
          <p style="margin-left: 10px">
            <font-awesome-icon icon="fa-solid fa-users" />
            <strong> Customer Segment</strong> : {{ currentCustomerSegment }}
          </p>
        </span>
        <p class="customer-segment">
          <font-awesome-icon icon="fa-solid fa-bullseye" />
          <strong> Learning Objectives</strong> :
          {{ currentLearningObjectives }}
        </p>
        <p>
          <font-awesome-icon icon="fa-solid fa-scroll" />
          <strong> Interview Script </strong> :
          <span class="scriptLink" @click="handleScriptLink"
            >Click to see & edit</span
          >
        </p>
      </div>
      <div class="progressContainer">
        <div class="progress">
          <p>
            <font-awesome-icon icon="fa-solid fa-list-check" />
            <strong> Progress</strong>
          </p>
          <ProgressBar
            :interviewMax="interviewGoals"
            :currentCustomerLength="customerScoresLength"
            style="margin: auto"
          />
          <div v-if="interviewDone" class="interviewDone">
            <div v-if="rating >= 3.5">
              Completed. The problem is validated with
              <span style="color: #00a006">great</span> score! <br />
              This customer segment is a potential early adopter.
              <success-button @click.native="routeHypothesis"
                >Validate more customer!</success-button
              >
            </div>
            <div v-else class="bad">
              Completed. However, the score is
              <span style="color: #ff0000">bad</span>! <br />
              You may want to validate another customer.
              <disabled-button @click.native="routeHypothesis"
                >Re-define Hypothesis!</disabled-button
              >
            </div>
          </div>
          <p v-else>{{ progressInterview }} more interviews to go!</p>
        </div>
      </div>
    </div>
    <transition name="fade" appear>
      <div
        class="modal-overlay"
        v-if="scriptModal"
        @click="closeScriptModal"
      ></div>
    </transition>
    <transition name="fade" appear>
      <div class="customerInfoModal" v-if="scriptModal">
        <div class="modalContentContainer">
          <interview-logs-content
            :interviewLogsContent="interviewScript"
            @changeScript="updateScript"
            noteType="script"
          ></interview-logs-content>
          <div class="bottomButton">
            <general-button @click.native="closeScriptModal"
              >Close</general-button
            >
          </div>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
import Stars from "@/views/Interviews/Stars.vue";
import StarBar from "@/views/Interviews/StarBar.vue";
import ProgressBar from "@/views/Interviews/ProgressBar.vue";
import interviewApi from "@/api/interviewApi.js";
import hypothesisApi from "@/api/hypothesisApi.js";
import interviewLogsContent from "./InterviewLogsContent.vue";
import GeneralButton from "../../components/GeneralButtonNonHover.vue";
import SuccessButton from "../../components/SuccessButton.vue";
import DisabledButton from "../../components/DisabledButton.vue";
import { mapGetters } from "vuex";

export default {
  components: {
    StarBar,
    Stars,
    ProgressBar,
    interviewLogsContent,
    GeneralButton,
    SuccessButton,
    DisabledButton,
  },
  data() {
    return {
      scriptModal: false,
      interviewScript: "",
      rating: 0.0,
      interviewGoals: 0,
      currentProblem: "",
      customerScores: undefined,
      currentCustomerSegment: "Shopper",
      currentLearningObjectives:
        "Does the customer care enough about this problem?",
    };
  },
  methods: {
    updateScript(textObject){
      this.interviewScript = textObject.text
    },

    routeHypothesis() {
      this.$router.push({ name: "Hypothesis" });
    },

    handleScriptLink() {
      this.scriptModal = true;
    },
    closeScriptModal() {
      this.scriptModal = false;
    },
    async getInterviewData(id) {
      let interviewData = await interviewApi.getInterview(id);
      // this.rating = interviewData.data.interviewData[0].overall_score;
      this.interviewScript = interviewData.data.interviewData[0].script;
      this.customerScores = interviewData.data.interviewData[0].customerScore;
      let total = 0;
      for (let item in this.customerScores) {
        total += Number(this.customerScores[item]);
      }
      let average = total / this.customerScores.length;
      if (isNaN(average) || average === undefined) {
        average = 0;
      }
      this.rating = average;
      this.interviewGoals = interviewData.data.interviewData[0].goal;
      this.currentProblem = interviewData.data.interviewData[0].problems;
      this.currentCustomerSegment =
        interviewData.data.interviewData[0].custsegment;
      this.currentLearningObjectives =
        interviewData.data.interviewData[0].objective;
    },
    getRatingCustomer(rating) {
      if (this.customerScores !== undefined) {
        return this.customerScores.filter((el) => Math.trunc(el) === rating)
          .length;
      }
    },
  },
  computed: {
    ...mapGetters(["interviewIndex"]),
    interviewDone() {
      if (this.customerScores !== undefined) {
        if (this.interviewGoals - this.customerScores.length == 0) {
          return true;
        }
      }
      return false;
    },

    customerScoresLength() {
      return this.customerScores ? this.customerScores.length : 0;
    },
    progressInterview() {
      return this.customerScores
        ? this.interviewGoals - this.customerScores.length
        : 0;
    },
  },
  async created() {
    await this.getInterviewData(this.interviewIndex);
    //If Good score and reached goal
    if((this.interviewGoals - this.customerScores.length == 0) && this.rating >= 3.5){
      await hypothesisApi.setHypothesisValidated(this.interviewIndex);
    }

  },
};
</script>
<style lang = 'scss' scoped>
* {
  font-family: "Poppins";
}

.customerInfoModal {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 99;

  width: 100%;
  max-width: 1000px;
  background-color: #fff;
  border-radius: 16px;
  padding: 25px;
}

.bottomButton {
  display: flex;
  gap: 20px;
  margin-top: 20px;
}

.scriptLink {
  cursor: pointer;
  text-decoration: underline;
}
.rating {
  font-size: 35px;
  display: flex;
  margin-left: 10px;
}
.overallScore {
  margin-left: 13px;
  font-weight: bold;
  align-self: center;
}

.ratingStar {
  display: inline-block;
  #rating {
    font-weight: bold;
  }
  .totalInterview {
    margin-top: -35px;
  }
}

.modal-overlay {
  position: fixed;
  top: 0;
  right: 0;
  left: 0;
  bottom: 0;
  overflow: auto;
  z-index: 98;
  background-color: rgba(0, 0, 0, 0.3);
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}

.card {
  background: #fff;
  border-radius: 7px;
  display: flex;
  /* justify-content: center; */
  align-items: center;
  gap: 30px;
  height: auto;
  width: 98%;
  margin: auto;
  position: relative;
  top: 15px;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
  transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
  &:hover {
    box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
  }
  .ratingCustomers {
    display: flex;
    flex-direction: column;
    flex-grow: 1;
    margin-top: 10px;
    .fa-star {
      color: #e67100;
      font-size: 10px;
    }
    .fiveStar,
    .fourStar,
    .threeStar,
    .twoStar,
    .oneStar {
      display: flex;
      flex-direction: row;
      align-items: center;
    }
  }

  .interviewData {
    display: flex;
    flex-direction: column;
    align-content: center;
    font-size: 14px;
    .problemSegment {
      display: flex;
      flex-direction: row;
    }
  }
  .progress {
    display: flex;
    flex-direction: column;
    margin-right: 13px;
    gap: 5px;
    p {
      text-align: center;
    }
  }

  .bad {
    ::v-deep button {
      cursor: pointer;
    }
  }

  .interviewDone {
    text-align: center;
  }
}
</style>