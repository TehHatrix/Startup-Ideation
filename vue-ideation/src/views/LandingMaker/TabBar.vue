<template>
  <div class="wrapper">
    <input type="radio" name="slider" checked id="home" />
    <input type="radio" name="slider" id="blog" />
    <input type="radio" name="slider" id="code" />
    <nav>
      <label for="home" class="home"><blocks></blocks></label>
      <label for="blog" class="blog"><styles></styles></label>
      <label for="code" class="code"><layers></layers></label>
      <div class="slider"></div>
    </nav>
    <section>
      <div class="content content-1">
        <div class="title">Blocks</div>
        <p></p>
      </div>
      <div class="content content-2">
        <div class="title">Styles</div>
        <p></p>
      </div>
      <div class="content content-3">
        <div class="title">Traits</div>
        <p></p>
      </div>
    </section>
  </div>
</template>

<script>
import blocks from "../../components/icons/blocks.vue";
import Layers from '../../components/icons/layers.vue'; 
import styles from "../../components/icons/style.vue";
export default {
  components: { blocks, styles, Layers },   
};
</script>

<style lang="scss" scoped>
::v-deep svg {
  height: 25px;
  width: 25px;
}

::selection {
  background: linear-gradient(180deg, #8743FF 0%, #4136F1 100%);
}
.wrapper {
  max-width: 200px;
  width: 100%;
  padding: 25px 30px 30px 30px;
  border-radius: 5px;
  background: #fff;
  box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.1);
}

.wrapper nav {
  position: relative;
  width: 80%;
  height: 50px;
  display: flex;
  align-items: center;
  gap: 10px;
}
.wrapper nav label {
  display: block;
  height: 70%;
  width: 35%;
  text-align: center;
  line-height: 50px;
  cursor: pointer;
  position: relative;
  z-index: 1;
  color: #8743FF;
  font-size: 17px;
  border-radius: 5px;
  margin: 0 5px;
  transition: all 0.3s ease;
}
.wrapper nav label:hover {
  background: linear-gradient(180deg, #8743FF 0%, #4136F1 100%);
  color: #ffffff;
}
#home:checked ~ nav label.home,
#blog:checked ~ nav label.blog,
#code:checked ~ nav label.code,
#help:checked ~ nav label.help,
#about:checked ~ nav label.about {
  color: #fff;
}
nav label i {
  padding-right: 7px;
}
nav .slider {
  position: absolute;
  height: 70%;
  width: 35%;
  top:8px;
  left: 0;
  bottom: 0;
  z-index: 0;
  border-radius: 5px;
  background: linear-gradient(180deg, #8743FF 0%, #4136F1 100%);
  transition: all 0.3s ease;
}
input[type="radio"] {
  display: none;
}
#blog:checked ~ nav .slider {
  left: 45%;
}
#code:checked ~ nav .slider {
  left: 90%;
}
section .content {
  display: none;
  background: #fff;
}
#home:checked ~ section .content-1,
#blog:checked ~ section .content-2,
#code:checked ~ section .content-3 {
  display: block;
}
section .content .title {
  font-size: 21px;
  font-weight: 500;
  margin: 30px 0 10px 0;
}
section .content p {
  text-align: justify;
}
</style>