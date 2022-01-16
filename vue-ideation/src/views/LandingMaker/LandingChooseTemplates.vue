<template>
  <div>
    <div class="header"><h3>Choose Your Templates</h3></div>
    <div class="templates">
      <div class="firstTemp">
        <h2>Ideation Template</h2>
        <!-- <div class="description">Description test</div> -->
        <div class="image">
          <img
            src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-1/template1-overview.png"
            alt="FirstTemplate"
          />
        </div>
        <div class="footerButton">
          <general-button @click.native="handlePreview('ideation')"
            >Preview Template</general-button
          >
          <general-button @click.native="handleChoose('ideation')"
            >Choose this template</general-button
          >
        </div>
      </div>
      <div class="secondTemp">
        <h2>Tech Template</h2>
        <!-- <div class="description">Description test</div> -->
        <div class="image">
          <img
            src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-2/template-overview.png"
            alt="SecondTemplate"
          />
        </div>
        <div class="footerButton">
          <general-button @click.native="handlePreview('tech')"
            >Preview Template</general-button
          >
          <general-button @click.native="handleChoose('tech')"
            >Choose this template</general-button
          >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import GeneralButton from "../../components/GeneralButton.vue";
export default {
  components: { GeneralButton },

  methods: {
    handlePreview(template) {
      switch (template) {
        case "ideation":
          this.$router.push({ name: "FirstTemplate" });
          break;
        case "tech":
          this.$router.push({ name: "SecondTemplate" });
          break;
        default:
          console.log("Invalid Template");
      }
    },

    handleChoose(template) {
      switch (template) {
        case "ideation":
          //Pass Ideation HTML CSS 
          this.$router.push({ name: "LandingEditor" });
          break;
        case "tech":
          this.$router.push({ name: "LandingEditor" });
          break;
        default:
          console.log("Invalid Template");
      }
    },
  },
};
</script>

<style lang="scss" scoped>
.header {
  font-size: 30px;
  text-align: center;
}
.templates {
  display: flex;
  justify-content: center;
  gap: 100px;
  h2 {
    display: flex;
    justify-content: center;
    margin-left: 40px;
  }
  img {
    height: 300px;
    width: 550px;
    margin-left: 40px;
  }
}

.description {
  color: #6b6b6b;
  margin-top: -10px;
  margin-bottom: 15px;
}

.footerButton {
  display: flex;
  justify-content: center;
  gap: 25px;
}
</style>