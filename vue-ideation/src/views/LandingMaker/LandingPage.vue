<template>
  <div>
    <!-- home section starts  -->

    <section class="home" id="home">
      <div class="content">
        <h3>Product <span>Showcase</span></h3>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus
          suscipit porro nam libero natus error consequatur sed repudiandae eos
          quo?
        </p>
        <button class="buttonOrder">Pre-Order Now!</button>
      </div>
      <div class="image">
        <img src="@/assets/img/home-img.png" alt="" />
      </div>
    </section>
  </div>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>
section {
  font-family: "Poppins";
  padding-left: 5%;
  padding-right: 5%;
  background-color: #fff;
  .content h3 {
    font-size: 5.5rem;
    color: #333;
    margin-bottom: 10px;
  }
}

.home {
  display: flex;
}

.buttonOrder {
  border-radius: 8px;
  padding: 1em 2em;
  -webkit-appearance: none;
  appearance: none;
  font-weight: bold;
  background: linear-gradient(180deg, #8743ff 0%, #4136f1 100%);
  color: #fff;
  border: none;
  cursor :pointer;
}
</style>