<template>
  <div class="interviewContainer">
    <loading-screen v-if="loadingHeader || loadingCustomer"></loading-screen>
    <interview-header
      v-show="!loadingHeader && !loadingCustomer"
      @finishData="setFinishLoadingHeader()"
      class="interviewHeader"
    >
    </interview-header>
    <customer-interview
      v-show="!loadingHeader && !loadingCustomer"
      @finishData="setFinishLoadingCustomer()"
      class="customerInterview"
    >
    </customer-interview>
  </div>
</template>


<script>
import InterviewHeader from "./InterviewHeader.vue";
import CustomerInterview from "./CustomerInterview.vue";
import LoadingScreenVue from "@/components/general/LoadingScreen.vue";
export default {
  components: {
    InterviewHeader,
    CustomerInterview,
    "loading-screen": LoadingScreenVue,
  },
  data() {
    return {
      loadingHeader: true,
      loadingCustomer: true,
    };
  },
  methods: {
    setFinishLoadingHeader() {
      this.loadingHeader = false;
    },
    setFinishLoadingCustomer() {
      this.loadingCustomer = false;
    },
  },
  computed: {},
  async mounted() {
    // this.$on("meow", this.loading = false)
    // this.$nextTick(function () {
    //   this.loading = false;
    // });
  },
};
</script>


<style lang ='scss' scoped>
.interviewContainer {
  display: grid;
  grid-template-areas:
    "progressbar"
    "header"
    "customercontainer";

  .interviewHeader {
    grid-area: header;
  }
  .customerInterview {
    margin-left: 100px;
    margin-top: 60px;
    grid-area: customercontainer;
  }
}
</style>