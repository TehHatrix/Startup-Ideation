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
  // text-transform: uppercase;
  letter-spacing: 1.0px;
  font-weight: normal;
  color: #000;
  background-color: rgb(255, 255, 255);
  border: none;
  border-radius: 45px;
  box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.212);
  transition: all 0.3s ease 0s;
  cursor: pointer;
  outline: none;
  }

.button:hover {
  background: linear-gradient(180deg, #8743FF 0%, #4136F1 100%);
  box-shadow: 0px 15px 20px rgba(136, 67, 255, 0.425);
  color: #fff;
  transform: translateY(-7px);
}
</style>