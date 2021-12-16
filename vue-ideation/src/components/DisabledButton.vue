<template>
  <div>
    <div class="wrap">
      <button class="button"><slot></slot></button>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>
.wrap {
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.button {
  width: 140px;
  height: 45px;
  font-family: 'Poppins', sans-serif;
  font-size: 13px;
  letter-spacing: 1.0px;
  font-weight: 500;
  color: #fff;
//   background-color: rgb(255, 255, 255);
background: linear-gradient(180deg, #FF3156 0%, #B10404 100%);
  border: none;
  border-radius: 45px;
  box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.212);
  transition: all 0.3s ease 0s;
  outline: none;
  }
</style>