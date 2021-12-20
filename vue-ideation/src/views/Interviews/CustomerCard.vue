<template>
  <div>
    <div class="card" @click="showModalCustomer">
      <div class="card_image">
        <img
          src="https://images.pexels.com/photos/614810/pexels-photo-614810.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
        />
      </div>
      <div class="customer_data">
        <p>
          <strong>{{ customerName }}</strong>
        </p>
        <p class="occupation">{{ customerOcc }}</p>
        <p class="rating">
          {{ customerScore }}<font-awesome-icon icon="fa-solid fa-star" />
        </p>
      </div>
    </div>

    <transition name="fade" appear>
      <div class="modal-overlay" v-if="modalCustomer" @click="closeModal"></div>
    </transition>
    <transition name="slide" appear>
      <div class="customerInfoModal" v-if="modalCustomer">
        <div class="modalContentContainer">
          <transition name="fade" appear>
            <div
              class="customerContent"
              v-if="
                modalCustomer && modalConclude == false && modalScript == false
              "
            >
              <div class="customerInfo">
                <img
                  src="https://images.pexels.com/photos/614810/pexels-photo-614810.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                />
                <p class="custName">
                  <strong>{{ customerName }}</strong>
                </p>
                <p class="custRating">
                  <strong>Current Rating</strong>
                  <span class="rating">
                    {{ customerScore
                    }}<font-awesome-icon icon="fa-solid fa-star"
                  /></span>
                </p>
                <p class="custOcc">
                  <strong>Occupation</strong>
                  <span
                    :contentEditable="contenteditable"
                    @blur="editOcc($event)"
                    >{{ customerOcc }}</span
                  >
                </p>
                <p class="custPhone">
                  <strong>Phone Number</strong>
                  <span
                    :contentEditable="contenteditable"
                    @blur="editPhone($event)"
                    >{{ customerPhone }}</span
                  >
                </p>
                <p class="custEmail">
                  <strong>Email Address</strong>
                  <span
                    :contentEditable="contenteditable"
                    @blur="editEmail($event)"
                  >
                    {{ customerEmail }}</span
                  >
                </p>
                <button
                  class="button"
                  v-if="this.editable"
                  @click="
                    editableToggle();
                    saveEditedData();
                  "
                >
                  Save Profile
                </button>
                <button
                  class="button"
                  v-if="this.editable == false"
                  @click="editableToggle()"
                >
                  Edit Profile
                </button>
              </div>
              <div class="interviewdata">
                <div class="interviewdata_header">
                  <span class="interviewlogs_title">
                    <strong>Interview Logs</strong></span
                  >
                  <button class="button" @click="showModalConclude">
                    Conclude Interview
                  </button>
                  <button class="button" @click="showInterviewScript">
                    Open Interview Logs
                  </button>
                </div>
                <div class="interviewdata_content">
                  <p>
                    1. Thanks for taking my call, I’m doing some research on
                    [main activity related to problem]. Before we start, can you
                    tell me a bit about yourself? - Focus on learning about WHO
                    your customer is before moving onto the problem... 2. When
                    was the last time you [main activity related to problem]?
                  </p>
                </div>
              </div>
            </div>
          </transition>
          <transition name="fade" appear>
            <div
              class="concludeContent"
              v-if="modalCustomer && modalConclude == true"
            >
              <div class="concludeHeader">
                <circular-progress></circular-progress>
                <p class="score">
                  <strong>Current Score </strong>
                  <span class="scoreNumber"
                    ><strong>4</strong
                    ><font-awesome-icon icon="fa-solid fa-star"
                  /></span>
                </p>
              </div>
              <div class="concludeQuestion">
                Does this person care about the problem?
              </div>
              <div class="concludeAnswer">
                <div class="answerCard"><check></check> Yes</div>
                <div class="answerCard">
                  <x-Mark :toggleHover="false"></x-Mark> No
                </div>
              </div>
            </div>
          </transition>
          <transition name="fade" appear>
            <div
              class="interviewLogs"
              v-if="
                modalCustomer && modalConclude == false && modalScript == true
              "
            >
              <div class="notepad">
                <div class="top"></div>
                <div
                  class="paper"
                  contenteditable="true"
                  @blur="handleNotepad($event)"
                >
                  <div v-if="script">
                    {{ interviewScript }}
                  </div>
                  <div v-else-if="customerlog">
                    {{ interviewLogsContent }}
                  </div>
                </div>
              </div>
            </div>
          </transition>
        </div>

        <button class="button" style="margin-top: 10px" @click="closeModal">
          Close
        </button>
        <button
          v-if="(modalConclude || modalScript) && fromCustomerProfile"
          class="button"
          style="margin-top: 10px"
          @click="showCustomerContent"
        >
          Back
        </button>
      </div>
    </transition>
  </div>
</template>

<script>
import circularProgress from "../../components/CircularProgress.vue";
import xMark from "@/components/icons/x-mark.vue";
import check from "@/components/icons/check.vue";
import interviewApi from "@/api/interviewApi.js";
import customerApi from "@/api/customerApi.js";
import { mapGetters } from "vuex";

export default {
  components: {
    circularProgress,
    xMark,
    check,
  },
  props: {
    passedID: {
      type: Number,
    },
    passedName: {
      type: String,
    },
    passedOcc: {
      type: String,
    },
    passedPhone: {
      type: String,
    },
    passedEmail: {
      type: String,
    },
    passedScore: {
      type: String,
    },
  },
  data() {
    return {
      customerID: this.passedID,
      customerName: this.passedName,
      customerOcc: this.passedOcc,
      customerPhone: this.passedPhone,
      customerEmail: this.passedEmail,
      customerScore: this.passedScore,
      editable: false,
    };
  },
  computed: {
    contenteditable() {
      if (this.editable) {
        return true;
      } else {
        return false;
      }
    },
    modalCustomer() {
      return this.$store.state.interviewRepository.showModalCustomer;
    },
    modalConclude() {
      return this.$store.state.interviewRepository.showModalConclude;
    },
    modalScript() {
      return this.$store.state.interviewRepository.showInterviewLogs;
    },
    fromCustomerProfile() {
      return this.$store.state.interviewRepository.fromCustomer;
    },
    ...mapGetters([
      "interviewLogsContent",
      "script",
      "customerlog",
      "interviewScript",
      "interviewIndex",
      "customer",
      "currentID",
    ]),
  },
  methods: {
    editableToggle() {
      this.editable = !this.editable;
    },
    async saveEditedData() {
      console.log(this.currentID);
      let saveProfile = await customerApi.updateCustomer(
        this.currentID,
        this.customer
      );
      console.log(saveProfile.data);
    },
    editOcc(e) {
      this.$store.commit("setEditedOcc", e.target.innerText);
    },
    editPhone(e) {
      this.$store.commit("setEditedPhone", e.target.innerText);
    },
    editEmail(e) {
      this.$store.commit("setEditedEmail", e.target.innerText);
    },
    showModalCustomer() {
      this.$store.commit("setcurrentID", this.customerID);
      this.$store.commit("showModalCustomer");
    },
    closeModal() {
      this.$store.commit("setScriptFalse");
      this.$store.commit("setCustomerLogFalse");
      this.$store.commit("closeModal");
    },
    showCustomerContent() {
      this.$store.commit("showCustomerContent");
    },
    showModalConclude() {
      this.$store.commit("fromCustomerProfile");
      this.$store.commit("showModalConclude");
    },
    showInterviewScript() {
      this.$store.commit("setCustomerLogTrue");
      this.$store.commit("fromCustomerProfile");
      this.$store.commit("showInterviewNotepad");
    },
    async handleNotepad(e) {
      let textObject = {
        text: e.target.innerText,
      };
      if (this.script) {
        this.$store.commit("setinterviewScript", textObject.text);
        await interviewApi.updateScript(this.interviewIndex, textObject);
      } else {
        this.$store.commit("setInterviewLogs", textObject.text);
      }
    },
  },
  mounted() {},
};
</script>

<style lang="scss" scoped>
.fa-star {
  color: #e67100;
  font-size: 20px;
}
.card {
  width: 220px;
  height: 220px;
  border-radius: 40px;
  box-shadow: 5px 5px 30px 7px rgba(0, 0, 0, 0.25),
    -5px -5px 30px 7px rgba(0, 0, 0, 0.22);
  cursor: pointer;
  transition: 0.3s ease-out;
  .card_image {
    width: inherit;
    height: inherit;
    border-radius: 40px;
    img {
      width: inherit;
      height: inherit;
      border-radius: 40px;
      object-fit: cover;
    }
  }
  .customer_data {
    text-align: center;
    font-family: "Poppins";
    font-size: 20px;
    margin-top: 28px;
    .fa-star {
      color: #e67100;
      font-size: 20px;
    }
    p {
      margin-top: -20px;
    }
    .occupation {
      margin-top: -24px;
      font-size: 18px;
      margin-left: 30px;
    }
    .rating {
      font-size: 39px;
      font-weight: bold;
    }
  }
}

.card:hover {
  transform: scale(0.9, 0.9);
  box-shadow: 5px 5px 30px 15px rgba(0, 0, 0, 0.25),
    -5px -5px 30px 15px rgba(0, 0, 0, 0.22);
}

.button {
  appearance: none;
  outline: none;
  border: none;
  background: none;
  cursor: pointer;
  padding: 10px 10px;
  background: linear-gradient(180deg, #8743ff 0%, #4136f1 100%);
  border-radius: 8px;

  color: #fff;
  font-size: 15px;
  font-weight: 600;

  box-shadow: 3px 3px rgba(0, 0, 0, 0.4);
  transition: 0.4s ease-out;
  &:hover {
    box-shadow: 6px 6px rgba(0, 0, 0, 0.6);
  }
}
.customerInfoModal {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 99;

  width: 100%;
  max-width: 1000px;
  background-color: #fff;
  border-radius: 16px;
  // overflow: scroll;
  padding: 25px;
  .modalContentContainer {
    display: grid;
  }
  p {
    padding-top: 2px;
    padding-bottom: 3px;
  }
  .button {
    margin-right: 20px;
  }
  .customerContent {
    top: 0;
    left: 0;
    display: flex;
    gap: 50px;

    .customerInfo {
      width: 300px;
      height: 550px;
      border-radius: 40px;
      box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.25),
        -2px -2px 2px 2px rgba(0, 0, 0, 0.22);
      img {
        width: 300px;
        height: 300px;
        border-radius: 40px;
        object-fit: cover;
      }
      p {
        margin: 5px;
        padding: 0px;
        .rating {
          font-size: 30px;
          font-weight: bold;
        }
      }
      .custName {
        margin-top: 5px;
        text-align: center;
        font-size: 20px;
        font-weight: bold;
      }
      button {
        margin-left: 90px;
        margin-top: 10px;
        padding: 8px 10px;
        //   margin: auto;
      }
    }

    .interviewdata {
      width: 600px;
      height: 550px;
      border-radius: 40px;
      box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.25),
        -2px -2px 2px 2px rgba(0, 0, 0, 0.22);
      .interviewdata_header {
        display: flex;
        margin-top: 10px;
      }
      .interviewlogs_title {
        font-size: 20px;
        margin-left: 18px;
        margin-right: 50px;
      }
      button {
        padding: 8px 8px;
      }
      .interviewdata_content {
        margin-top: 15px;
        margin-left: 20px;
        width: 530px;
        height: 470px;
        border-radius: 20px;
        background: #f0f0f0;

        p {
          padding-left: 10px;
          margin: auto;
        }
      }
    }
  }
}

.customerContent,
.concludeContent,
.interviewLogs {
  grid-column: 1;
  grid-row: 1;
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

.notepad {
  width: 100%;
  max-width: 900px;
  box-shadow: 10px 10px 40px rgba(black, 0.15);
  border-radius: 0 0 10px 10px;
  overflow: hidden;
  margin: auto;
}

.top {
  width: 100%;
  height: 50px;
  background: #333;
  border-radius: 5px 5px 0 0;
}

.paper {
  width: 100%;
  height: 100%;
  min-height: 60vh;
  padding: 35px 20px;
  background: repeating-linear-gradient(
    #f1ede9,
    #f1ede9 31px,
    #94acd4 31px,
    #94acd4 32px
  );
  font-family: "Shadows Into Light", cursive;
  line-height: 32px;
  outline: 0;
  font-size: 22px;
}

.modal-overlay {
  position: absolute;
  top: 0;
  right: 0;
  left: 0;
  bottom: 0;
  z-index: 98;
  height: 150%;
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
