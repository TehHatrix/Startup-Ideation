<template>
  <div>
    <general-button-non-hover
      class="updateButton"
      @click.native="showModal = true"
      ><font-awesome-icon icon="fa-solid fa-pen-to-square"
    /></general-button-non-hover>

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
              <p class="formTitle">Update your Survey</p>
              <slot name="hypothesisTitle"> </slot>
              <p class="formField">Name</p>
              <input
                v-model="surveyName"
                type="text"
                class="inputField"
                :class="dangerName"
                name="name"
                id="name"
                placeholder="New survey name"
                required
              />
              <p class="formField">Sign Up Goal</p>
              <div class="goalsCurrency">
                <span class="currency"
                  ><font-awesome-icon icon="fa-solid fa-user-plus"
                /></span>
                <input
                  v-model="signUpGoal"
                  type="number"
                  class="inputField"
                  :class="dangerRevenue"
                  name="name"
                  id="name"
                  placeholder="New revenue goal"
                  required
                />
              </div>

              <div class="footerButton">
                <general-button @click.native="showModal = false">
                  Close</general-button
                >
                <general-button @click.native="handleUpdate">
                  Update Survey!</general-button
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
import GeneralButtonNonHover from "./GeneralButtonNonHover.vue";
import GeneralButton from "./GeneralButton.vue";
import surveyApi from "@/api/surveyApi.js";
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      showModal: false,
      wrongNameInput: false,
      wrongSignUpInput: false,
      surveyName: "",
      signUpGoal: 0,
    };
  },
  components: {
    GeneralButtonNonHover,
    GeneralButton,
  },

  methods: {
    async handleUpdate() {
      this.checkInput();
      if (this.wrongNameInput === false && this.wrongSignUpInput === false) {
        let newSurveyGoalName = {
          surveyName: this.surveyName,
          signUpGoal: this.signUpGoal,
        };
        let updateLanding = await surveyApi.updateGoalName(
          this.currentProjectID,
          newSurveyGoalName
        );
        if (updateLanding.data.success === false) {
          this.$store.commit("setTypeToast", "Error");
          this.$store.commit(
            "setMessage",
            "Survey name and goal fail to update! Please try again"
          );
          this.$store.commit("showToast");
          throw new Error("Could not update Survey");
        } else {
          this.$store.commit("setTypeToast", "Success");
          this.$store.commit("setMessage", "Survey name and goal updated!");
          this.$store.commit("showToast");
        }
        setTimeout(() => {
          this.$router.go();
        }, 2000);
      }
    },
    checkInput() {
      if (this.surveyName === "") {
        this.wrongNameInput = true;
      } else {
        this.wrongNameInput = false;
      }
      if (this.signUpGoal <= 0) {
        this.wrongSignUpInput = true;
      } else {
        this.wrongSignUpInput = false;
      }
    },
  },
  computed: {
    dangerName() {
      return {
        danger: this.wrongNameInput,
      };
    },
    dangerRevenue() {
      return {
        danger: this.wrongSignUpInput,
      };
    },
    ...mapGetters(["currentProjectID"]),
  },
};
</script>

<style lang="scss" scoped>
.formTitle {
  font-size: 35px;
  font-weight: bold;
  margin-bottom: -1px;
}

.formField {
  color: #828494;
  font-weight: normal;
  margin-bottom: 7px;
}

.updateButton {
  margin-top: 3px;
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
    ::v-deep button {
      width: 140px;
      height: 45px;
    }
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