<template>
<div class = "interviewContainer">

<interview-header class = "interviewHeader">
</interview-header>
<customer-interview class = "customerInterview">
</customer-interview>
</div>

</template>


<script>
import InterviewHeader from "@/views/Interviews/InterviewHeader.vue";
import CustomerInterview from "@/views/Interviews/CustomerInterview.vue";
export default {
  components: {
      InterviewHeader,CustomerInterview
  },
}
</script>


<style lang ='scss' scoped>
.interviewContainer{
  display: grid;
  grid-template-areas:
  "progressbar"
  "header"
  "customercontainer";

  .interviewHeader{
    grid-area: header;
  }
  .customerInterview{
    margin-left: 60px;
    margin-top: 60px;
    grid-area: customercontainer;
  }
}
</style>