<template>
  <div class="card">
    <div id="chart">
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
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