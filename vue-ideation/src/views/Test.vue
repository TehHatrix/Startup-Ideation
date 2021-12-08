<template>
   <div id="chart">
        <apexchart type="line" height="350" :options="chartOptions" :series="series"></apexchart>
      </div>
</template>

<script>
// @ is an alias to /src
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
          zoom: {
            enabled: false,
          },
        },
        dataLabels: {
          enabled: false,
        },
        stroke: {
          curve: "straight",
        },
        title: {
          text: "Product Trends by Month",
          align: "left",
        },
        grid: {
          row: {
            colors: ["#f3f3f3", "transparent"], // takes an array which will be repeated on columns
            opacity: 0.5,
          },
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
  components: {
    RegisterForm,
  },
  methods: {
  },
  mounted() {
    console.log(this)
    console.log(process.env.VUE_APP_TEST)
    // this.show();
    // function setTicks(slider) {
    //   let container = document.getElementById(slider.dataset.tickId);
    //   const spacing = parseFloat(slider.dataset.tickStep);
    //   const sliderRange = slider.max - slider.min;
    //   const tickCount = sliderRange / spacing + 1; // +1 to account for
    //   for (let ii = 0; ii < tickCount; ii++) {
    //     let tick = document.createElement("span");
    //     tick.className = "tick-slider-tick";
    //     container.appendChild(tick);
    //   }
    // }
    // function init() {
    //   const sliders = document.getElementsByClassName("tick-slider-input");
    //   for (let slider of sliders) {
    //     // slider.oninput = onSliderInput;
    //     // updateValue(slider);
    //     // updateValuePosition(slider);
    //     // updateLabels(slider);
    //     // updateProgress(slider);
    //     setTicks(slider);
    //   }
    // }
    // function onResize() {
    //   const sliders = document.getElementsByClassName("tick-slider-input");
    //   for (let slider of sliders) {
    //     this.updateValuePosition(slider);
    //   }
    // }
    // window.onload = init();
    // window.addEventListener("resize", onResize);
  },
};
</script>

