<template>
  <div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="-1 -1 34 34">
      <circle cx="16" cy="16" r="15.9155" class="progress-bar__background" />
      <circle
        cx="16"
        cy="16"
        r="15.9155"
        class="progress-bar__progress js-progress-bar"
      />
    </svg>
  </div>
</template>

<script>
export default {};
</script>

<style scoped lang='scss'>
$progress-bar-stroke-width: 1.8;
$progress-bar-size: 100px;

svg {
  height: $progress-bar-size;
  transform: rotate(-90deg);
  width: $progress-bar-size;
}

.progress-bar__background {
  fill: none;
  stroke: #e2eff0;
  stroke-width: $progress-bar-stroke-width;
}

.progress-bar__progress {
  fill: none;
  stroke: #e2eff0;
  stroke: #78bec7;
  stroke-dasharray: 100 100;
  stroke-dashoffset: 100;
  stroke-linecap: round;
  stroke-width: $progress-bar-stroke-width;
  transition: stroke-dashoffset 1s ease-in-out;
}
</style>