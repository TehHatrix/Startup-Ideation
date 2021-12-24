<template>
  <div class="container">
    <div class="card" @click="addCustomerClicked = true">
      <circlePlus> </circlePlus>
    </div>
    <transition name="fade" appear>
      <div
        class="modal-overlay"
        v-if="addCustomerClicked"
        @click="addCustomerClicked = false"
      ></div>
    </transition>
    <transition name="slide" appear>
      <div class="addCustomerModal" v-if="addCustomerClicked">
        <register-form
          v-if="addCustomerClicked"
          @closeForm="setboolCustomerClicked"
          @addCard="passAddParent"
        ></register-form>
      </div>
    </transition>
    <p><strong>Add New Customer</strong></p>
  </div>
</template>

<script>
import circlePlus from "@/components/icons/circlePlus.vue";
import RegisterForm from "./RegisterForm.vue";
export default {
  components: {
    circlePlus,
    RegisterForm,
  },
  data() {
    return {
      addCustomerClicked: false,
    };
  },
  methods: {
    setboolCustomerClicked() {
      this.addCustomerClicked = false;
    },
    passAddParent(customer_info) {
      this.$emit("addCard", customer_info);
    },
  },
};
</script>

<style lang ='scss' scoped>
.card {
  width: 220px;
  height: 220px;
  border-radius: 40px;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
  cursor: pointer;
  transition: 0.3s ease-out;
  background: #fff;
}

.card:hover {
  transform: scale(0.9, 0.9);
  box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);

  svg {
    transform: rotate(90deg);
  }
}

p {
  font-size: 20px;

  text-align: center;
}

.addCustomerModal {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 99;
  padding: 25px;
}

.modal-overlay {
  position: fixed;
  top: 0;
  right: 0;
  left: 0;
  bottom: 0;
  z-index: 98;
  overflow: auto;
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