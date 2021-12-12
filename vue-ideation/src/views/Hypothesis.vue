<template>
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
        <tr v-for="(item, index) in hypothesis_data" :key="index">
          <td>
            <p id="cust_seg">{{ item.customerSegment }}</p>
          </td>
          <td>has a problems of</td>
          <td>
            <p id="problems">{{ item.problemsTopic }}</p>
          </td>
          <td id="freqSliders">
            <p>Problems Frequency</p>
            <Slider type="Frequency" v-model="pain_value1[index]"></Slider>
            <p>Problems Severity</p>
            <Slider type="Severity" v-model="pain_value2[index]"></Slider>
          </td>

          <td id="feedSliders">
            <p>How long to interviews all the customer segments?</p>
            <Slider type="Feedback" v-model="feedback_value[index]"></Slider>
          </td>
          <Modal @routeInterview="routeInterview">
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
</template>

<script>
import Modal from "@/components/HypothesisModal.vue";
import Slider from "@/components/HypothesisSlider.vue";
export default {
  components: {
    Modal,
    Slider,
  },
  data() {
    return {
      pain_value1: [],
      pain_data1: ["1-Time", "Yearly", "Monthly", "Weekly", "Daily"],
      pain_value2: [],
      pain_data2: ["Mild", "Moderate", "Major", "Severe"],
      feedback_value: [],
      feedback_data: ["Months", "Weeks", "Few Days"],
      hypothesis_data: null,
    };
  },
  mounted() {},
  methods: {
    custseg_options() {
      const emptyarray = [];
      for (var item in this.hypothesis_data) {
        emptyarray.push(this.hypothesis_data[item][1]);
      }
      return emptyarray;
    },
    problems_options() {
      const emptyarray = [];
      for (var item in this.hypothesis_data) {
        emptyarray.push(this.hypothesis_data[item][2]);
      }
      return emptyarray;
    },
    show() {
      this.$modal.show("pre-interview-modal");
    },
    hide() {
      this.$modal.hide("pre-interview-modal");
    },
    routeInterview() {
      this.$router.push("interview");
    },
    async getHypothesisData() {
      try {
        const customersegWithproblems = await this.$http.get(
          "http://localhost:80/api/gethypothesisdata"
        );
        this.hypothesis_data = customersegWithproblems.data;
      } catch (error) {
        console.log(error);
      }
    },
  },
  computed: {
    setselected: function () {
      return 0;
    },
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