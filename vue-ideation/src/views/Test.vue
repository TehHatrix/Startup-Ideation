<template>
  <div>
    <!-- <img alt="Vue logo" src="../assets/logo.png"> -->
    <register-form></register-form>
    <tab-bar></tab-bar>
  </div>
</template>

<script>
// @ is an alias to /src
import RegisterForm from './Interviews/RegisterForm.vue';
import TabBar from './LandingMaker/TabBar.vue';
export default {
  name: "Test",
  data() {
    return {
      sliderValue: [],
    };
  },
  components: {
    RegisterForm,
    TabBar,
  },
  methods: {
  },
  mounted() {
  },
};
</script>

