<template>
  <div class="customerContainer">
    <div
      class="customerCards"
      v-for="(item, index) in customerCards"
      :key="index"
    >
      <customer-card
        :passedID="item.cust_ID"
        :passedName="item.custname"
        :passedOcc="item.custocc"
        :passedEmail="item.custemail"
        :passedPhone="item.cust_phone_num"
        :passedScore="item.custscore"
        :passedImagePath="item.image_path"
        :passedLogs="item.logs"
      >
      </customer-card>
    </div>
    <add-customer-card @addCard="addCardInterview"></add-customer-card>
  </div>
</template>

<script>
import CustomerCard from "./CustomerCard.vue";
import AddCustomerCard from "./AddCustomerCard.vue";
import customerApi from "@/api/customerApi.js";
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      customerCards: [],
    };
  },
  components: {
    CustomerCard,
    AddCustomerCard,
  },
  methods: {
    async addCardInterview(customer_info) {
      await customerApi.createCustomer(this.interviewIndex, customer_info);
      this.customerCards.push(customer_info);
    },

    async getCustomerInterview() {
      let getCustomer = await customerApi.getAllCustomer(this.interviewIndex);
      for (let item in getCustomer.data) {
        this.customerCards.push(getCustomer.data[item]);
      }
    },
  },
  computed: {
    ...mapGetters(["interviewIndex"]),
  },
  mounted() {
    this.getCustomerInterview();
  },
  created() {},
};
</script>

<style scoped>
.customerContainer {
  display: flex;
  flex-wrap: wrap;
  gap: 150px;
}
</style>