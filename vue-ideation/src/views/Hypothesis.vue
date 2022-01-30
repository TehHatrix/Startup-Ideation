<template>
  <div>
    <div class="styled-table">
      <table>
        <thead>
          <tr>
            <th class="theadNone"></th>
            <th>Customer Segment</th>
            <th class="bridge"></th>
            <th>Problems</th>
            <th>Pain</th>
            <th>Feedback Cycle</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item, index) in custseg_data" :key="index">
            <div v-if="item.definedStatus" class="deleteEditButton">
              <disabled-button
                class="trashButton"
                @click.native="deleteHypothesis(item.hypothesisID)"
                ><font-awesome-icon icon="fa-solid fa-trash-can"
              /></disabled-button>
              <general-button-non-hover
                @click.native="updateHypothesis(index)"
                ><font-awesome-icon icon="fa-solid fa-pen-to-square"
              /></general-button-non-hover>
            </div>
            <div v-else></div>

            <td>
              <p id="cust_seg">{{ item.customerSegment }}</p>
            </td>
            <td>has a problems of</td>
            <td>
              <p id="problems">{{ item.problemsTopic }}</p>
            </td>
            <td id="freqSliders">
              <hypothesis-dropdown
                v-if="editable[index]"
                dropdownType="pain"
                :optionsValueFirst="frequency_data"
                :optionsValueSecond="severity_data"
                :passedFrequency="item.painFrequency"
                :passedSeverity="item.painSeverity"
                :disableDropdown="false"
                :currentIndex="index"
                @getHypothesisData="appendUpdateFrequencySeverity"
              ></hypothesis-dropdown>
              <hypothesis-dropdown
                v-else-if="item.definedStatus"
                dropdownType="pain"
                :passedFrequency="item.painFrequency"
                :passedSeverity="item.painSeverity"
                :disableDropdown="true"
                :currentIndex="index"
                @getHypothesisData="appendFrequencySeverity"
              ></hypothesis-dropdown>
              <hypothesis-dropdown
                v-else
                dropdownType="pain"
                :optionsValueFirst="frequency_data"
                :optionsValueSecond="severity_data"
                :currentIndex="index"
                @getHypothesisData="appendFrequencySeverity"
              ></hypothesis-dropdown>
            </td>

            <td id="feedSliders">
              <hypothesis-dropdown
                v-if="editable[index]"
                dropdownType="feedback"
                :optionsValueFirst="feedback_data"
                :passedFeedback="item.feedback"
                :disableDropdown="false"
                :currentIndex="index"
                @getHypothesisData="appendUpdateFeedback"
              ></hypothesis-dropdown>
              <hypothesis-dropdown
                v-else-if="item.definedStatus"
                dropdownType="feedback"
                :passedFeedback="item.feedback"
                :disableDropdown="true"
                :currentIndex="index"
                @getHypothesisData="appendFeedback"
              ></hypothesis-dropdown>
              <hypothesis-dropdown
                v-else
                dropdownType="feedback"
                :optionsValueFirst="feedback_data"
                :currentIndex="index"
                @getHypothesisData="appendFeedback"
              ></hypothesis-dropdown>
            </td>
            <td id="actionButton">
              <div v-if="editable[index]">
                <general-button
                  @click.native="handleSave(item.hypothesisID, index)"
                  >Update Hypothesis</general-button
                >
              </div>
              <div v-else-if="item.definedStatus">
                <general-button @click.native="handleResume(item.hypothesisID)"
                  >Resume Interview</general-button
                >
              </div>
              <div v-else-if="modaldisabled[index]">
                <disabled-button>Disabled</disabled-button>
              </div>
              <div v-else>
                <Modal
                  @routeInterview="routeInterview"
                  @clickedObjective="appendLearningObjectives"
                  @clickedGoal="appendGoal"
                  @click.native="handleModal(index)"
                >
                  <template #hypothesisTitle>
                    <h2>
                      {{ item.customerSegment }} has a problems of
                      {{ item.problemsTopic }}
                    </h2>
                  </template>
                </Modal>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import Modal from "../components/HypothesisModal.vue";
import HypothesisDropdown from "../components/HypothesisDropdown.vue";
import DisabledButton from "../components/DisabledButton.vue";
import hypothesisApi from "@/api/hypothesisApi";
import interviewApi from "@/api/interviewApi";
import GeneralButton from "../components/GeneralButton.vue";
import GeneralButtonNonHover from "../components/GeneralButtonNonHover.vue";
import { mapGetters } from "vuex";
export default {
  components: {
    Modal,
    HypothesisDropdown,
    DisabledButton,
    GeneralButton,
    GeneralButtonNonHover,
  },
  created() {
    this.getHypothesisData();
  },
  data() {
    return {
      updateFrequency: [],
      updateSeverity: [],
      updateFeedback: [],
      updateError: [],
      editable: [],
      modaldisabled: [],
      paindefined: [],
      feedbackdefined: [],
      feedback_data: [
        "A few months",
        "One month",
        "A few weeks",
        "One week",
        "A few days",
        "One day",
        "A few hours",
      ],
      frequency_data: [
        "Non-Recurring (1-Time)",
        "Yearly - Once or twice",
        "Quarterly - Once or twice",
        "Monthly - Once or twice",
        "Weekly - Once or twice",
        "Daily - Once or more",
      ],
      severity_data: [
        "Mild - Nagging, Annoying",
        "Moderate - Uncomfortable, Concerning",
        "Major - Interferes Significantly",
        "Severe - Disabling",
      ],
      custseg_data: null,
      defined_hypothesis: null,
      // hypothesis: [],
    };
  },
  computed: {
    ...mapGetters(["interviewIndex", "hypothesis", "currentIndex","currentProjectID"]),
  },
  methods: {
    async deleteHypothesis(hypothesisID) {
      await hypothesisApi.deleteHypothesis(hypothesisID);
      this.$router.go();
    },
    async updateHypothesis(index) {
      this.$set(this.editable, index, true);
    },
    show() {
      this.$modal.show("pre-interview-modal");
    },
    hide() {
      this.$modal.hide("pre-interview-modal");
    },
    async handleResume(hypothesisID) {
      let interviewID = await hypothesisApi.getinterviewbyHypothesis(
        hypothesisID
      );
      this.$store.commit("setInterviewIndex", interviewID.data);
      this.$router.push({
        name: "Interview",
        params: { id: interviewID.data },
      });
    },
    async handleSave(hypothesisID, index) {
      if (
        (this.updateFrequency[index] === undefined &&
        this.updateSeverity[index] === undefined &&
        this.updateFeedback[index] === undefined) || this.updateError[index] == true
      ) {
        this.$store.commit("setTypeToast", "Error");
        this.$store.commit(
          "setMessage",
          "You have nothing to update! Or fix the problem first."
        );
        this.$store.commit("showToast");
      }
      let payload = {
        pain_level_freq: this.updateFrequency[index],
        pain_level_severity: this.updateSeverity[index],
        feedback_cycle: this.updateFeedback[index],
      }
      let saveHypothesis = await hypothesisApi.updateHypothesis(hypothesisID,payload)
      if(saveHypothesis.data.success){
        this.$router.go();
      }
      else{
        console.log(saveHypothesis)
      }
    },
    async routeInterview() {
      try {
        let cust_seg =
          this.custseg_data[this.$store.state.hypothesisRepository.currentIndex]
            .customerSegment;
        let problem =
          this.custseg_data[this.$store.state.hypothesisRepository.currentIndex]
            .problemsTopic;
        this.$store.commit("setCustomerSegment", cust_seg);
        this.$store.commit("setProblems", problem);
        const hypothesisData = {
          problems:
            this.$store.state.hypothesisRepository.hypothesis[
              this.$store.state.hypothesisRepository.currentIndex
            ].problems,
          pain: {
            frequency:
              this.$store.state.hypothesisRepository.hypothesis[
                this.$store.state.hypothesisRepository.currentIndex
              ].pain.frequency,
            severity:
              this.$store.state.hypothesisRepository.hypothesis[
                this.$store.state.hypothesisRepository.currentIndex
              ].pain.severity,
          },
          feedbackCycle:
            this.$store.state.hypothesisRepository.hypothesis[
              this.$store.state.hypothesisRepository.currentIndex
            ].feedbackCycle,
        };
        let hypothesisResult = await hypothesisApi.addHypothesis(
          hypothesisData
        );
        let hypothesisIDdata = hypothesisResult.data.hypothesisID;
        const interviewData = {
          hypothesisID: hypothesisIDdata,
          script:
            this.$store.state.hypothesisRepository.hypothesis[
              this.$store.state.hypothesisRepository.currentIndex
            ].script,
          objective:
            this.$store.state.hypothesisRepository.hypothesis[
              this.$store.state.hypothesisRepository.currentIndex
            ].learningObjectives,
          goal: this.$store.state.hypothesisRepository.hypothesis[
            this.$store.state.hypothesisRepository.currentIndex
          ].goal,
          overallScore: 0.0,
          progress: 0,
        };
        let interviewResult = await interviewApi.createInterview(interviewData);
        if (hypothesisResult.data.success && interviewResult.data.success) {
          this.$store.commit(
            "setInterviewIndex",
            interviewResult.data.interviewID
          );
          this.$router.push({
            name: "Interview",
            params: { id: interviewResult.data.interviewID },
          });
        }
      } catch (error) {
        console.log(error);
      }
    },

    appendUpdateFrequencySeverity(value) {
      if (this.checkPainValue(value)) {
        this.$store.commit("setTypeToast", "Error");
        this.$store.commit(
          "setMessage",
          "Pain is not enough, try defining a more specific segment or problem"
        );
        this.$store.commit("showToast");
        this.$set(this.updateError, value.index, true);
        this.$set(this.paindefined, value.index, false);
        this.$set(this.modaldisabled, value.index, true);
      } else {
        this.$set(this.paindefined, value.index, true);
        this.$set(this.updateFrequency, value.index, value.frequency);
        this.$set(this.updateSeverity, value.index, value.severity);
        this.$set(this.updateError, value.index, false);
        if (this.feedbackdefined[value.index]) {
          this.$set(this.modaldisabled, value.index, false);
        }
      }
    },
    appendFrequencySeverity(value) {
      if (this.checkPainValue(value)) {
        this.$store.commit("setTypeToast", "Error");
        this.$store.commit(
          "setMessage",
          "Pain is not enough, try defining a more specific segment or problem"
        );
        this.$store.commit("showToast");
        this.$set(this.paindefined, value.index, false);
        this.$set(this.modaldisabled, value.index, true);
      } else {
        this.$set(this.paindefined, value.index, true);
        this.$store.dispatch("setPainValue", value);
        if (this.feedbackdefined[value.index]) {
          this.$set(this.modaldisabled, value.index, false);
        }
      }
    },
    appendFeedback(value) {
      if (value.feedback == "A few months") {
        this.$store.commit("setTypeToast", "Error");
        this.$store.commit(
          "setMessage",
          "Feedback Cycle is too slow, focus on a segment you can reach"
        );
        this.$store.commit("showToast");
        this.$set(this.feedbackdefined, value.index, false);
        this.$set(this.modaldisabled, value.index, true);
      } else {
        this.$set(this.feedbackdefined, value.index, true);
        this.$store.dispatch("setFeedbackValue", value);
        if (this.paindefined[value.index]) {
          this.$set(this.modaldisabled, value.index, false);
        }
      }
    },
    appendUpdateFeedback(value) {
      if (value.feedback == "A few months") {
        this.$store.commit("setTypeToast", "Error");
        this.$store.commit(
          "setMessage",
          "Feedback Cycle is too slow, focus on a segment you can reach"
        );
        this.$store.commit("showToast");
        this.$set(this.updateError, value.index, true);
        this.$set(this.feedbackdefined, value.index, false);
        this.$set(this.modaldisabled, value.index, true);
      } else {
        this.$set(this.feedbackdefined, value.index, true);
        this.$set(this.updateFeedback, value.index, value.feedback);
        this.$set(this.updateError, value.index, false);
        if (this.paindefined[value.index]) {
          this.$set(this.modaldisabled, value.index, false);
        }
      }
    },
    checkPainValue(value) {
      let frequencyFirstWord = value.frequency
        .substr(0, value.frequency.indexOf(" "))
        .replace("-", "");
      let severityFirstWord = value.severity
        .substr(0, value.severity.indexOf(" "))
        .replace("-", "");
      let negligiblePain = {
        NonRecurring: ["Mild", "Moderate"],
        Yearly: ["Mild", "Moderate"],
        Quarterly: ["Mild", "Moderate"],
        Monthly: ["Mild"],
      };
      if (negligiblePain[frequencyFirstWord] !== undefined) {
        for (var i = 0; i < negligiblePain[frequencyFirstWord].length; i++) {
          if (negligiblePain[frequencyFirstWord][i] === severityFirstWord) {
            return true;
          }
        }
      }
    },
    handleModal(index) {
      this.$store.state.hypothesisRepository.currentIndex = index;
    },
    appendLearningObjectives(value) {
      this.$store.dispatch("setLearningObjectives", value);
    },
    appendGoal(value) {
      this.$store.dispatch("setGoal", value);
    },

    findIndexMatchingID(object1, object2) {
      return object1.findIndex((h) => h.id == object2.id);
    },
    async getHypothesisData() {
      try {
        const customersegWithproblems = await this.$http.get(
          `http://localhost:80/api/getproblemswithcustSeg/${this.currentProjectID}`
        );
        const hypothesisData = await this.$http.get(
          `http://localhost:80/api/getproblemHypothesis/${this.currentProjectID}`
        );
        this.custseg_data = customersegWithproblems.data;
        this.defined_hypothesis = hypothesisData.data;
        for (let index in this.custseg_data) {
          // //if problem id in cust seg inside hypothesis
          let hypothesisIndex = this.findIndexMatchingID(
            this.defined_hypothesis,
            this.custseg_data[index]
          );
          if (hypothesisIndex != -1) {
            this.custseg_data[index].hypothesisID =
              this.defined_hypothesis[hypothesisIndex].hypothesis_ID;
            this.custseg_data[index].painSeverity =
              this.defined_hypothesis[hypothesisIndex].pain_level_severity;
            this.custseg_data[index].painFrequency =
              this.defined_hypothesis[hypothesisIndex].pain_level_freq;
            this.custseg_data[index].feedback =
              this.defined_hypothesis[hypothesisIndex].feedback_cycle;
            this.custseg_data[index].definedStatus = true;
          } else {
            this.custseg_data[index].definedStatus = false;
          }
          this.$store.dispatch("checkHypothesisInitialized", index);
          this.modaldisabled[index] = true;
        }
      } catch (error) {
        console.log(error);
      }
    },
  },
  mounted() {
  },
};
</script>

<style scoped lang = 'scss'>
* {
  margin: auto;
}

.theadNone {
  background: #f9f9f9;
}

.deleteEditButton {
  ::v-deep button {
    width: 40px;
    height: 30px;
    margin-top: 10px;
    cursor: pointer;
  }
}

#actionButton {
  ::v-deep button {
    margin-top: 5px;
  }
}

.styled-table {
  /* position:relative; */
  border-collapse: collapse;
  margin: 25px 0;
  font-size: 0.9em;
  width: auto;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
  border-radius: 5px 5px 0 0;
}

.styled-table thead tr {
  background: linear-gradient(180deg, #8743ff 0%, #4136f1 100%);
  color: #ffffff;
  text-align: center;
}

.styled-table tbody tr {
  border-bottom: thin solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
  background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
  border-bottom: 2px solid #8743ff;
}

#cust_seg,
#problems {
  font-weight: bold;
  text-align: center;
}

p {
  text-align: center;
}

#cust_seg {
  margin-right: 30px;
}
#freqSliders,
#feedSliders {
  padding-right: 30px;
}

#problems {
  margin-left: 30px;
  margin-right: 30px;
}
</style>