<template>
  <svg
    aria-hidden="true"
    focusable="false"
    data-prefix="fas"
    data-icon="xmark"
    class="svg-inline--fa fa-xmark"
    role="img"
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 320 512"
    @mouseover="toggleHover ? gradientBoolean = true : null"
    @mouseleave="toggleHover ? gradientBoolean = false : null"
  >
    <defs>
      <linearGradient id="gradientColor" x1="0%" y1="0%" x2="0%" y2="100%">
        <stop offset="0%" stop-color="#8743FF" />
        <stop offset="100%" stop-color="#4136F1" />
      </linearGradient>
    </defs>
    <path
      :fill="currentColor"
      d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"
    ></path>
  </svg>
</template>

<script>
export default {
  props: {
    toggleHover: {
      type: Boolean,
    },
  },
  data() {
    return {
      gradientBoolean: false,
      gradientColor: "url(#gradientColor)",
      defaultColor: "currentColor",
    };
  },
  computed: {
    currentColor() {
      if (this.gradientBoolean || this.toggleHover === false) {
        return this.gradientColor;
      } else {
        return this.defaultColor;
      }
    },
  },
};
</script>

<style lang='scss' scoped>
</style>