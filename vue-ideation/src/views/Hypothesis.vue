<template>
  <div>
    <div class="styled-table">
      <table>
        <thead>
          <tr>
            <th>Customer Segment</th>
            <th></th>
            <th>Problems</th>
            <th>Pain</th>
            <th>Feedback Cycle</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item, index) in custseg_data" :key="index">
            <td>
              <p id="cust_seg">{{ item.customerSegment }}</p>
            </td>
            <td>has a problems of</td>
            <td>
              <p id="problems">{{ item.problemsTopic }}</p>
            </td>
            <td id="freqSliders">
              <hypothesis-dropdown
                dropdownType="pain"
                :optionsValueFirst="frequency_data"
                :optionsValueSecond="severity_data"
                :currentIndex="index"
                @getHypothesisData="appendFrequencySeverity"
              ></hypothesis-dropdown>
            </td>

            <td id="feedSliders">
              <hypothesis-dropdown
                dropdownType="feedback"
                :optionsValueFirst="feedback_data"
                :currentIndex="index"
                @getHypothesisData="appendFeedback"
              ></hypothesis-dropdown>
            </td>
            <Modal
              @routeInterview="routeInterview"
              @clickedObjective="appendLearningObjectives"
              @click="handleModal(index)"
            >
              <template #hypothesisTitle>
                <h2>
                  {{ item.customerSegment }} has a problems of
                  {{ item.problemsTopic }}
                </h2>
              </template>
            </Modal>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import Modal from "../components/HypothesisModal.vue";
import HypothesisDropdown from "../components/HypothesisDropdown.vue";
export default {
  components: {
    Modal,
    HypothesisDropdown,
  },
  data() {
    return {
      pain_value1: [],
      pain_data1: ["1-Time", "Yearly", "Monthly", "Weekly", "Daily"],
      pain_value2: [],
      pain_data2: ["Mild", "Moderate", "Major", "Severe"],
      feedback_value: [],
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
        "Quarterly",
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
      hypothesis: [],
    };
  },
  methods: {
    show() {
      this.$modal.show("pre-interview-modal");
    },
    hide() {
      this.$modal.hide("pre-interview-modal");
    },
    routeInterview() {
      let cust_seg =
        this.custseg_data[this.$store.state.hypothesisRepository.currentIndex]
          .customerSegment;
      let problem =
        this.custseg_data[this.$store.state.hypothesisRepository.currentIndex]
          .problemsTopic;
      this.$store.commit("setCustomerSegment", cust_seg);
      this.$store.commit("setProblems", problem);
      console.log(this.$store.state.hypothesisRepository);
      this.$router.push("interview");
    },
    appendFrequencySeverity(value) {
      this.$store.dispatch("setPainValue", value);
    },
    appendFeedback(value) {
      this.$store.dispatch("setFeedbackValue", value);
    },
    handleModal(index) {
      
      this.$store.state.hypothesisRepository.currentIndex = index;
    },
    appendLearningObjectives(value) {
      this.$store.dispatch("setLearningObjectives", value);
    },
    async getHypothesisData() {
      try {
        const customersegWithproblems = await this.$http.get(
          "http://localhost:80/api/gethypothesisdata"
        );
        this.custseg_data = customersegWithproblems.data;
        for (let index in this.custseg_data) {
          this.$store.dispatch("checkHypothesisInitialized", index);
        }
      } catch (error) {
        console.log(error);
      }
    },
  },
  computed: {
  },
  created() {
    this.getHypothesisData();
  },
};
</script>

<style scoped>
* {
  margin: auto;
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