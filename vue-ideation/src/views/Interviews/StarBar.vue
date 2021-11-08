<template>
  <div class="progress">
    <div class="progress_bar"></div>
  </div>
</template>

<script>
export default {};
</script>

<style scoped>
.progress {
  width: 100%;
  max-width: 130px;
  background: white;
  border-radius: 7px;
  height: 7px;
}

.progress .progress_bar {
  height: 100%;
  width: 100%;
  border-radius: 4px;
  background: linear-gradient(270deg, #8743FF 0%, #4136F1 100%);
  transition: 0.3s;
}

</style>