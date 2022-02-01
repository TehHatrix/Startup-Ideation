<template>
<div>
  <div class="containerNavigation">
    <nav>
      <!-- <h1>Startup Ideation System</h1> -->
      <div class="containerFlex">
        <span class="logo"
          > <strong>Startup Ideation System</strong> </span
        >
        <div class="menu">
          <p>
            Hey, {{ user.name }}!
            <font-awesome-icon icon="fa-regular fa-face-smile" />
          </p>
          <!-- <a href="#" class="is-active">Logout</a> -->
          <!-- <a href="#">About</a> -->
        </div>
      </div>
      <!-- <button class="hamburger">
        <span></span>
        <span></span>
        <span></span>
      </button> -->
    </nav>
  </div>
  <slot></slot>
</div>

</template>

<script>
import { mapGetters } from "vuex";
export default {
  computed: {
    ...mapGetters(["user"]),
  },

};
</script>

<style lang="scss" scoped>
.logo {
  display: flex;
  align-items: center;
  gap: 10px;
}

.containerFlex {
  display: flex;
}

img {
  height: 40px;
  width: 40px;
}

.containerNavigation {
  max-width: 1280px;
  margin: 0 auto;
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 50px;
}

h1 {
  font-size: 28px;
}

nav {
  position: fixed;
  top: 0;
  left: 80px;
  right: 0;
  z-index: 99;
  background-color: #fff;
  padding: 2px 32px;
  border-bottom: 3px solid #8743ff;
}

.menu {
  display: flex;
  flex: 1 1 0%;
  justify-content: flex-end;
  margin: 0 -16px;
}

.menu p {
  margin-top: 0px;
}

.menu a {
  color: black;
  margin: 0 16px;
//   margin-top: 10px;
  font-weight: 600;
  text-decoration: none;
  transition: 0.4s;
//   padding-top: 8px;
text-align: center;
  padding: 8px 16px;
  padding-bottom: 5px;
  border-radius: 99px;
}

.menu a.is-active,
.menu a:hover {
  color: white;
//   padding: 8px 16px;
  background: linear-gradient(180deg, #8743ff 0%, #4136f1 100%);
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins";
}

.hamburger {
  display: block;
  position: relative;
  z-index: 1;

  user-select: none;

  appearance: none;
  border: none;
  outline: none;
  background: none;
  cursor: pointer;
}

.hamburger span {
  display: block;
  width: 33px;
  height: 4px;
  margin-bottom: 5px;
  position: relative;

  background: linear-gradient(180deg, #8743ff 0%, #4136f1 100%);
  border-radius: 6px;
  z-index: 1;

  transform-origin: 0 0;
  transition: 0.4s;
}

.hamburger:hover span:nth-child(2) {
  transform: translateX(10px);
}

.hamburger.is-active span:nth-child(1) {
  transform: translate(0px, -2px) rotate(45deg);
}

.hamburger.is-active span:nth-child(2) {
  opacity: 0;
  transform: translateX(15px);
}

.hamburger.is-active span:nth-child(3) {
  transform: translate(-3px, -3px) rotate(-45deg);
}
</style>