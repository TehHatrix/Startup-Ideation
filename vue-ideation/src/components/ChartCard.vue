<template>
  <div class="card">
    <div id="chart">
      <apexchart
        type="line"
        height="350"
        :options="chartOptions"
        :series="series"
      ></apexchart>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      series: [
        {
          name: "Desktops",
          data: [10, 41, 35, 51, 49, 62, 69, 91, 148],
        },
      ],
      chartOptions: {
        chart: {
          height: 350,
          type: "line",
          fontFamily: "Poppins",
          zoom: {
            enabled: false,
          },
        },
        dataLabels: {
          enabled: false,
        },
        stroke: {
          curve: "smooth",
          width: 7,
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
          colors: ["#8743FF", "#4136F1"],
          type: "gradient",
          gradient: {
            type: "diagonal2",
            gradientToColors: ["#8743FF"],
            shadeIntensity: 1,
            opacityFrom: 1,
            opacityTo: 1,
            stops: [100, 100, 100, 100],
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
};
</script>

<style lang="scss" scoped>
.card {
  height: 500px;
  width: auto;
  background: #fff;
  box-shadow: 0 5px 8px rgba(0, 0, 0, 0.16), 0 5px 8px rgba(0, 0, 0, 0.23);
  border-radius: 30px;
  transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
  &:hover {
    box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
  }
  #chart {
      padding-top: 20px;
      padding-left: 20px;
      padding-right: 20px;
  }
}
</style>