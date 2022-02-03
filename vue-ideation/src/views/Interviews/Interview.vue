<template>
  <div class="interviewContainer">
    <interview-header class="interviewHeader"> </interview-header>
    <customer-interview class="customerInterview"> </customer-interview>
  </div>
</template>


<script>
import InterviewHeader from "./InterviewHeader.vue";
import CustomerInterview from "./CustomerInterview.vue";
import { mapGetters } from 'vuex';
export default {
  components: {
    InterviewHeader,
    CustomerInterview,
  },
  computed: {
    ...mapGetters(['currentProjectID'])
  },
};
</script>


<style lang ='scss' scoped>
.interviewContainer {
  display: grid;
  grid-template-areas:
    "progressbar"
    "header"
    "customercontainer";

  .interviewHeader {
    grid-area: header;
  }
  .customerInterview {
    margin-left: 130px;
    margin-top: 60px;
    grid-area: customercontainer;
  }
}
</style>