<template>
  <div class="card">
      <font-awesome-icon icon="fa-regular fa-circle-plus" />
      <div class = "plusSign">
          

      </div>
  </div>
</template>

<script>
export default {};
</script>

<style scoped>
.card {
  width: 220px;
  height: 220px;
  border-radius: 40px;
  box-shadow: 5px 5px 30px 7px rgba(0, 0, 0, 0.25),
    -5px -5px 30px 7px rgba(0, 0, 0, 0.22);
  cursor: pointer;
  transition: 0.3s ease-out;
  background: #fff;
}

.card:hover {
  transform: scale(0.9, 0.9);
  box-shadow: 5px 5px 30px 15px rgba(0, 0, 0, 0.25),
    -5px -5px 30px 15px rgba(0, 0, 0, 0.22);
}
</style>