<template>
  <div>
    <div class="customerInfoModal">
      <div class="modalContentContainer">
        <transition name="fade" appear>
          <div
            class="customerContent"
            v-if="
              modalCustomer && modalConclude == false && modalScript == false
            "
          >
            <div class="customerInfo">
              <img :src="imagePath" />
              <p class="custName">
                <strong
                  :contentEditable="contenteditable"
                  @blur="editName($event)"
                  >{{ customerName }}</strong
                >
              </p>
              <p class="custRating">
                <strong>Current Rating</strong>
                <span class="rating">
                  {{ customerScore }}<font-awesome-icon icon="fa-solid fa-star"
                /></span>
              </p>
              <p class="custOcc">
                <strong>Occupation </strong>
                <span
                  :contentEditable="contenteditable"
                  @blur="editOcc($event)"
                  >{{ customerOcc }}</span
                >
              </p>
              <p class="custPhone">
                <strong>Phone Number </strong>
                <span
                  :contentEditable="contenteditable"
                  @blur="editPhone($event)"
                  >{{ customerPhone }}</span
                >
              </p>
              <p class="custEmail">
                <strong>Email Address </strong>
                <span
                  :contentEditable="contenteditable"
                  @blur="editEmail($event)"
                >
                  {{ customerEmail }}</span
                >
              </p>
              <general-button
                v-if="this.editable"
                @click.native="
                  editableToggle();
                  saveEditedData();
                "
                >Save Profile</general-button
              >
              <general-button
                v-if="this.editable == false"
                @click.native="editableToggle()"
                >Edit Profile</general-button
              >
            </div>
            <div class="interviewdata">
              <div class="interviewdata_header">
                <span class="interviewlogs_title">
                  <strong>Interview Logs</strong></span
                >
                <general-button @click.native="showModalConclude"
                  >Conclude Interview</general-button
                >
                <general-button @click.native="showInterviewLogs"
                  >Open Interview Logs</general-button
                >
              </div>
              <div class="interviewdata_content">
                <p>
                  {{ customerLogs }}
                </p>
              </div>
            </div>
          </div>
        </transition>
        <transition name="fade" appear>
          <conclude-content
            v-if="modalCustomer == false && modalConclude"
          ></conclude-content>
        </transition>
        <transition name="fade" appear>
          <interview-logs-content
            v-if="modalCustomer == false && modalScript"
            :interviewLogsContent="customerLogs"
            noteType="logs"
          ></interview-logs-content>
        </transition>
      </div>
      <div class="bottomButton">
        <general-button @click.native="closeModal">Close</general-button>
        <general-button
          v-if="modalConclude || modalScript"
          @click.native="showCustomerContent"
          >Back</general-button
        >
      </div>
    </div>
  </div>
</template>

<script>
import concludeContent from "./ConcludeContent.vue";
import interviewLogsContent from "./InterviewLogsContent.vue";
import GeneralButton from "../../components/GeneralButtonNonHover.vue";
import customerApi from "@/api/customerApi.js";
import { mapGetters } from "vuex";
export default {
  props: {
    imagePath: {
      type: String,
    },
    customerName: {
      type: String,
    },
    customerOcc: {
      type: String,
    },
    customerPhone: {
      type: String,
    },
    customerEmail: {
      type: String,
    },
    customerScore: {
      type: String,
    },
    customerLogs: {
      type: String,
    },
  },
  data() {
    return {
      editable: false,
      modalCustomer: true,
      modalConclude: false,
      modalScript: false,
      customer: {
        custname: "",
        custocc: "",
        cust_phone_num: "",
        custemail: "",
      },
    };
  },
  components: {
    concludeContent,
    interviewLogsContent,
    GeneralButton,
  },
  computed: {
    ...mapGetters([
      // "modalCustomer",
      // "modalConclude",
      // "modalScript",
      // "interviewLogsContent",
      // "script",
      // "interviewScript",
      // "customerlog",
      "fromCustomer",
      "currentID",
      "interviewIndex",
    ]),
    contenteditable() {
      return this.editable ? true : false;
    },
  },
  methods: {
    showModalConclude() {
      this.modalConclude = true;
      this.modalCustomer = false;
      this.modalScript = false;
      // this.$store.commit("fromCustomerProfile");
      // this.$store.commit("showModalConclude");
    },
    showInterviewLogs() {
      this.modalConclude = false;
      this.modalCustomer = false;
      this.modalScript = true;
      // this.$store.commit("setCustomerLogTrue");
      // this.$store.commit("fromCustomerProfile");
      // this.$store.commit("showInterviewNotepad");
    },
    showCustomerContent() {
      this.modalConclude = false;
      this.modalCustomer = true;
      this.modalScript = false;
      // this.$store.commit("showCustomerContent");
    },
    editName(e) {
      this.customer.custname = e.target.innerText;
    },
    editOcc(e) {
      this.customer.custocc = e.target.innerText;
    },
    editPhone(e) {
      this.customer.cust_phone_num = e.target.innerText;
    },
    editEmail(e) {
      this.customer.custemail = e.target.innerText;
    },
    editableToggle() {
      this.editable = !this.editable;
    },
    async saveEditedData() {
      let saveProfile = await customerApi.updateCustomer(
        this.currentID,
        this.customer
      );
      if (saveProfile.data.success == false) {
        throw new Error("Could not update Customer Details");
      } else {
        this.$router.go();
      }
    },
    closeModal() {
      this.modalCustomer = true;
      this.modalConclude = false;
      this.modalScript = false;
      this.$emit("close");
      // this.$store.commit("setScriptFalse");
      // this.$store.commit("setCustomerLogFalse");
      // this.$store.commit("closeModal");
    },
  },
  mounted() {
    this.editable = false;
  },
};
</script>

<style lang="scss" scoped>
.fa-star {
  color: #e67100;
  font-size: 20px;
}
.bottomButton {
  display: flex;
  gap: 20px;
  margin-top: 20px;
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
  padding: 25px;
  .modalContentContainer {
    display: grid;
  }
  p {
    padding-top: 2px;
    padding-bottom: 3px;
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
      ::v-deep button {
        margin-left: 30px;
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
::v-deep .concludeContent,
::v-deep .interviewLogs {
  grid-column: 1;
  grid-row: 1;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}

// .slide-enter-active,
// .slide-leave-active {
//   transition: transform 0.5s;
// }

// .slide-enter,
// .slide-leave-to {
//   transform: translateY(-50%) translateX(100vw);
// }
</style>