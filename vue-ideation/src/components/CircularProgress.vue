<template>
  <div class="container">
    <div class="outer">
      <div class="inner">
        <div id="number" v-bind="percentage">
          {{ percentage + '%'
           }}        </div>
      </div>
    </div>
    <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="-1 -1 34 34">
      <circle cx="16" cy="16" r="15.9155" class="progress-bar__background" />
      <circle
        cx="16"
        cy="16"
        r="15.9155"
        class="progress-bar__progress js-progress-bar"
      />
    </svg> -->

    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="160px" height="160px">
         <defs>
            <linearGradient id="GradientColor">
               <stop offset="0%" stop-color="#4136F1" />
               <stop offset="100%" stop-color="#8743FF" />
            </linearGradient>
         </defs>
         <circle cx="80" cy="80" r="70" stroke-linecap="round" />
 </svg>
  </div>
</template>

<script>
export default {
  data() {
    return {
      percentage : 65
    }
  },

};
</script>

<style scoped lang="scss">
.container {
  height: 160px;
  width: 160px;
  position: relative;
}
.outer {
  height: 160px;
  width: 160px;
  border-radius: 50%;
  padding: 20px;
  box-shadow: 6px 6px 10px -1px rgba(0, 0, 0, 0.15),
    -6px -6px 10px -1px rgba(255, 255, 255, 0.7);
}

.inner {
  height: 120px;
  width: 120px;
  border-radius: 50%;
  display:flex;
  align-items: center;
  justify-content: center;
  box-shadow: inset 4px 4px 6px -1px rgba(0, 0, 0, 0.2),
    inset -4px -4px 6px -1px rgba(255, 255, 255, 0.7),
    -0.5px -0.5px 0px rgba(255, 255, 255, 1),
    0.5px 0.5px 0px rgba(0, 0, 0, 0.15), 0px 12px 10px -10px rgba(0, 0, 0, 0.05);
}

#number{
  font-weight: bold;
  color: #555;
}

circle{
  fill:none;
  stroke: url(#GradientColor);
  stroke-width: 20px;
  stroke-dasharray: 472;
  stroke-dashoffset: 472;
  animation: anim 2s linear forwards;
}

svg{
  position: absolute;
  top:0;
  left: 0;
}
// calculate for 65% = 472-472 x 0.65 = 165.2
@keyframes anim{ 
  100%{
    stroke-dashoffset: 165.2;
  } 

}


// $progress-bar-stroke-width: 1.8;
// $progress-bar-size: 100px;

// svg {
//   height: $progress-bar-size;
//   transform: rotate(-90deg);
//   width: $progress-bar-size;
// }

// .progress-bar__background {
//   fill: none;
//   stroke: #e2eff0;
//   stroke-width: $progress-bar-stroke-width;
// }

// .progress-bar__progress {
//   fill: none;
//   stroke: #e2eff0;
//   stroke: #448f99;
//   stroke-dasharray: 100 100;
//   stroke-dashoffset: 100;
//   stroke-linecap: round;
//   stroke-width: $progress-bar-stroke-width;
//   transition: stroke-dashoffset 1s ease-in-out;
// }
</style>
