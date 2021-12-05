<template>
  <div>
    <general-button v-if="previewMode" @click.native="routeEditor"> Back to Editor </general-button>
    <div v-html="savedHTML">
    </div>
  </div>
</template>

<script>
import GeneralButton from '../../components/GeneralButton.vue';
export default {
  components: { GeneralButton },
  data() {
    return {
      previewMode: false,
      styleTag: "",
      savedHTML: "",
    };
  },
  methods: {
    routeEditor() {
      this.$router.push('editor/landing')
    }
  },
  mounted() {
    this.previewMode = this.$store.state.landingRepository.previewMode;
    let css = this.$store.state.landingRepository.pageCSS;
    this.savedHTML = this.$store.state.landingRepository.pageHTML;
    this.styleTag = document.createElement("style");
    this.styleTag.appendChild(document.createTextNode(css));
    document.head.appendChild(this.styleTag);
  },
  destroyed() {
    this.styleTag.remove();
  },
};
</script>

<style lang="scss" scoped>
</style>