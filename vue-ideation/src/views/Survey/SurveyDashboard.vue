<template>
  <div>
    <div class="headerDashboard">
      <h1>Survey Dashboard</h1>
      <general-button @click.native="showSurvey">Preview Survey</general-button>
      <share-survey-modal :shareableLink="encodeShareLink">Share Survey</share-survey-modal>
      <general-button @click.native="showSummary"> Summarize Survey</general-button>
    </div>
    <div class="summary">
      <h2>Survey Statistic</h2>
      <div class="cardFlexContainer">
        <dashboard-card>
          <template #logo>
            <sign-up :gradientBoolean="true"></sign-up
          ></template>
          <template #title> <h4>Responses</h4></template>
          <template #content>
            <h1>{{ totalResponse }}</h1>
          </template>
        </dashboard-card>
        <dashboard-card>
          <template #logo> <eyes :gradientBoolean="true"></eyes></template>
          <template #title> <h4>Total Views</h4></template>
          <template #content>
            <h1>{{ totalView }}</h1>
          </template>
        </dashboard-card>
        <dashboard-card>
          <template #logo>
            <revenue-target :gradientBoolean="true"></revenue-target>
          </template>
          <template #title> <h4>Responses Goal</h4></template>
          <template #content>
            <h1>{{ goalResponse }}</h1>
          </template>
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
import RevenueTarget from "../../components/icons/revenueTarget.vue";
import ChartCard from "@/components/ChartCard.vue";
import GeneralButton from "@/components/GeneralButton.vue";
import surveyApi from "@/api/surveyApi.js";
import { mapGetters } from "vuex";
import ShareSurveyModal from '../../components/ShareSurveyModal.vue';
export default {
  components: {
    DashboardCard,
    SignUp,
    Eyes,
    RevenueTarget,
    ChartCard,
    GeneralButton,
    ShareSurveyModal,
  },
  data() {
    return {
      //Response Survey data
      totalResponse: 0,
      totalView: 0,
      goalResponse: 0,
      currentDate: undefined,
      todayPageView: 0,
      remainderPageView: 0,

      series: [
        {
          name: "Views",
          data: [],
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
          type: "datetime",
        },
      },
    };
  },
  methods: {
    showSummary() {
      this.$router.push("summary");
    },
    showSurvey(){
      this.$router.push({name: "Survey"})
    }
  },

  computed: {
    encodeShareLink(){
      let encodeProjectID = btoa(this.currentProjectID);
      return window.location.origin + "/survey/share/" + encodeProjectID;
    },
    ...mapGetters(["currentProjectID"]),
  },

  async created() {
    //Get Survey Data and Bind
    let surveyData = await surveyApi.getSurveyData(this.currentProjectID);
    this.totalResponse = surveyData.data.surveyData[0].responses;
    this.totalView = surveyData.data.surveyData[0].total_view;
    this.goalResponse = surveyData.data.surveyData[0].responses_goal;
    this.currentDate = surveyData.data.surveyData[0].current_date;
    this.todayPageView = surveyData.data.surveyData[0].today_view;
    this.remainderPageView = surveyData.data.surveyData[0].remainder_view
    this.series = [
      {
        data: JSON.parse(surveyData.data.surveyData[0].series),
      },
    ];

    
    let today = new Date().toLocaleDateString();
    let projectdate = new Date(this.currentDate).toLocaleDateString();
    //If projectdate is today
    if (projectdate == today) {
      //Keep replacing with latest today data
      let newData = this.series[0].data;
      let newTodayPageView = { x: this.currentDate, y: this.todayPageView };
      // newData[newData.length] = newTodayPageView;
      newData.splice(newData.length - 1, 1, newTodayPageView);
      this.series = [
        {
          data: newData,
        },
      ];
      //Update Database
      let jsonSeries = JSON.stringify(this.series[0].data);
      let payloadUpdate = {
        updateSeries: jsonSeries,
      };
      await surveyApi.updateSeries(this.currentProjectID, payloadUpdate);
    }

        //If projectdate is not today
    else if (projectdate != today) {
      //Reset today page view and add remainder
      let pageviewResetRemainder = 0 + this.remainderPageView;
      let payload = {
        newTodayPageView: pageviewResetRemainder,
      };
      await surveyApi.resetUpdateTodayPageView(this.currentProjectID, payload);

      //Update with new Series of data
      let newData = this.series[0].data;
      newData.push({ x: today, y: pageviewResetRemainder });
      this.series = [
        {
          data: newData,
        },
      ];
      //Update Series Database
      let jsonSeries = JSON.stringify(this.series[0].data);
      let payloadUpdate = {
        updateSeries: jsonSeries,
      };
      await surveyApi.updateSeries(this.currentProjectID, payloadUpdate);

      //Update Project date
      let payload2 = {
        newCurrentDate: today,
      };
      this.currentDate = today;
      await surveyApi.updateCurrentDate(this.currentProjectID, payload2);
    }


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