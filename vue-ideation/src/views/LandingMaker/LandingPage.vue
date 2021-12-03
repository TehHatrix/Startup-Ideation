<template>
  <div v-html="savedHTML">
    
  </div>
</template>

<script>
  export default {
    data() {
      return {
        styleTag: "",
        savedHTML: ""
      }
    },
    mounted () {
      let css = this.$store.state.landingRepository.pageCSS;
      this.savedHTML = this.$store.state.landingRepository.pageHTML;
      this.styleTag = document.createElement('style');
      this.styleTag.appendChild(document.createTextNode(css));
      document.head.appendChild(this.styleTag);
    },
    destroyed() {
    this.styleTag.remove();
  }
    
  }
</script>

<style lang="scss" scoped>

</style>