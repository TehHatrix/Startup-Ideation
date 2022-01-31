<template>
  <div>
    <div class="cardContainer">
      <div class="cardTop">
        <disabled-button @click.native="deleteCustomer(customerID)">
          <font-awesome-icon icon="fa-solid fa-trash-can"
        /></disabled-button>
      </div>
      <div class="card" @click="showModalCustomer">
        <div class="card_image">
          <img :src="imagePath" />
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
    </div>

    <transition name="fade" appear>
      <div class="modal-overlay" v-if="modalCustomer" @click="closeModal"></div>
    </transition>

    <customer-content-modal
      v-if="modalCustomer"
      :imagePath="passedImagePath"
      :customerName="passedName"
      :customerOcc="passedOcc"
      :customerEmail="passedEmail"
      :customerPhone="passedPhone"
      :customerScore="passedScore"
      :customerLogs="passedLogs"
      @close="closeModal"
    ></customer-content-modal>
  </div>
</template>

<script>
import customerApi from "@/api/customerApi.js";
import { mapGetters } from "vuex";
import DisabledButton from "../../components/DisabledButton.vue";
import CustomerContentModal from "./CustomerContentModal.vue";

export default {
  components: {
    DisabledButton,
    CustomerContentModal,
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
    passedImagePath: {
      type: String,
    },
    passedLogs: {
      type: String,
    },
  },
  data() {
    return {
      modalCustomer: false,
      customerID: this.passedID,
      customerName: this.passedName,
      customerOcc: this.passedOcc,
      customerPhone: this.passedPhone,
      customerEmail: this.passedEmail,
      customerScore: this.passedScore,
      imagePath: this.passedImagePath,
    };
  },
  computed: {
    ...mapGetters(["currentID", "interviewIndex"]),
  },
  methods: {
    async deleteCustomer(customerID) {
      await customerApi.deleteCustomer(customerID);
      setTimeout(() => {
        this.$router.go();
      }, 2300);
    },
    showModalCustomer() {
      this.modalCustomer = true;
      this.$store.commit("setcurrentID", this.customerID);
    },
    closeModal() {
      this.modalCustomer = false;
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
  position: relative;
  width: 220px;
  height: 220px;
  border-radius: 40px;
  // box-shadow: 2px 2px 10px 5px rgba(0, 0, 0, 0.25),
  //   -2px -2px 10px 5px rgba(0, 0, 0, 0.22);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
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

.cardContainer {
  position: relative;
  border-radius: 40px;
  transition: 0.3s ease-out;
  .cardTop {
    position: absolute;
    left: -20px;
    z-index: 10;
    ::v-deep button {
      cursor: pointer;
      width: 45px;
      height: 35px;
      border-radius: 15px;
    }
  }
}

.cardContainer:hover {
  transform: scale(0.9, 0.9);
  box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
}

.modal-overlay {
  position: fixed;
  top: 0;
  right: 0;
  left: 0;
  bottom: 0;
  overflow: auto;
  z-index: 98;
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
</style>
