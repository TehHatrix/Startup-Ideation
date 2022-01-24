<template>
  <div class="progress">
    <div class="progress_bar" :style="ProgressWidth"></div>
  </div>
</template>

<script>
export default {
  props: {
    interviewMax: {
      type: Number,
    },
    currentCustomerLength:{
      type: Number,
    },
  },
  computed: {
    ProgressWidth() {
      let widthPercentage = (this.currentCustomerLength/this.interviewMax)*100;
      return "width:" + widthPercentage + "%";
    }
  },
};
</script>

<style scoped>
.progress {
  width: 100%;
  max-width: 130px;
  background: linear-gradient(270deg, #D7D5EC 0%, #E9DDFF 100%);
  border-radius: 7px;
  height: 7px;

}

.progress_bar {
  height: 100%;
  width: 0%;
  border-radius: 4px;
  background: linear-gradient(270deg, #8743ff 0%, #4136f1 100%);
  transition: 0.3s;
}
</style>