<template>
  <div>
    <svg
      aria-hidden="true"
      focusable="false"
      data-prefix="fas"
      data-icon="arrow-right"
      class="svg-inline--fa fa-arrow-right"
      role="img"
      xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 448 512"
            @mouseover="gradientBoolean = true"
      @mouseleave="gradientBoolean = false"
    >
      <defs>
        <linearGradient id="gradientColor" x1="0%" y1="0%" x2="0%" y2="100%">
          <stop offset="0%" stop-color="#8743FF" />
          <stop offset="100%" stop-color="#4136F1" />
        </linearGradient>
      </defs>
      <path
        :fill="currentColor"
        d="M438.6 278.6l-160 160C272.4 444.9 264.2 448 256 448s-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L338.8 288H32C14.33 288 .0016 273.7 .0016 256S14.33 224 32 224h306.8l-105.4-105.4c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160C451.1 245.9 451.1 266.1 438.6 278.6z"
      ></path>
    </svg>
  </div>
</template>

<script>
export default {
    // props: {
    //     gradientBoolean: {
    //         type: Boolean,
    //     },
    // },
    data() {
        return {
            gradientBoolean:false,
            gradientColor:"url(#gradientColor)",
            defaultColor:"currentColor"
        }
    },
    computed: {
        currentColor() {
            if(this.gradientBoolean){
                return this.gradientColor
            }
            else{
                return this.defaultColor
            }
        },
    },
};
</script>
<style lang="scss" scoped>
</style>