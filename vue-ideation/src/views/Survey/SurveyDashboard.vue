<template>
  <div>
    <div class="headerDashboard">
      <h1>Survey Dashboard</h1>
      <general-button @click.native="surveyRoute"> Share Survey</general-button>
      <general-button @click.native="showSummary">
        Show Summary</general-button
      >
    </div>
    <div class="summary">
      <h2>Survey Statistic</h2>
      <div class="cardFlexContainer">
        <dashboard-card>
          <template #logo>
            <sign-up :gradientBoolean="true"></sign-up
          ></template>
          <template #title> <h3>Answered Survey</h3></template>
          <template #content> <h1>17</h1> </template>
        </dashboard-card>
        <dashboard-card>
          <template #logo> <eyes :gradientBoolean="true"></eyes></template>
          <template #title> <h3>Total Unique Views</h3></template>
          <template #content> <h1>130</h1> </template>
        </dashboard-card>
        <dashboard-card>
          <template #logo>
            <revenue :gradientBoolean="true"> </revenue
          ></template>
          <template #title> <h3>Follow Up Emails</h3></template>
          <template #content> <h1>150</h1> </template>
        </dashboard-card>
        <dashboard-card>
          <template #logo>
            <revenue-target :gradientBoolean="true"></revenue-target>
          </template>
          <template #title> <h3>Follow Up Goal Emails</h3></template>
          <template #content> <h1>200</h1> </template>
        </dashboard-card>
      </div>
    </div>
    <div class="chart">
      <h2>Unique Views Charts</h2>
      <chart-card>
        <apexchart
          type="area"
          height="350"
          :options="chartOptions"
          :series="series"
        ></apexchart
      ></chart-card>
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
  data() {
    return {
      series: [
        {
          name: "Views",
          data: [10, 41, 35, 51, 49, 62, 69, 91, 148],
        },
      ],
      chartOptions: {
        chart: {
          height: 350,
          type: "area",
          fontFamily: "Poppins",
          zoom: {
            enabled: false,
          },
        },
        colors: ["#8743FF", "#4136F1"],
        dataLabels: {
          enabled: false,
        },
        stroke: {
          curve: "smooth",
          width: 4,
        },
        title: {
          text: "Unique Views",
          align: "left",
        },
        markers: {
          colors: ["#8743FF", "#4136F1"],
          size: 3,
        },
        fill: {
          type: "gradient",
          gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.75,
            opacityTo: 0.75,
            stops: [20, 100, 100, 100],
          },
        },
        dropShadow: {
          enabled: true,
          top: 0,
          left: 0,
          blur: 3,
          opacity: 0.5,
        },
        grid: {
          show: false,
        },
        xaxis: {
          categories: [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
          ],
        },
      },
    };
  },
  methods: {
    surveyRoute() {
      this.$router.push("/survey");
    },
    showSummary() {
      this.$router.push("summary");
    },
  },
};
</script>

<style lang="scss" scoped>
* {
  margin: 10px;
}

.headerDashboard {
  display: flex;
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