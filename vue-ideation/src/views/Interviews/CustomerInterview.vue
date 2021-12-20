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
      let createCustomer = await customerApi.createCustomer(
        this.interviewIndex,
        customer_info
      );
      console.log(createCustomer.data);
      this.customerCards.push(customer_info);
    },

    async getCustomerInterview() {
      let getCustomer = await customerApi.getAllCustomer(this.interviewIndex);

      for (let item in getCustomer.data) {
        this.customerCards.push(getCustomer.data[item]);
      }
      console.log(this.customerCards);
    },
  },
  computed: {
    ...mapGetters(["interviewIndex"]),
  },
  mounted() {},
  created() {
    this.getCustomerInterview();
  },
};
</script>

<style scoped>
.customerContainer {
  display: flex;
  flex-wrap: wrap;
  gap: 150px;
}
</style>