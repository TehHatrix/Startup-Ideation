<template>
  <div>
    <button class="button">
      <slot>test</slot>
    </button>
  </div>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>
.button {
  appearance: none;
  outline: none;
  border: none;
  background: none;
  cursor: pointer;

  display: inline-block;
  padding: 10px 10px;
  background: linear-gradient(180deg, #8743ff 0%, #4136f1 100%);
  border-radius: 8px;
  color: #fff;
  font-size: 15px;
  font-weight: 600;

  box-shadow: 3px 3px rgba(0, 0, 0, 0.4);
  transition: 0.4s ease-out;
  &:hover {
    box-shadow: 6px 6px rgba(0, 0, 0, 0.6);
  }
}
</style>