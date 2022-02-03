<template>
  <div>
    <general-button @click.native="showModal = true">
      View Sign Ups
    </general-button>
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
              <h2>Sign Up Responses</h2>
              <div v-if="this.pricingUsers.length == 0"> There are no responses yet! Share your landing page to get responses!</div>
              <div
                class="responseCard"
                v-for="(user, index) in pricingUsers"
                :key="index"
              >
                <span class="iconColor"
                  ><font-awesome-icon icon="fa-solid fa-font" />
                </span>
                Name : <strong>{{ user.username }}</strong> <br />
                <span class="iconColor"
                  ><font-awesome-icon icon="fa-regular fa-envelope" />
                </span>
                Email : <strong>{{ user.useremail }}</strong>
              </div>
            </div>
          </transition>
        </div>
      </transition>
    </div>
  </div>
</template>

<script>
import GeneralButton from "./GeneralButton.vue";
import landingApi from "@/api/landingApi.js";
import { mapGetters } from "vuex";
export default {
  components: { GeneralButton },
  data() {
    return {
      showModal: false,
      pricingUsers: undefined,
    };
  },
  computed: {
    ...mapGetters(["currentProjectID"]),
  },
  async created() {
    let pricingUsers = await landingApi.getPricingUser(this.currentProjectID);
    this.pricingUsers = pricingUsers.data.data;
    console.log(this.pricingUsers);
  },
};
</script>

<style lang="scss" scoped>
.iconColor {
  color: #8743ff;
  margin-left: 5px;
}

.responseCard {
  height: auto;
  width: auto;
  margin: 20px;
  padding-top: 10px;
  padding-bottom: 10px;
  background: #fff;
  box-shadow: 0 5px 8px rgba(0, 0, 0, 0.16), 0 5px 8px rgba(0, 0, 0, 0.23);
  border-radius: 5px;
  transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
  overflow: scroll;
  &:hover {
    box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
  }
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