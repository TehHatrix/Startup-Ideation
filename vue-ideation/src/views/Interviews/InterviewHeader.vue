<template>
  <div class="card">
    <div class="overallScore">
      <p>Current Overall Score</p>
    </div>
    <div class="ratingStar">
      <span class="starsContainer">
        <h2 class="rating">4.4 <stars class="star"></stars></h2>
      </span>
      <p class="totalInterview">10 Interviews</p>
    </div>
    <div class="ratingCustomers">
      <span class="fiveStar">
        5 <font-awesome-icon icon="fa-solid fa-star" />
        <star-bar></star-bar>
      </span>
      <span class="fourStar">
        4 <font-awesome-icon icon="fa-solid fa-star" />
        <star-bar></star-bar>
      </span>
      <span class="threeStar"
        >3 <font-awesome-icon icon="fa-solid fa-star" /> <star-bar></star-bar
      ></span>
      <span class="twoStar"
        >2 <font-awesome-icon icon="fa-solid fa-star" /> <star-bar></star-bar
      ></span>
      <span class="oneStar"
        >1 <font-awesome-icon icon="fa-solid fa-star" /> <star-bar></star-bar
      ></span>
    </div>
    <div class="interviewData">
      <span class="problemSegment">
        <p>
          <font-awesome-icon icon="fa-solid fa-circle-exclamation" />
          <strong> Current Problem</strong> : Problem 1
        </p>
        <p style="margin-left: 10px">
          <font-awesome-icon icon="fa-solid fa-users" />
          <strong> Customer Segment</strong> : Customer Segment 1
        </p>
      </span>
      <p class="customer-segment">
        <font-awesome-icon icon="fa-solid fa-bullseye" />
        <strong> Learning Objectives</strong> : Does the customer care enough
        about this problem?
      </p>
      <p>
        <font-awesome-icon icon="fa-solid fa-scroll" />
        <strong> Interview Script </strong> : Click to see & edit
      </p>
    </div>
    <div class="progress">
      <p>
        <font-awesome-icon icon="fa-solid fa-list-check" />
        <strong> Progress</strong>
      </p>
      <ProgressBar style="margin: auto" />
      <p>2 more interviews to go!</p>
    </div>
  </div>
</template>

<script>
import Stars from "@/views/Interviews/Stars.vue";
import StarBar from "@/views/Interviews/StarBar.vue";
import ProgressBar from "@/views/Interviews/ProgressBar.vue";

export default {
  components: {
    StarBar,
    Stars,
    ProgressBar,
  },
};
</script>
<style lang = 'scss' scoped>
* {
  font-family: "Poppins";
}
.rating {
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
  .totalInterview {
    margin-top: -35px;
  }
}

.card {
  background: #fff;
  border-radius: 7px;
  display: flex;
  justify-content: flex-start;
  gap: 50px;
  height: 140px;
  width: 90%;
  margin: auto;
  position: relative;
  top: 15px;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
  transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
  &:hover {
    box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
  }
  .ratingCustomers {
    display: flex;
    flex-direction: column;
    flex-grow: 1;
    margin-top: 10px;
    .fa-star {
      color: #e67100;
      font-size: 10px;
    }
    .fiveStar,
    .fourStar,
    .threeStar,
    .twoStar,
    .oneStar {
      display: flex;
      flex-direction: row;
      align-items: center;
    }
  }

  .interviewData {
    display: flex;
    flex-direction: column;
    align-content: center;
    font-size: 14px;
    .problemSegment {
      display: flex;
      flex-direction: row;
    }
  }
  .progress {
    display: flex;
    flex-direction: column;
    margin-right: 13px;

    p {
      text-align: center;
    }
  }
}
</style>