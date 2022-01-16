<template>
  <div id="templateContainer">
    <!-- <font-awesome-icon icon="fa-solid fa-circle-arrow-left"  /> -->
    <circle-arrow-left
      class="sticky"
      @click.native="handleBack"
    ></circle-arrow-left>
    <head>
      <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      />
    </head>
    <header>
      <a href="#" class="logo"><span>best</span>App</a>

      <input type="checkbox" id="menu-bar" />
      <label for="menu-bar" class="fas fa-bars"></label>

      <nav class="navbar">
        <a href="#home">home</a>
        <a href="#features">features</a>
        <a href="#about">about</a>
        <a href="#review">review</a>
        <a href="#pricing">pricing</a>
      </nav>
    </header>

    <!-- header section ends -->

    <!-- home section starts  -->

    <section class="home" id="home">
      <div class="content">
        <h3>best mobile app <span>showcase</span></h3>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus
          suscipit porro nam libero natus error consequatur sed repudiandae eos
          quo?
        </p>
        <a href="#pricing" class="btn">download now</a>
      </div>

      <div class="image">
        <img
          src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-1/home-img.png"
          alt=""
        />
      </div>
    </section>

    <!-- home section ends -->

    <!-- features section starts  -->

    <section class="features" id="features">
      <h1 class="heading">app features</h1>

      <div class="box-container">
        <div class="box">
          <img
            src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-1/f-icon1.png"
            alt=""
          />
          <h3>amazing UI design</h3>
          <p>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ullam
            minus recusandae autem, repellendus fugit quaerat provident
            voluptatum non officiis ratione.
          </p>
          <a href="#" class="btn">read more</a>
        </div>

        <div class="box">
          <img
            src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-1/f-icon2.png"
            alt=""
          />
          <h3>soft and smooth animations</h3>
          <p>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ullam
            minus recusandae autem, repellendus fugit quaerat provident
            voluptatum non officiis ratione.
          </p>
          <a href="#" class="btn">read more</a>
        </div>

        <div class="box">
          <img
            src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-1/f-icon3.png"
            alt=""
          />
          <h3>freindly interactions</h3>
          <p>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ullam
            minus recusandae autem, repellendus fugit quaerat provident
            voluptatum non officiis ratione.
          </p>
          <a href="#" class="btn">read more</a>
        </div>
      </div>
    </section>

    <!-- features section ends -->

    <!-- about section starts  -->

    <section class="about" id="about">
      <h1 class="heading">about the app</h1>

      <div class="column">
        <div class="image">
          <img
            src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-1/about-img.png"
            alt=""
          />
        </div>

        <div class="content">
          <h3>Easy And Perfect Solution For Your Business App</h3>
          <p>
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nulla
            placeat deserunt saepe repudiandae veniam soluta minima dolor hic
            aperiam iure.
          </p>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
            Laudantium, quaerat. Dolorem ratione saepe magni quo inventore porro
            ab voluptates eos, nam eius provident accusantium, quia similique
            est, repellendus et reiciendis.
          </p>
          <div class="buttons">
            <a href="#pricing" class="btn">
              <i class="fab fa-apple"></i> app store
            </a>
            <a href="#pricing" class="btn">
              <i class="fab fa-google-play"></i> google-play
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- about section ends -->

    <!-- newsletter  -->

    <div class="newsletter">
      <h3>Subscribe For New Features</h3>
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus sed
        aliquam quibusdam neque magni magnam est laborum doloribus, facere
        dolores.
      </p>
    </div>

    <!-- review section starts  -->

    <section class="review" id="review">
      <h1 class="heading">people's review</h1>

      <div class="box-container">
        <div class="box">
          <i class="fas fa-quote-right"></i>
          <div class="user">
            <img
              src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-1/pic1.png"
              alt=""
            />
            <h3>john deo</h3>
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <div class="comment">
              Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus
              et, perspiciatis nisi tempore aspernatur accusantium sed
              distinctio facilis aperiam laborum autem earum repellat, commodi
              eum. Ullam cupiditate expedita officiis obcaecati?
            </div>
          </div>
        </div>

        <div class="box">
          <i class="fas fa-quote-right"></i>
          <div class="user">
            <img
              src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-1/pic2.png"
              alt=""
            />
            <h3>john deo</h3>
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
            </div>
            <div class="comment">
              Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus
              et, perspiciatis nisi tempore aspernatur accusantium sed
              distinctio facilis aperiam laborum autem earum repellat, commodi
              eum. Ullam cupiditate expedita officiis obcaecati?
            </div>
          </div>
        </div>

        <div class="box">
          <i class="fas fa-quote-right"></i>
          <div class="user">
            <img
              src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-1/pic3.png"
              alt=""
            />
            <h3>john deo</h3>
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="far fa-star"></i>
            </div>
            <div class="comment">
              Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus
              et, perspiciatis nisi tempore aspernatur accusantium sed
              distinctio facilis aperiam laborum autem earum repellat, commodi
              eum. Ullam cupiditate expedita officiis obcaecati?
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- review section ends -->

    <!-- pricing section starts  -->

    <section class="pricing" id="pricing">
      <h1 class="heading">Our Pricing Plans</h1>

      <div class="box-container">
        <div class="box">
          <h3 class="title">basic</h3>
          <div class="price">$10<span>/monthly</span></div>
          <ul>
            <li><i class="fas fa-check"></i> 1000+ downloads</li>
            <li><i class="fas fa-check"></i> No transaction fees</li>
            <li><i class="fas fa-times"></i> unlimited storage</li>
            <li><i class="fas fa-times"></i> 5 downloads</li>
          </ul>
          <a href="#" class="btn">check out</a>
        </div>

        <div class="box">
          <h3 class="title">standard</h3>
          <div class="price">$15<span>/monthly</span></div>
          <ul>
            <li><i class="fas fa-check"></i> 1000+ downloads</li>
            <li><i class="fas fa-check"></i> No transaction fees</li>
            <li><i class="fas fa-check"></i> unlimited storage</li>
            <li><i class="fas fa-times"></i> 5 downloads</li>
          </ul>
          <a href="#" class="btn">check out</a>
        </div>

        <div class="box">
          <h3 class="title">premium</h3>
          <div class="price">$25<span>/monthly</span></div>
          <ul>
            <li><i class="fas fa-check"></i> 1000+ downloads</li>
            <li><i class="fas fa-check"></i> No transaction fees</li>
            <li><i class="fas fa-check"></i> unlimited storage</li>
            <li><i class="fas fa-check"></i> 5 downloads</li>
          </ul>
          <a href="#" class="btn">check out</a>
        </div>
      </div>
    </section>

    <div>
      <transition name="fade" appear>
        <div
          class="modal-overlay"
          v-if="showModal"
          @click="showModal = false"
        ></div>
      </transition>
    </div>

    <!-- pricing section ends -->

    <!-- footer section starts  -->

    <div class="footer">
      <div class="box-container">
        <div class="box">
          <h3>about us</h3>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet
            pariatur rerum consectetur architecto ad tempora blanditiis quo
            aliquid inventore a.
          </p>
        </div>

        <div class="box">
          <h3>quick links</h3>
          <a href="#">home</a>
          <a href="#">features</a>
          <a href="#">about</a>
          <a href="#">review</a>
          <a href="#">pricing</a>
        </div>

        <div class="box">
          <h3>follow us</h3>
          <a href="#">facebook</a>
          <a href="#">instagram</a>
          <a href="#">pinterest</a>
          <a href="#">twitter</a>
        </div>

        <div class="box">
          <h3>contact info</h3>
          <div class="info">
            <i class="fas fa-phone"></i>
            <p>+60-195153880 <br /></p>
          </div>
          <div class="info">
            <i class="fas fa-envelope"></i>
            <p>
              example@gmail.com <br />
              example@gmail.com
            </p>
          </div>
          <div class="info">
            <i class="fas fa-map-marker-alt"></i>
            <p>Kuala Lumpur Malaysia</p>
          </div>
        </div>
      </div>

      <h1 class="credit">&copy; copyright @ 2021 by Startup Ideation System</h1>
    </div>
  </div>
</template>

<script>
import circleArrowLeft from "@/components/icons/circlearrowleft.vue";
export default {
  components: {
    circleArrowLeft,
  },
  methods: {
    handleBack() {
      this.$router.push({ name: "LandingChooseTemplates" });
    },

    handlePricing() {},
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
  top: 10;
  z-index: 100;
  height: 50px;
  width: 50px;
  margin-left: 15px;
  cursor: pointer;
}

* {
  zoom: 94%;
  font-family: "Poppins", sans-serif;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  text-decoration: none;
  outline: none;
  border: none;
  text-transform: capitalize;
}

*::selection {
  background: #f83292;
  color: #fff;
}
section {
  min-height: 100vh;
  padding: 0 9%;
  padding-top: 7.5rem;
  padding-bottom: 2rem;
}

.btn {
  display: inline-block;
  margin-top: 1rem;
  padding: 0.8rem 3rem;
  border-radius: 5rem;
  background: linear-gradient(90deg, #814096, #f83292);
  font-size: 1.7rem;
  color: #fff;
  cursor: pointer;
  box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
  transition: all 0.3s linear;
}

.btn:hover {
  transform: scale(1.1);
}

.heading {
  text-align: center;
  color: #814096;
  font-size: 3.5rem;
  text-transform: uppercase;
  padding: 1rem;
}

header {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  background: #fff;
  box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
  padding: 2rem 9%;
  display: flex;
  align-items: center;
  justify-content: space-between;
  z-index: 99;
}

header .logo {
  font-size: 2rem;
  color: #814096;
}

header .logo span {
  color: #f83292;
}

header .navbar a {
  font-size: 1.7rem;
  margin-left: 2rem;
  color: #814096;
}

header .navbar a:hover {
  color: #f83292;
}

header input {
  display: none;
}

header label {
  font-size: 3rem;
  color: #814096;
  cursor: pointer;
  visibility: hidden;
  opacity: 0;
}

.home {
  display: flex;
  align-items: center;
  justify-content: center;
  background: url(https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-1/home-bg-img.png)
    no-repeat;
  background-size: cover;
  background-position: center;
}

.home .image img {
  width: 40vw;
  animation: float 3s linear infinite;
}

@keyframes float {
  0%,
  100% {
    transform: translateY(0rem);
  }
  50% {
    transform: translateY(-3.5rem);
  }
}

.home .content h3 {
  font-size: 5.5rem;
  color: #333;
  text-transform: uppercase;
}

.home .content h3 span {
  color: #f83292;
  text-transform: uppercase;
}

.home .content p {
  font-size: 1.7rem;
  color: #666;
  padding: 1rem 0;
}

.features .box-container {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: wrap;
}

.features .box-container .box {
  flex: 1 1 30rem;
  background: #fff;
  border-radius: 0.5rem;
  border: 0.1rem solid rgba(0, 0, 0, 0.2);
  box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
  margin: 1.5rem;
  padding: 3rem 2rem;
  border-radius: 0.5rem;
  text-align: center;
  transition: 0.2s linear;
}

.features .box-container .box img {
  height: 15rem;
}

.features .box-container .box h3 {
  font-size: 2rem;
  color: #333;
  padding-top: 1rem;
}

.features .box-container .box p {
  font-size: 1.3rem;
  color: #666;
  padding: 1rem 0;
}

.about {
  background: url(https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-1/about-bg.png)
    no-repeat;
  background-size: cover;
  background-position: center;
  padding-bottom: 3rem;
}

.about .column {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: wrap;
}

.about .column .image {
  flex: 1 1 40rem;
}

.about .column .image img {
  width: 100%;
}

.about .column .content {
  flex: 1 1 40rem;
}

.about .column .content h3 {
  font-size: 3rem;
  color: #666;
}

.about .column .content p {
  font-size: 1.5rem;
  color: #666;
  padding: 1rem 0;
}

.about .column .content .buttons a:last-child {
  margin-left: 2rem;
}

.newsletter {
  text-align: center;
  padding: 5rem 1rem;
  background: url(https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-1/subscribe-bg.png)
    no-repeat;
  background-size: cover;
  background-position: center;
}

.newsletter h3 {
  color: #fff;
  font-size: 3rem;
  text-transform: uppercase;
}

.newsletter p {
  color: #fff;
  font-size: 1.6rem;
  margin: 2rem auto;
  width: 70rem;
}

.newsletter form {
  display: flex;
  max-width: 70rem;
  border: 0.2rem solid #fff;
  padding: 0.5rem;
  border-radius: 5rem;
  margin: 2rem auto;
  height: 5.5rem;
}

.newsletter form input[type="email"] {
  padding: 0 2rem;
  font-size: 1.7rem;
  background: none;
  width: 100%;
  color: #fff;
  text-transform: none;
  background: none;
}

.newsletter form input[type="email"]::placeholder {
  color: #eee;
  text-transform: capitalize;
}

.newsletter form input[type="submit"] {
  background: #fff;
  width: 20rem;
  font-size: 1.7rem;
  border-radius: 5rem;
  cursor: pointer;
}

.newsletter form input[type="submit"]:hover {
  color: #f83292;
}

.review .box-container {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: wrap;
}

.review .box-container .box {
  background: #fff;
  margin: 1rem;
  padding: 1rem;
  text-align: center;
  position: relative;
  border: 0.1rem solid rgba(0, 0, 0, 0.2);
  box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
  flex: 1 1 30rem;
  border-radius: 0.5rem;
}

.review .box-container .box .fa-quote-right {
  position: absolute;
  top: 1rem;
  right: 2rem;
  font-size: 8rem;
  color: #f83292;
  opacity: 0.3;
}

.review .box-container .box .user img {
  border-radius: 50%;
  object-fit: cover;
  height: 7rem;
  width: 7rem;
  margin-top: 2rem;
}

.review .box-container .box .user h3 {
  color: #f83292;
  font-size: 2rem;
}

.review .box-container .box .user .stars i {
  color: #814096;
  font-size: 1.5rem;
  padding: 1rem 0;
}

.review .box-container .box .comment {
  color: #666;
  font-size: 1.4rem;
  padding: 1rem;
}

.pricing .box-container {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: wrap;
}

.pricing .box-container .box {
  flex: 1 1 27rem;
  margin: 1rem;
  padding: 1rem;
  background: #fff;
  border: 0.1rem solid rgba(0, 0, 0, 0.2);
  box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
  border-radius: 0.5rem;
  text-align: center;
  padding-bottom: 3rem;
}

.pricing .box-container .box:nth-child(2),
.pricing .box-container .box:hover {
  border: 0.2rem solid #f83292;
}

.pricing .box-container .box .title {
  color: #814096;
  font-size: 2.5rem;
  padding-top: 1rem;
}

.pricing .box-container .box .price {
  font-size: 4rem;
  color: #f83292;
  padding: 1rem 0;
}

.pricing .box-container .box .price span {
  font-size: 2rem;
}

.pricing .box-container .box ul {
  padding: 1rem 0;
  list-style: none;
}

.pricing .box-container .box ul li {
  font-size: 1.7rem;
  color: #666;
  padding: 0.5rem 0;
}

.pricing .box-container .box ul li .fa-check {
  color: lightgreen;
}

.pricing .box-container .box ul li .fa-times {
  color: tomato;
}

.contact {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: wrap;
  padding-bottom: 4rem;
}

.contact .image {
  flex: 1 1 40rem;
}

.contact .image img {
  width: 100%;
  padding: 2rem;
}

.contact form {
  flex: 1 1 40rem;
  padding: 2rem 3rem;
  border: 0.1rem solid rgba(0, 0, 0, 0.2);
  box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
  border-radius: 0.5rem;
  background: #fff;
}

.contact form .heading {
  text-align: left;
  padding: 0;
  padding-bottom: 2rem;
}

.contact form .inputBox {
  position: relative;
}

.contact form .inputBox input,
.contact form .inputBox textarea {
  width: 100%;
  background: none;
  color: #666;
  margin: 1.5rem 0;
  padding: 0.5rem 0;
  font-size: 1.7rem;
  border-bottom: 0.1rem solid rgba(0, 0, 0, 0.1);
  text-transform: none;
}

.contact form .inputBox textarea {
  resize: none;
  height: 13rem;
}

.contact form .inputBox label {
  position: absolute;
  top: 1.7rem;
  left: 0;
  font-size: 1.7rem;
  color: #666;
  transition: 0.2s linear;
}

.contact form .inputBox input:focus ~ label,
.contact form .inputBox input:valid ~ label,
.contact form .inputBox textarea:focus ~ label,
.contact form .inputBox textarea:valid ~ label {
  top: -0.5rem;
  font-size: 1.5rem;
  color: #f83292;
}

.footer {
  padding-top: 3rem;
  background: url(https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-1/footer-bg.png)
    no-repeat;
  background-size: cover;
  background-position: center;
}

.footer .box-container {
  display: flex;
  flex-wrap: wrap;
}

.footer .box-container .box {
  flex: 1 1 25rem;
  margin: 2rem;
}

.footer .box-container .box h3 {
  font-size: 2.5rem;
  padding: 1rem 0;
  color: #fff;
  text-decoration: underline;
  text-underline-offset: 1rem;
}

.footer .box-container .box p {
  font-size: 1.5rem;
  padding: 0.5rem 0;
  color: #eee;
}

.footer .box-container .box a {
  display: block;
  font-size: 1.5rem;
  padding: 0.5rem 0;
  color: #eee;
}

.footer .box-container .box a:hover {
  text-decoration: underline;
}

.footer .box-container .box .info {
  display: flex;
  align-items: center;
}

.footer .box-container .box .info i {
  margin: 0.5rem 0;
  margin-right: 1rem;
  border-radius: 50%;
  background: #fff;
  color: #f83292;
  font-size: 1.5rem;
  height: 4.5rem;
  width: 4.5rem;
  line-height: 4.5rem;
  text-align: center;
}

.footer .credit {
  font-size: 2rem;
  font-weight: normal;
  letter-spacing: 0.1rem;
  color: #fff;
  border-top: 0.1rem solid #fff5;
  padding: 2.5rem 1rem;
  text-align: center;
}

/* media queries  */

@media (max-width: 1200px) {
  html {
    font-size: 55%;
  }
}

@media (max-width: 991px) {
  section {
    padding: 0 3%;
    padding-top: 7.5rem;
    padding-bottom: 2rem;
  }
}

@media (max-width: 768px) {
  header label {
    visibility: visible;
    opacity: 1;
  }

  header .navbar {
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    background: #fff;
    padding: 1rem 2rem;
    border-top: 0.1rem solid rgba(0, 0, 0, 0.2);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
    transform-origin: top;
    transform: scaleY(0);
    opacity: 0;
    transition: 0.2s linear;
  }

  header .navbar a {
    display: block;
    margin: 2rem 0;
    font-size: 2rem;
  }

  header input:checked ~ .navbar {
    transform: scaleY(1);
    opacity: 1;
  }

  header input:checked ~ label::before {
    content: "\f00d";
  }

  .home {
    flex-flow: column-reverse;
  }

  .home .image img {
    width: 100%;
  }

  .home .content h3 {
    font-size: 3.6rem;
  }

  .home .content p {
    font-size: 1.5rem;
  }

  .about {
    background-position: right;
  }

  .newsletter p {
    width: auto;
  }
}

@media (max-width: 450px) {
  html {
    font-size: 50%;
  }

  .about .column .content .buttons a {
    width: 100%;
    text-align: center;
  }

  .about .column .content .buttons a:last-child {
    margin: 1rem 0;
  }
}
</style>