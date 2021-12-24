<template>
  <div class="containerCircular">
    <div class="outer">
      <div class="inner">
        <div id="number" >
          {{ passedPercentage + '%'
           }}        </div>
      </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="160px" height="160px">
         <defs>
            <linearGradient id="GradientColor">
               <stop offset="0%" stop-color="#4136F1" />
               <stop offset="100%" stop-color="#8743FF" />
            </linearGradient>
         </defs>
         <transition name="fade" appear>
           <circle cx="80" cy="80" r="70" stroke-linecap="round" :stroke-dashoffset="strokeOffset" :key="strokeOffset"  />
         </transition>
         
 </svg>
  </div>
</template>

<script>
export default {
  props: {
    passedPercentage: {
      type: Number,
    },
  },
  computed: {
  strokeOffset() {
    let offset = 472-472*(this.passedPercentage/100)
    return offset;
  }
},
};
</script>

<style scoped lang="scss">
.containerCircular {
  height: 160px;
  width: 160px;
  position: relative;
}
.outer {
  height: 160px;
  width: 160px;
  border-radius: 50%;
  border: 1 px solid purple;
  padding: 20px;
  box-shadow: 6px 6px 10px -1px rgba(0, 0, 0, 0.15),
    -6px -6px 10px -1px rgba(255, 255, 255, 0.7);
}

.inner {
  height: 120px;
  width: 120px;
  border-radius: 50%;
  border: 1 px solid purple;
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
  // stroke-dashoffset: 472;
  animation: anim 2s linear forwards;
}

svg{
  position: absolute;
  top:0;
  left: 0;
}

.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}

// calculate for 65% = 472-472 x 0.65 = 165.2
@keyframes anim{ 
  100%{
    // stroke-dashoffset: 200;
  } 

}
</style>
