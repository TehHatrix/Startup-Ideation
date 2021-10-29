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
          <v-select
            v-model="selected_custseg[index]"
            v-bind:options="custseg_options()"
          ></v-select>
        </td>
        <td>has a problems of</td>
        <td>
          <v-select
            v-model="selected_problems[index]"
            v-bind:options="problems_options()"
          ></v-select>
        </td>
        <td>
          <p>Problems Frequency</p>
          <vue-slider
            v-model="pain_value1[index]"
            :adsorb="true"
            :data="pain_data1"
            :marks="true"
          ></vue-slider>
          <p>Problems Severity</p>
          <vue-slider
            v-model="pain_value2[index]"
            :adsorb="true"
            :data="pain_data2"
            :marks="true"
          ></vue-slider>
        </td>

        <td>
          <p>How long to interviews all the customer segments?</p>
          <vue-slider
            v-model="feedback_value[index]"
            :adsorb="true"
            :data="feedback_data"
            :marks="true"
          ></vue-slider>
        </td>
        <Modal></Modal>
      </tr>
    </table>
    <!-- <vs-table>
      <template #thead>
        <vs-tr>
          <vs-th> Customer Segment </vs-th>
          <vs-th> Problems </vs-th>
          <vs-th> Feedback Cycle </vs-th>
          <vs-th> Pain </vs-th>
          <vs-th> Action </vs-th>
        </vs-tr>
      </template>
      <template #tbody>
        <vs-tr v-for="(item, index) in hypothesis_data" :key="index">
          <vs-td data-label="cust_seg"> {{ item[1] }} has a problems of {{ item[2] }}</vs-td>
          <vs-td>
            <vue-slider v-model="value1"></vue-slider>
            <vue-slider v-model="value2"></vue-slider>
          </vs-td>
          <vs-td> </vs-td>
          <vs-td> </vs-td>
          <template #expand>
            <div class="con-content">
              <div>
                <vs-button border danger> Remove Hypothesis </vs-button>
              </div>
            </div>
          </template>
        </vs-tr>
      </template>
    </vs-table> -->
  </div>
</template>

<script>
import Modal from "@/components/GeneralModal.vue";
export default {
  components:{
    Modal
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
        console.log(this.hypothesis_data)
        for (let item in this.hypothesis_data) {
          this.selected_custseg[item] = this.hypothesis_data[item][1];
          this.selected_problems[item] = this.hypothesis_data[item][2];
        }
      })
      .catch((error) => console.log(error));
  },
  mount(){
    this.show();
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
  },
  computed: {
    setselected: function () {
      return 0;
    },
  },
};
</script>

<style scoped>
</style>