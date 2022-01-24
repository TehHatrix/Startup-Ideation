<template>
  <div class="progress">
    <div class="progress_bar" :style="calculateWidth"></div>
  </div>
</template>

<script>
export default {
props: {
  currentInterviewNumber:{
    type:Number,
  },
  maxInterview: {
    type: Number,
  },
},
computed: {
  calculateWidth() {
    let widthPercentage = (this.currentInterviewNumber/this.maxInterview) * 100;
    return "width:" + widthPercentage +"%";
  }
},

mounted () {
},

};
</script>

<style scoped>
.progress {
  width: 100%;
  max-width: 130px;
  background: white;
  border-radius: 7px;
  height: 7px;
}

.progress .progress_bar {
  height: 100%;
  width: 0%;
  border-radius: 4px;
  background: linear-gradient(270deg, #8743ff 0%, #4136f1 100%);
  transition: 0.3s;
}
</style>