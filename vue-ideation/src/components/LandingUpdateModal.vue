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
              <p class="formTitle">Update your landing page</p>
              <slot name="hypothesisTitle"> </slot>
              <p class="formField">Name</p>
              <input
                v-model="landingName"
                type="text"
                class="inputField"
                :class="dangerName"
                name="name"
                id="name"
                placeholder="New page name"
                required
              />
              <p class="formField">Goal Revenue</p>
              <div class="goalsCurrency">
                <span class="currency"
                  ><strong>RM</strong
                  ><font-awesome-icon icon="fa-solid fa-money-check-dollar"
                /></span>
                <input
                  v-model="landingGoalRevenue"
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
                  Update Landing Page!</general-button
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
import landingApi from "@/api/landingApi.js";
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      showModal: false,
      wrongNameInput: false,
      wrongRevenueInput: false,
      landingName: "",
      landingGoalRevenue: 0,
    };
  },
  components: {
    GeneralButtonNonHover,
    GeneralButton,
  },

  methods: {
    async handleUpdate() {
      this.checkInput();
      if (this.wrongNameInput === false && this.wrongRevenueInput === false) {
        let newLandingGoalName = {
          landingName: this.landingName,
          landingGoalRevenue: this.landingGoalRevenue,
        };
        let updateLanding = await landingApi.updateLandingGoalName(
          newLandingGoalName,
          this.currentProjectID
        );
        if (updateLanding.data.success === false) {
          this.$store.commit("setTypeToast", "Error");
          this.$store.commit("setMessage", "Page name and goal fail to update! Please try again");
          this.$store.commit("showToast");
          throw new Error("Could not update Landing Pages");
        } else {
          this.$store.commit("setTypeToast", "Success");
          this.$store.commit("setMessage", "Page name and goal updated!");
          this.$store.commit("showToast");
        }
        setTimeout(() => {
          this.$router.go();
        }, 200);
      }
    },
    checkInput() {
      if (this.landingName === "") {
        this.wrongNameInput = true;
      } else {
        this.wrongNameInput = false;
      }
      if (this.landingGoalRevenue <= 0) {
        this.wrongRevenueInput = true;
      } else {
        this.wrongRevenueInput = false;
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
        danger: this.wrongRevenueInput,
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
  font-family: 'Poppins';
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