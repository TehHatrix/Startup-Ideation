<template>
  <div class="container">
    <div class="headerDashboard">
      <h1>Landing Page Dashboard</h1>
      <general-button @click.native="editLanding"> Edit Page</general-button>
      <general-button @click.native="previewLanding">
        Preview Page</general-button
      >
      <share-landing-modal :shareableLink="encodeShareLink"
        >Share Page</share-landing-modal
      >
      <disabled-button class="trashButton" @click.native="handleDelete()"
        ><font-awesome-icon icon="fa-solid fa-trash-can"
      /></disabled-button>
    </div>
    <div class="summary">
      <h2>Landing Page Statistic</h2>
      <div class="cardFlexContainer">
        <dashboard-card>
          <template #logo>
            <sign-up :gradientBoolean="true"></sign-up
          ></template>
          <template #title> <h4>Sign Ups</h4></template>
          <template #content>
            <h1>{{ signups }}</h1>
          </template>
        </dashboard-card>
        <dashboard-card>
          <template #logo> <eyes :gradientBoolean="true"></eyes></template>
          <template #title> <h4>Total Unique Views</h4></template>
          <template #content>
            <h1>{{ uniqueviews }}</h1>
          </template>
        </dashboard-card>
        <dashboard-card>
          <template #logo>
            <revenue :gradientBoolean="true"> </revenue
          ></template>
          <template #title> <h4>Expected Revenue</h4></template>
          <template #content>
            <h1>RM {{ expectedrevenue }}</h1>
          </template>
        </dashboard-card>
        <dashboard-card>
          <template #logo>
            <revenue-target :gradientBoolean="true"></revenue-target>
          </template>
          <template #title> <h4>Goals Revenue</h4></template>
          <template #content>
            <h1>RM {{ goalsrevenue }}</h1>
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
import Revenue from "../../components/icons/revenue.vue";
import RevenueTarget from "../../components/icons/revenueTarget.vue";
import ChartCard from "@/components/ChartCard.vue";
import GeneralButton from "@/components/GeneralButton.vue";
import landingApi from "@/api/landingApi.js";
import { mapGetters } from "vuex";
import ShareLandingModal from "../../components/ShareLandingModal.vue";
import DisabledButton from "@/components/DisabledButton.vue";
export default {
  components: {
    DashboardCard,
    SignUp,
    Eyes,
    Revenue,
    RevenueTarget,
    ChartCard,
    GeneralButton,
    ShareLandingModal,
    DisabledButton,
  },
  computed: {
    ...mapGetters(["currentProjectID"]),
    encodeShareLink() {
      let encodelandingID = btoa(this.currentProjectID);
      return window.location.origin + "/landingpage/" + encodelandingID;
    },
  },
  data() {
    return {
      signups: 0,
      uniqueviews: 0,
      expectedrevenue: 0,
      goalsrevenue: 0,
      currentDate: undefined,
      todayPageView: 0,
      remainderPageView: 0,
      landingHTML: "",
      landingCSS: "",

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
    async handleDelete(){
      alert("Are you sure you want to delete this Landing Page?")
      await landingApi.deleteLandingPage(this.currentProjectID);
      this.$router.push({name:"Project"})
    },
    editLanding() {
      //Set Editing Mode
      this.$store.commit("setEditingMode", true);
      this.$router.push("/editor/landing");
    },
    previewLanding() {
      this.$store.commit("setPreviewTrue");
      this.$router.push("/landingpage");
    },
    async getLandingData() {
      let landingdata = await landingApi.getLandingData(this.currentProjectID);
      if (landingdata.data.success) {
        this.signups = landingdata.data.data[0].sign_ups;
        this.uniqueviews = landingdata.data.data[0].unique_view;
        this.expectedrevenue = landingdata.data.data[0].expected_revenue;
        this.goalsrevenue = landingdata.data.data[0].target_revenue;
        this.currentDate = landingdata.data.data[0].currentdate;
        this.todayPageView = landingdata.data.data[0].today_pageview;
        this.remainderPageView = landingdata.data.data[0].remainder_pageview;
        this.landingHTML = landingdata.data.data[0].landingHTML;
        this.landingCSS = landingdata.data.data[0].landingCSS;
        this.series = [
          {
            data: JSON.parse(landingdata.data.data[0].series),
          },
        ];
        // console.log(typeof(landingdata.data.data[0].series))
      } else if (landingdata.data.success === false) {
        throw new Error("Cannot Get Landing Page data");
      }
    },
  },
  mounted() {},

  async created() {
    await this.getLandingData();
    // let today = new Date(2022,1,21)

    let today = new Date().toLocaleDateString();
    let projectdate = new Date(this.currentDate).toLocaleDateString();
    //Current Date not pushed to series chart yet
    // let findCurrentDate = this.series[0].data.find(
    //   (e) => e.x === this.currentDate
    // );
    // if (findCurrentDate === undefined) {
    //   console.log("meow")
    //   //Update New Series to database
    //   console.log(this.series)
    //   // let newData = this.series[0].data;
    //   // newData.push({ x: this.currentDate, y: this.todayPageView });

    //   // this.series = [
    //   //   {
    //   //     data: newData,
    //   //   },
    //   // ];
    //   console.log(this.series)
    // }

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
      await landingApi.updateSeries(this.currentProjectID, payloadUpdate);
    }

    //If projectdate is not today
    if (projectdate != today) {
      //Reset today page view and add remainder
      let pageviewResetRemainder = 0 + this.remainderPageView;
      let payload = {
        newTodayPageView: pageviewResetRemainder,
      };
      await landingApi.updateTodayPageView(this.currentProjectID, payload);
      await landingApi.resetRemainderPageView(this.currentProjectID);

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
      await landingApi.updateSeries(this.currentProjectID, payloadUpdate);

      //Update Project date
      let payload2 = {
        newCurrentDate: today,
      };
      this.currentDate = today;
      await landingApi.updateCurrentDate(this.currentProjectID, payload2);
    }
  },
};
</script>

<style lang="scss" scoped>
* {
  margin: 10px;
}

.trashButton {
  ::v-deep button {
    width: 40px;
    height: 40px;
    cursor: pointer;
  }
    .fa-trash-can{
      margin: -1px;
    }
    
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