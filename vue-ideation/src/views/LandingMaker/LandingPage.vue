<template>
  <div id="vueBody">
    <div v-if="loading"><loading-screen></loading-screen></div>
    <div id="templateContainer" v-show="!loading">
      <circle-arrow-left
        v-if="previewMode"
        @click.native="routeBack"
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
                  v-model="userName"
                  required
                />
                <h3>Email Address</h3>
                <div class="goalsCurrency">
                  <input
                    type="email"
                    class="inputField"
                    name="name"
                    id="name"
                    v-model="userEmail"
                    required
                  />
                </div>

                <div class="footerButton">
                  <general-button @click.native="showModal = false">
                    Close</general-button
                  >
                  <disabled-button v-if="previewMode">Disabled</disabled-button>
                  <general-button v-else @click.native="sendDataLanding()">
                    Get Started</general-button
                  >
                </div>
              </div>
            </transition>
          </div>
        </transition>
      </div>
    </div>
  </div>
</template>

<script>
import GeneralButton from "../../components/GeneralButton.vue";
import circleArrowLeft from "@/components/icons/circlearrowleft.vue";
import { mapGetters } from "vuex";
import landingApi from "@/api/landingApi.js";
import DisabledButton from "../../components/DisabledButton.vue";
import LoadingScreenVue from "../../components/general/LoadingScreen.vue";
export default {
  components: {
    GeneralButton,
    circleArrowLeft,
    DisabledButton,
    "loading-screen": LoadingScreenVue,
  },
  data() {
    return {
      loading: false,
      currentID: 0,
      showModal: false,
      previewMode: false,
      styleTag: "",
      savedHTML: "",
      currentDate: undefined,
      remainderPageView: 0,
      totalpageView: 0,
      todayPageView: 0,
      currentprice: 0,
      userName: "",
      userEmail: "",
      publicMode: false,
    };
  },
  methods: {
    routeBack() {
      this.$store.commit("setPreviewFalse");
      this.$store.commit("setFromPreview", true);
      this.$router.go(-1);
    },
    checkInputPricing() {
      //Error Handling for email and name
      if (this.userName == "") {
        this.$store.commit("setTypeToast", "Error");
        this.$store.commit("setMessage", "Please enter your name");
        this.$store.commit("showToast");
        return false;
      } else if (this.userEmail == "") {
        this.$store.commit("setTypeToast", "Error");
        this.$store.commit("setMessage", "Please enter your email");
        this.$store.commit("showToast");
        return false;
      } else {
        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (emailPattern.test(this.userEmail) === false) {
          this.$store.commit("setTypeToast", "Error");
          this.$store.commit("setMessage", "Please enter an appropriate email");
          this.$store.commit("showToast");
          return false;
        }
      }
      return true;
    },
    async sendDataLanding() {
      this.checkInputPricing();
      if (this.checkInputPricing()) {
        //Store to pricing user (projectID, pricinguserdata)
        let pricingUser = {
          name: this.userName,
          email: this.userEmail,
          pricing: this.currentprice,
        };
        await landingApi.storePricingUser(this.currentID, pricingUser);
        //Get money
        let payload = {
          revenue: this.currentprice,
        };
        //incrementdatabaseSignUp
        await landingApi.handleRevenueSignUp(this.currentID, payload);
        //Add to earlyadopterlanding table (later feature)
        //Route to thank you page
        this.$router.push({ name: "LandingThankYou" });
      }
    },

    injectpricingButton() {
      let pricingbuttons =
        this.$refs["template"].getElementsByClassName("pricing-btn");
      let price = this.$refs["template"].getElementsByClassName("price");
      this.$nextTick(() => {
        for (let i = 0; i < pricingbuttons.length; i++) {
          pricingbuttons[i].addEventListener("click", function () {
            var vueInstance = document.getElementById("vueBody").__vue__;
            vueInstance.currentprice = price[i].innerText.match(/\d+/)[0];
            vueInstance.showModal = true;
          });
        }
      });
    },
    async getDataLanding(projectID) {
      let landing = landingApi.getLandingData(projectID);
      return landing;
    },
  },
  computed: {
    ...mapGetters([
      "currentTemplate",
      "pageHTML",
      "pageCSS",
      "previewModeRepo",
    ]),
  },
  mounted() {
    if (this.previewMode) {
      let css = this.pageCSS;
      this.savedHTML = this.pageHTML;
      this.styleTag = document.createElement("style");
      this.styleTag.appendChild(document.createTextNode(css));
      document.head.appendChild(this.styleTag);
      let pricingbuttons =
        this.$refs["template"].getElementsByClassName("pricing-btn");
      this.$nextTick(() => {
        for (let i = 0; i < pricingbuttons.length; i++) {
          pricingbuttons[i].addEventListener("click", function () {
            var vueInstance = document.getElementById("vueBody").__vue__;
            vueInstance.showModal = true;
          });
        }
      });
    }
  },

  async created() {
    this.$store.commit("closeToast");
    this.previewMode = this.previewModeRepo;
    //Get Landing Page Data
    if (this.previewMode === false) {
      let projectID = atob(this.$route.params.landingID);
      let landing = await this.getDataLanding(projectID);
      this.savedHTML = landing.data.data[0].landingHTML;
      let css = landing.data.data[0].landingCSS;
      this.styleTag = document.createElement("style");
      this.styleTag.appendChild(document.createTextNode(css));
      document.head.appendChild(this.styleTag);
      this.injectpricingButton();
      this.currentID = projectID;
      this.currentDate = landing.data.data[0].currentdate;
      this.todayPageView = landing.data.data[0].today_pageview;
      this.totalpageView = landing.data.data[0].unique_view;
      this.remainderPageView = landing.data.data[0].remainder_pageview;
    }

    //Count Page views
    if (this.previewMode === false) {
      // let today = new Date().toLocaleDateString();
      let today = new Date().toLocaleDateString();
      let projectdate = new Date(this.currentDate).toLocaleDateString();
      // Means dashboard not updated & reseted (remainder page view will be added when dashboard is visited).
      if (projectdate != today) {
        await landingApi.incrementRemainderPageView(this.currentID);
        await landingApi.incrementTotalPageView(this.currentID);
      }
      //Currentdate == today
      else {
        //Todaypageview++
        await landingApi.incrementTodayPageView(this.currentID);
        //Totalpageview++
        await landingApi.incrementTotalPageView(this.currentID);
      }
    }
    this.loading = false;
  },
  destroyed() {
    this.$store.commit("setPreviewFalse");
    this.styleTag.remove();
  },
};
</script>

<style>
body #templateContainer {
  background-image: linear-gradient(#ffffff, #ffffff);
}
</style>

<style lang="scss" scoped>
.sticky {
  position: fixed;
  top: 85px;
  z-index: 999;
  height: 50px;
  width: 50px;
  margin-left: 30px;
  cursor: pointer;
  ::v-deep svg {
    height: 30px;
    width: 30px;
  }
}

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