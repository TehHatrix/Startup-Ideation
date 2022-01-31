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
  font-family: "Poppins", sans-serif;
  font-size: 13px;
  // text-transform: uppercase;
  letter-spacing: 1px;
  font-weight: 500;
  color: #fff;
  background: linear-gradient(180deg, #36f1a2 0%, #4136f1 100%, #36f1a2 100%);
  border: none;
  border-radius: 45px;
  box-shadow: 0px 8px 15px rgba(67, 255, 139, 0.425);
  transition: all 0.3s ease 0s;
  cursor: pointer;
  outline: none;
}

.button:hover {
  box-shadow: 0px 15px 20px rgba(67, 255, 139, 0.425);
  transform: translateY(-7px);
}
</style>