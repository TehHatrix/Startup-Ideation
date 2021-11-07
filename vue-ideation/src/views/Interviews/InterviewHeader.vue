<template>
  <div class="interviewContainer">
    <div class="card">
      <div class="overallScore">
        <p>Current Overall Score</p>
      </div>
      <div class="ratingStar">
        <span class="starsContainer">
          <h2 class="rating">4.4 <stars class = "star"></stars></h2>
        </span>
        <p class = "totalInterview">10 Interviews</p>
      </div>
      <div class="ratingCustomers">
        <p>Customer Stars Overview</p>
      </div>
      <div class="interviewData">Data things</div>
      <div class="progress">Progress</div>
    </div>
    <div class="customersCards"></div>
  </div>
</template>

<script>
import Stars from "@/views/Interviews/Stars.vue";
export default {
  components: {
    Stars,
  },
};
</script>


<style lang = 'scss' scoped>
@import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);
* {
  font-family: "Poppins";
}

.interviewContainer {
  max-width: 1800px;
}
.rating{
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
  .totalInterview{
      margin-top: -35px;

  }
}

.progress {
  margin-right: 13px;
}

.card {
  background: #fff;
  border-radius: 7px;
  display: flex;
  justify-content: flex-start;
  gap: 50px;
  height: 120px;
  width: 90%;
  margin: auto;
  position: relative;
  top: 15px;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
  transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
}

.card:hover {
  box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
}
</style>