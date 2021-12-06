<template>
  <div>
    <div class="headerDashboard">
      <h1>Landing Page Dashboard</h1>
      <general-button @click.native = "editLanding"> Edit Page</general-button>
      <general-button @click.native = "previewLanding"> Preview Page</general-button>
    </div>
    <div class="summary">
      <h2>Statistic Top Summary</h2>
      <div class="cardFlexContainer">
        <dashboard-card>
          <template #logo>
            <sign-up :gradientBoolean="true"></sign-up
          ></template>
          <template #title> <h3>Sign Ups</h3></template>
          <template #content> <h1>10</h1> </template>
        </dashboard-card>
        <dashboard-card>
          <template #logo> <eyes :gradientBoolean="true"></eyes></template>
          <template #title> <h3>Total Unique Views</h3></template>
          <template #content> <h1>10</h1> </template>
        </dashboard-card>
        <dashboard-card>
          <template #logo>
            <revenue :gradientBoolean="true"> </revenue
          ></template>
          <template #title> <h3>Expected Revenue</h3></template>
          <template #content> <h1>RM 150</h1> </template>
        </dashboard-card>
        <dashboard-card>
          <template #logo>
            <revenue-target :gradientBoolean="true"></revenue-target>
          </template>
          <template #title> <h3>Goals Revenue</h3></template>
          <template #content> <h1>RM 1000</h1> </template>
        </dashboard-card>
      </div>
    </div>
    <div class="chart">
      <h2>Unique Views Charts</h2>
      <chart-card></chart-card>
    </div>
  </div>
</template>

<script>
import DashboardCard from "@/components/DashboardCard.vue";
import SignUp from "../../components/icons/sign-up.vue";
import Eyes from "../../components/icons/eyes.vue";
import Revenue from "../../components/icons/revenue.vue";
import RevenueTarget from "../../components/icons/revenueTarget.vue";
import ChartCard from "@/components/ChartCard.vue";
import GeneralButton from "@/components/GeneralButton.vue";
export default {
  components: {
    DashboardCard,
    SignUp,
    Eyes,
    Revenue,
    RevenueTarget,
    ChartCard,
    GeneralButton,
  },
  methods: {
    editLanding() {
      this.$router.push('/editor/landing');
    },
    previewLanding(){
      this.$router.push('/landingpage');
    }
  },
};
</script>

<style lang="scss" scoped>
* {
  margin: 10px;
}

.headerDashboard{
  display:flex;
}
.cardFlexContainer {
  display: flex;
  gap: 30px;

  ::v-deep svg {
    height: 40px;
    width: 40px;
  }
}
</style>