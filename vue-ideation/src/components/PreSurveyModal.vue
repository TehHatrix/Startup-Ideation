<template>
  <div>
    <general-button @click.native="showModal = true"
      >Validate Now!</general-button
    >

    <div id="modal-comp">
      <transition name="fade" appear>
        <div
          class="modal-overlay"
          v-if="showModal"
          @click="showModal = false"
        ></div>
      </transition>
      <transition name="slide" appear>
        <div class="modal" v-if="showModal">
          <transition name="fade" appear>
            <div class="preInterview">
             <p class="formTitle">Create your survey</p>
              <slot name="hypothesisTitle"> </slot>
              <p class="formField">Name</p>
              <input
                v-model="surveyName"
                type="text"
                class="inputField"
                :class="dangerName"
                name="name"
                id="name"
                placeholder="ie. March Survey"
                required
              />
              <p class="formField">Sign Ups Goals</p>
              <div class="goalsCurrency">
                <span class="currency"
                  ><font-awesome-icon icon="fa-solid fa-user-plus" /></span>
                <input
                  v-model="surveyGoal"
                  type="number"
                  class="inputField"
                  :class="dangerRevenue"
                  name="name"
                  id="name"
                  required
                />
              </div>

              <div class="footerButton">
                <general-button @click.native="showModal = false">
                  Close</general-button
                >
                <general-button @click.native="routeChooseLanding">
                  Create Survey!</general-button
                >
              </div>
            </div>
          </transition>
        </div>
      </transition>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
import GeneralButton from "./GeneralButton.vue";
import surveyApi from "@/api/surveyApi.js";
export default {
  components: { GeneralButton },
  data() {
    return {
      showModal: false,
      surveyName: "",
      surveyGoal: 0,
      wrongNameInput: false,
      wrongRevenueInput: false,
    };
  },
  methods: {
    async routeChooseLanding() {
      this.checkInput();
      if (this.wrongNameInput === false && this.wrongRevenueInput === false) {
          let payload = {
              surveyName: this.surveyName,
              surveyGoal: this.surveyGoal,
          }
          let surveycreate = await surveyApi.addSurvey(payload,this.currentProjectID);
          console.log(surveycreate)
        this.$router.push({ name: "SurveyDashboard", params: {projectID: this.currentProjectID}});
        // this.$store.commit("setLandingName", this.surveyName);
        // this.$store.commit("setLandingRevenueGoal", this.surveyGoal);

      }
    },
    checkInput() {
      if (this.surveyName === "") {
        this.wrongNameInput = true;
      } else {
        this.wrongNameInput = false;
      }
      if (this.surveyGoal <= 0) {
        this.wrongRevenueInput = true;
      } else {
        this.wrongRevenueInput = false;
      }
    },
  },
  mounted() {},
  computed: {
...mapGetters(['currentProjectID']),
    dangerName() {
      return {
        danger: this.wrongNameInput,
      };
    },
    dangerRevenue() {
      return {
        danger:this.wrongRevenueInput,
      };
    },
  },
};
</script>

<style lang = 'scss' scoped>

.formTitle{
  font-size: 35px;
  font-weight: bold;
  margin-bottom: -5px;
}

.formField{
    color:#828494;
    font-weight: normal;
}



::v-deep button {
  margin-top: 35px;
}

.inputField {
  border-radius: 5px;
  padding: 20px 20px;
  height: 30px;
  width: 100%;
  border: 1px solid #ccc;
  transition: all 0.3s ease 0s;
  background-color: #f6fafd;

  &:focus {
    border: 1px solid rgb(133, 133, 133);
  }
}

.danger {
  border: 1px solid #ff3156;
}

.goalsCurrency {
  display: flex;
  .currency {
    display: flex;
    gap: 5px;
    height: 40px;
    justify-content: center;
    align-items: center;
    border-radius: 5px;
    padding: 5px;
    text-align: center;
    color: white;
    background: linear-gradient(180deg, #8743ff 0%, #4136f1 100%);
  }
}
.modal {
  display: grid;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 99;

  width: 100%;
  max-width: 800px;
  max-height: 750px;
  background-color: #fff;
  border-radius: 16px;
  overflow: scroll;
  padding: 25px;

  p {
    padding-top: 2px;
    padding-bottom: 3px;
  }

  .footerButton {
    margin-top: 25px;
    display: flex;
    gap: 20px;
  }
}

.modal-overlay {
  position: fixed;
  top: 0;
  right: 0;
  left: 0;
  bottom: 0;
  overflow: auto;
  z-index: 99;
  /* min-height: 100%; */
  background-color: rgba(0, 0, 0, 0.3);
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}

.slide-enter-active,
.slide-leave-active {
  transition: transform 0.5s;
}

.slide-enter,
.slide-leave-to {
  transform: translateY(-50%) translateX(100vw);
}
</style>