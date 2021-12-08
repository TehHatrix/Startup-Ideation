<template>
  <div>
    <div class="card">
      <div class="concludeContent">
        <div class="concludeHeader">
          <circular-progress></circular-progress>
          <p class="score">
            <strong>Current Score </strong>
            <span class="scoreNumber"
              ><strong>4</strong><font-awesome-icon icon="fa-solid fa-star"
            /></span>
          </p>
        </div>
        <div class="concludeQuestion">
          How would you feel if you could no longer use Mall Navigator?
        </div>
        <div class="concludeAnswer">
          <div class="answerCard"><check></check> Sad</div>
          <div class="answerCard"><x-Mark :toggleHover = "false"></x-Mark> Doesn't care</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import circularProgress from "@/components/CircularProgress.vue";
import xMark from "@/components/icons/x-mark.vue";
import check from "@/components/icons/check.vue";
export default {
  components: {
    circularProgress,
    xMark,
    check, 
  },
};
</script>

<style lang="scss" scoped>
.card{
  background-color: #FFFFFF;
}

.concludeHeader {
  display: flex;
  align-items: center;
  gap: 50px;
  .score {
    font-size: 20px;
  }
  .scoreNumber {
    font-size: 30px;
  }
}

.concludeQuestion {
  font-size: 40px;
  font-weight: bold;
  margin-top: 20px;
  margin-left: 30px;
}

.concludeAnswer {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 20px;
  gap: 100px;
  .answerCard {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    height: 160px;
    width: 160px;
    border-radius: 15px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
    cursor: pointer;
    transition: 0.2s ease-out;
    font-size: 40px;
    font-weight: bold;
    &:hover {
      transform: scale(1.1, 1.1);
      box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
        0 10px 10px rgba(0, 0, 0, 0.22);
    }
  }
}

.fa-star {
  color: #e67100;
  font-size: 20px;
}
</style>