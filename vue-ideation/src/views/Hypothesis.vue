<template>
  <div>
    <table>
      <tr>
        <th>Customer Segment</th>
        <th></th>
        <th>Problems</th>
        <th>Pain</th>
        <th>Feedback Cycle</th>
        <th>Action</th>
      </tr>
      <tr v-for="(item, index) in hypothesis_data" :key="index">
        <td>
          <p id="cust_seg">{{ selected_custseg[index] }}</p>
        </td>
        <td>has a problems of</td>
        <td>
          <p id="problems">{{ selected_problems[index] }}</p>
        </td>
        <td id ="freqSliders" >
          <p>Problems Frequency</p>
          <Slider type="Frequency" v-model="pain_value1[index]" ></Slider>
          <p>Problems Severity</p>
          <Slider type="Severity" v-model="pain_value2[index]"></Slider>
        </td>

        <td id = "feedSliders">
          <p>How long to interviews all the customer segments?</p>
          <Slider type="Feedback" v-model="feedback_value[index]"></Slider>
        </td>
        <Modal @routeInterview="routeInterview"></Modal>
      </tr>
    </table>
  </div>
</template>

<script>
import Modal from "@/components/GeneralModal.vue";
import Slider from "@/components/HypothesisSlider.vue";
export default {
  components: {
    Modal,
    Slider,
  },
  data() {
    return {
      hypothesis_data: null,
      pain_value1: [],
      pain_data1: ["1-Time", "Yearly", "Monthly", "Weekly", "Daily"],
      pain_value2: [],
      pain_data2: ["Mild", "Moderate", "Major", "Severe"],
      feedback_value: [],
      feedback_data: ["Months", "Weeks", "Few Days"],
      selected_custseg: [],
      selected_problems: [],
    };
  },
  mounted() {
    this.$http
      .get("http://localhost:80/api/gethypothesisdata")
      .then((response) => {
        this.hypothesis_data = response.data;
        for (let item in this.hypothesis_data) {
          this.selected_custseg[item] = this.hypothesis_data[item][1];
          this.selected_problems[item] = this.hypothesis_data[item][2];
        }
      })
      .catch((error) => console.log(error));
  },
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
    routeInterview(){
      this.$router.push('interview')
    }
  },
  computed: {
    setselected: function () {
      return 0;
    },
  },
};
</script>

<style scoped>

*{
  margin:auto;
}
#cust_seg,
#problems {
  font-weight: bold;
  text-align: center;
}

p{
  text-align: center;
}

#cust_seg{
  margin-right: 30px;
}
#freqSliders,#feedSliders{
  padding-right: 30px;
}

#problems {
  margin-left: 30px;
  margin-right: 30px;
}
</style>