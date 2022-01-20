<template>
  <div>
    <div class="container text-center">
      <h1 class="display-3">Thank You for interested with our product!</h1>
      <p class="lead">
          Our team will contact you when your spot is ready.
      </p>
      <hr />
      <p class="lead">
        <general-button @click.native="routeBack"
          >Back to Landing Page</general-button
        >
      </p>
    </div>
  </div>
</template>

<script>
import GeneralButton from "../../components/GeneralButton.vue";
export default {
  components: {
    GeneralButton,
  },
  methods: {
    routeBack() {
      this.$router.go(-1);
    },
  },
};
</script>

<style lang="scss" scoped>
.container{
    margin-top: 200px;
}
</style>