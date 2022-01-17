<template>
  <div id="templateContainer">
    <circle-arrow-left
      v-if="previewMode"
      @click.native="routeEditor"
      class="sticky"
    ></circle-arrow-left>
    <div v-html="savedHTML" ref="template"></div>
    <div id="modal-comp">
      <transition name="fade" appear>
        <div
          class="modal-overlay"
          v-if="showModal"
          @click="showModal = false"
        ></div>
      </transition>
      <transition name="slide" appear>
        <div class="modal" v-if="showModal">
          <transition name="fade" appear>
            <div class="preInterview">
              <h1>Pricing Subscription Form</h1>
              <slot name="hypothesisTitle"> </slot>
              <h3>Your Name</h3>
              <input
                type="text"
                class="inputField"
                name="name"
                id="name"
                required
              />
              <h3>Email Address</h3>
              <div class="goalsCurrency">
                <input
                  type="text"
                  class="inputField"
                  name="name"
                  id="name"
                  required
                />
              </div>

              <div class="footerButton">
                <general-button @click.native="showModal = false">
                  Close</general-button
                >
                <general-button @click.native="sendDataLanding">
                  Get Started</general-button
                >
              </div>
            </div>
          </transition>
        </div>
      </transition>
    </div>
  </div>
</template>

<script>
import GeneralButton from "../../components/GeneralButton.vue";
import circleArrowLeft from "@/components/icons/circlearrowleft.vue";
import { mapGetters } from "vuex";
export default {
  components: { GeneralButton, circleArrowLeft },
  data() {
    return {
      showModal: false,
      previewMode: false,
      styleTag: "",
      savedHTML: "",
    };
  },
  methods: {
    routeEditor() {
      this.$router.push("editor/landing");
    },
    sendDataLanding(){

    },
  },
  computed: {
    ...mapGetters(["currentTemplate"]),
  },
  mounted() {
    this.previewMode = this.$store.state.landingRepository.previewMode;
    let css = this.$store.state.landingRepository.pageCSS;
    this.savedHTML = this.$store.state.landingRepository.pageHTML;
    this.styleTag = document.createElement("style");
    this.styleTag.appendChild(document.createTextNode(css));
    document.head.appendChild(this.styleTag);

    let pricingbuttons =
      this.$refs["template"].getElementsByClassName("pricing-btn");
    this.$nextTick(() => {
      for (let i = 0; i < pricingbuttons.length; i++) {
        pricingbuttons[i].addEventListener("click", function () {
          var vueInstance =
            document.getElementById("templateContainer").__vue__;
          vueInstance.showModal = true;
        });
      }
    });

    // switch (this.currentTemplate) {
    //   case "ideation":
    //     {

    //       break;
    //     }
    //   case "tech":
    //   {
    //     console.log("Test")
    //   }
    // }
  },
  destroyed() {
    this.styleTag.remove();
  },
};
</script>

<style>
.sticky {
  position: fixed;
  top: 5;
  z-index: 999;
  height: 50px;
  width: 50px;
  margin-left: 15px;
  cursor: pointer;
}

body #templateContainer {
  background-image: linear-gradient(#ffffff, #ffffff);
}
</style>

<style lang="scss" scoped>
::v-deep button {
  margin-top: 35px;
}

.inputField {
  border-radius: 5px;
  padding: 12px 20px;
  height: 30px;
  width: 100%;
  border: 1px solid #ccc;
  transition: all 0.3s ease 0s;

  &:focus {
    border: 1px solid rgb(133, 133, 133);
  }
}

.danger {
  border: 1px solid #ff3156;
}

.goalsCurrency {
  display: flex;
  .currency {
    display: flex;
    gap: 5px;
    height: 30px;
    justify-content: center;
    align-items: center;
    border-radius: 5px;
    padding: 5px;
    text-align: center;
    color: white;
    background: linear-gradient(180deg, #8743ff 0%, #4136f1 100%);
  }
}
.modal {
  display: grid;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 99;

  width: 100%;
  max-width: 800px;
  max-height: 750px;
  background-color: #fff;
  border-radius: 16px;
  overflow: scroll;
  padding: 25px;

  h1 {
    font-size: 32px;
  }
  h3 {
    font-size: 18.72px;
  }
  p {
    padding-top: 2px;
    padding-bottom: 3px;
  }

  .footerButton {
    margin-top: 25px;
    display: flex;
    gap: 20px;
  }
}

.modal-overlay {
  position: fixed;
  top: 0;
  right: 0;
  left: 0;
  bottom: 0;
  overflow: auto;
  z-index: 99;
  /* min-height: 100%; */
  background-color: rgba(0, 0, 0, 0.3);
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}

.slide-enter-active,
.slide-leave-active {
  transition: transform 0.5s;
}

.slide-enter,
.slide-leave-to {
  transform: translateY(-50%) translateX(100vw);
}
</style>