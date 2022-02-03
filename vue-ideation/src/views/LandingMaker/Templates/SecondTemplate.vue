<template>
  <div>
    <!DOCTYPE html>
    <html lang="en">
      <circle-arrow-left
        class="sticky"
        @click.native="handleBack"
      ></circle-arrow-left>
      <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>complete responsive app landing page website design</title>
        <!-- font awesome cdn link  -->
        <link
          rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        />

        <!-- custom css file link  -->
        <link rel="stylesheet" href="style.css" />
      </head>
      <body>
        <!-- header section starts  -->

        <header>
          <a href="#" class="logo">LOGO</a>

          <div id="menu-bar" class="fas fa-bars"></div>

          <nav class="navbar">
            <a href="#home">home</a>
            <a href="#features">features</a>
            <a href="#about">about</a>
            <a href="#usage">usage</a>
            <a href="#review">review</a>
            <a href="#pricing">pricing</a>
          </nav>
        </header>

        <!-- header section ends -->

        <!-- home section starts  -->

        <section class="home" id="home">
          <div class="content">
            <h3>app landing page</h3>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima
              labore similique eos harum atque omnis ex consectetur, assumenda
              sunt ad facilis illum quaerat doloremque. Aut eveniet culpa enim
              suscipit ullam!
            </p>
            <a href="#" class="btn">get started</a>
          </div>

          <div class="swiper-container image-slider">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <img
                  src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-2/shot-01.jpg"
                  alt=""
                />
              </div>
              <div class="swiper-slide">
                <img
                  src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-2/shot-02.jpg"
                  alt=""
                />
              </div>
              <div class="swiper-slide">
                <img
                  src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-2/shot-03.jpg"
                  alt=""
                />
              </div>
              <div class="swiper-slide">
                <img
                  src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-2/shot-04.jpg"
                  alt=""
                />
              </div>
              <div class="swiper-slide">
                <img
                  src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-2/shot-05.jpg"
                  alt=""
                />
              </div>
            </div>
          </div>
        </section>

        <!-- home section ends -->

        <!-- features section starts  -->

        <section class="features" id="features">
          <h1 class="heading">app features</h1>

          <div class="box-container">
            <div class="box">
              <i class="fas fa-magic"></i>
              <h3>smooth design</h3>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque
                enim ad neque. Voluptatem alias beatae accusamus laudantium nisi
                assumenda libero.
              </p>
            </div>
            <div class="box">
              <i class="fas fa-shield-alt"></i>
              <h3>privacy protect</h3>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque
                enim ad neque. Voluptatem alias beatae accusamus laudantium nisi
                assumenda libero.
              </p>
            </div>
            <div class="box">
              <i class="fas fa-globe"></i>
              <h3>multiple language</h3>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque
                enim ad neque. Voluptatem alias beatae accusamus laudantium nisi
                assumenda libero.
              </p>
            </div>
            <div class="box">
              <i class="fas fa-map-marker-alt"></i>
              <h3>location tracking</h3>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque
                enim ad neque. Voluptatem alias beatae accusamus laudantium nisi
                assumenda libero.
              </p>
            </div>
            <div class="box">
              <i class="fas fa-cogs"></i>
              <h3>powerfull settings</h3>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque
                enim ad neque. Voluptatem alias beatae accusamus laudantium nisi
                assumenda libero.
              </p>
            </div>
            <div class="box">
              <i class="fas fa-headset"></i>
              <h3>24 x 7 service</h3>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque
                enim ad neque. Voluptatem alias beatae accusamus laudantium nisi
                assumenda libero.
              </p>
            </div>
          </div>
        </section>

        <!-- features section ends -->

        <!-- about section starts  -->

        <section class="about" id="about">
          <h1 class="heading">about the app</h1>

          <div class="row">
            <div class="image">
              <img
                src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-2/about-img.png"
                alt=""
              />
            </div>

            <div class="content">
              <h3>Take a Look Around our App</h3>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Voluptatibus labore perspiciatis iusto debitis, explicabo neque
                earum accusamus adipisci eius, nobis laboriosam, autem modi
                porro quisquam saepe assumenda fuga quod ipsa!
              </p>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit
                rerum excepturi alias quas voluptatibus provident voluptatum
                sapiente quos enim praesentium?
              </p>
              <div class="buttons">
                <a href="#"
                  ><img
                    src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-2/google-btn.png"
                    alt=""
                /></a>
                <a href="#"
                  ><img
                    src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-2/app-store-btn.png"
                    alt=""
                /></a>
              </div>
            </div>
          </div>
        </section>

        <!-- about section ends -->

        <!-- usage section starts  -->

        <section class="usage" id="usage">
          <h1 class="heading">how it works?</h1>

          <div class="row">
            <div class="box-container">
              <div class="box">
                <i class="fas fa-sort-amount-down"></i>
                <h3>minimum progress</h3>
                <p>
                  Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rem
                  dolor nihil dicta eveniet quam nam explicabo, natus labore
                  quia cupiditate.
                </p>
              </div>
              <div class="box">
                <i class="fas fa-user-clock"></i>
                <h3>active time</h3>
                <p>
                  Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rem
                  dolor nihil dicta eveniet quam nam explicabo, natus labore
                  quia cupiditate.
                </p>
              </div>
            </div>

            <img
              class="divider"
              src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-2/usage-img.png"
              alt=""
            />

            <div class="box-container">
              <div class="box">
                <i class="fas fa-sort-amount-up"></i>
                <h3>maximum progress</h3>
                <p>
                  Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rem
                  dolor nihil dicta eveniet quam nam explicabo, natus labore
                  quia cupiditate.
                </p>
              </div>
              <div class="box">
                <i class="fas fa-fire"></i>
                <h3>calories burned</h3>
                <p>
                  Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rem
                  dolor nihil dicta eveniet quam nam explicabo, natus labore
                  quia cupiditate.
                </p>
              </div>
            </div>
          </div>
        </section>

        <!-- usage section ends -->

        <!-- review section starts  -->

        <section class="review" id="review">
          <h1 class="heading">customers review</h1>

          <div class="box-container">
            <div class="box">
              <img
                src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-2/pic1.png"
                alt=""
              />
              <h3>john deo</h3>
              <p>
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rem
                fugit corporis consectetur reprehenderit officia earum,
                voluptate adipisci facere ea est!
              </p>
              <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
              </div>
            </div>
            <div class="box">
              <img
                src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-2/pic1.png"
                alt=""
              />
              <h3>john deo</h3>
              <p>
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rem
                fugit corporis consectetur reprehenderit officia earum,
                voluptate adipisci facere ea est!
              </p>
              <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
            </div>
            <div class="box">
              <img
                src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-2/pic3.png"
                alt=""
              />
              <h3>john deo</h3>
              <p>
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rem
                fugit corporis consectetur reprehenderit officia earum,
                voluptate adipisci facere ea est!
              </p>
              <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
              </div>
            </div>
          </div>
        </section>

        <!-- review section ends -->

        <!-- pricing section starts  -->

        <section class="pricing" id="pricing">
          <h1 class="heading">our pricing plans</h1>

          <div class="box-container">
            <div class="box">
              <div class="price"><span>$</span>10<span>/month</span></div>
              <h3>basic</h3>
              <ul>
                <li>100 MB Disk Space</li>
                <li>2 Subdomains</li>
                <li>5 Email Accounts</li>
                <li>email support</li>
              </ul>
              <a href="#" class="btn">select plan</a>
            </div>
            <div class="box">
              <div class="price"><span>$</span>20<span>/month</span></div>
              <h3>standard</h3>
              <ul>
                <li>100 MB Disk Space</li>
                <li>2 Subdomains</li>
                <li>5 Email Accounts</li>
                <li>email support</li>
              </ul>
              <a href="#" class="btn">select plan</a>
            </div>
            <div class="box">
              <div class="price"><span>$</span>50<span>/month</span></div>
              <h3>premium</h3>
              <ul>
                <li>100 MB Disk Space</li>
                <li>2 Subdomains</li>
                <li>5 Email Accounts</li>
                <li>email support</li>
              </ul>
              <a href="#" class="btn">select plan</a>
            </div>
          </div>
        </section>

        <!-- pricing section ends -->

        <!-- footer section starts  -->

        <section class="footer">
          <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
          </div>

          <h1 class="credit">
            created by <span> Startup Ideation System </span> | all rights
            reserved!
          </h1>
        </section>

        <!-- footer section ends -->
      </body>
    </html>
  </div>
</template>

<script>
import circleArrowLeft from "@/components/icons/circlearrowleft.vue";
import { mapGetters } from 'vuex';
export default {
  components: {
    circleArrowLeft,
  },
  methods: {
    handleBack() {
      this.$router.push({ name: "LandingChooseTemplates",params:{id:this.currentProjectID} });
    },
  },
  computed: {
    ...mapGetters(['currentProjectID'])
  },
};
</script>

<style lang="scss" scoped>
@import url("https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700&display=swap");

.sticky {
  position: fixed;
  top: 110px;
  z-index: 100;

  margin-left: 30px;
  cursor: pointer;
  ::v-deep svg {
    height: 30px;
    width: 30px;
  }
}

* {
  zoom: 93%;
  font-family: "Nunito", sans-serif;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  text-decoration: none;
  outline: none;
  border: none;
  text-transform: capitalize;
  transition: all 0.2s linear;
}

*::selection {
  background: #ed176f;
  color: #fff;
}

.swiper-wrapper {
  display: flex;
}

html {
  font-size: 62.5%;
  overflow-x: hidden;
  scroll-behavior: smooth;
  scroll-padding-top: 4rem;
}

section {
  padding: 3rem 9%;
}

.btn {
  display: inline-block;
  padding: 0.7rem 3rem;
  margin-top: 1rem;
  border-radius: 5rem;
  background: linear-gradient(90deg, #ed176f, #f7817f);
  color: #fff;
  cursor: pointer;
  font-size: 1.7rem;
}

.btn:hover {
  transform: scale(1.1);
}

.heading {
  text-align: center;
  color: #ed176f;
  font-size: 5rem;
  text-transform: uppercase;
  padding: 1rem;
}

header {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  background: #272d3b;
  z-index: 99;
  padding: 2rem 9%;
  border-bottom: 0.1rem solid #fff3;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

header .logo {
  font-weight: bolder;
  color: #fff;
  font-size: 2.5rem;
}

header .navbar a {
  font-size: 2rem;
  margin-left: 2.5rem;
  color: #fff;
}

header .navbar a:hover {
  color: #ed176f;
}

#menu-bar {
  font-size: 3rem;
  color: #fff;
  cursor: pointer;
  display: none;
}

.home {
  background: url(https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-2/home-bg.jpg)
    no-repeat;
  background-size: cover;
  background-position: center;
  min-height: 100vh;
  text-align: center;
}

.home .content {
  padding-top: 5rem;
  max-width: 70rem;
  margin: 0 auto;
}

.home .content h3 {
  font-size: 6.5rem;
  color: #fff;
}

.home .content p {
  font-size: 1.7rem;
  color: #eee;
  padding: 1rem 0;
}

.home .swiper-container {
  width: 100%;
  padding-top: 5rem;
  padding-bottom: 5rem;
}

.home .swiper-slide {
  width: 30rem;
  height: 50rem;
}

.home .swiper-slide img {
  display: block;
  width: 100%;
  height: 100%;
}

.features .box-container {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: wrap;
}

.features .box-container .box {
  margin: 1rem;
  border-radius: 0.5rem;
  text-align: center;
  background: rgba(237, 23, 111, 0.05);
  padding: 1rem;
  flex: 1 1 30rem;
  cursor: pointer;
}

.features .box-container .box i {
  color: #ed176f;
  font-size: 5rem;
  padding: 1rem;
}

.features .box-container .box h3 {
  color: #272d3b;
  font-size: 2.4rem;
}

.features .box-container .box p {
  color: #666;
  font-size: 1.5rem;
  padding: 1rem;
}

.features .box-container .box:hover {
  background: linear-gradient(90deg, #ed176f, #f7817f);
}

.features .box-container .box:hover > * {
  color: #fff;
}

.about .row {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: wrap;
}

.about .row .image {
  flex: 1 1 40rem;
}

.about .row .image img {
  width: 100%;
}

.about .row .content {
  flex: 1 1 40rem;
}

.about .row .content h3 {
  color: #272d3b;
  font-size: 3.5rem;
}

.about .row .content p {
  color: #666;
  font-size: 1.7rem;
  padding: 1rem 0;
}

.about .row .content .buttons {
  display: flex;
  flex-wrap: wrap;
}

.about .row .content .buttons a:hover {
  opacity: 0.7;
}

.about .row .content .buttons a:last-child {
  margin-left: 2rem;
}

.usage .row {
  display: flex;
  align-items: center;
}

.usage .row .divider {
  padding: 0 1rem;
}

.usage .row .box-container .box {
  padding: 1rem 0;
}

.usage .row .box-container .box i {
  color: #ed176f;
  padding: 1rem 0;
  font-size: 4.5rem;
}

.usage .row .box-container .box h3 {
  color: #272d3b;
  font-size: 2.5rem;
}

.usage .row .box-container .box p {
  color: #666;
  padding: 1rem 0;
  font-size: 1.5rem;
}

.usage .row .box-container:first-child {
  text-align: right;
}

.review .box-container {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: wrap;
}

.review .box-container .box {
  text-align: center;
  margin: 1rem;
  padding: 2rem;
  flex: 1 1 33rem;
  border: 0.1rem solid rgba(0, 0, 0, 0.3);
  box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
  border-radius: 0.5rem;
}

.review .box-container .box img {
  height: 13rem;
  width: 13rem;
  padding: 1rem;
  border-radius: 50%;
  object-fit: cover;
}

.review .box-container .box h3 {
  font-size: 2.5rem;
  color: #272d3b;
}

.review .box-container .box p {
  font-size: 1.4rem;
  color: #666;
  padding: 1rem 0;
}

.review .box-container .box .stars i {
  padding: 1rem 0.1rem;
  font-size: 2rem;
  color: #ed176f;
}

.pricing .box-container {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: wrap;
}

.pricing .box-container .box {
  flex: 1 1 33rem;
  text-align: center;
  margin: 1rem;
  padding: 2rem 0;
  box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
  border: 0.1rem solid rgba(0, 0, 0, 0.3);
}

.pricing .box-container .box .price {
  font-size: 5rem;
  color: #272d3b;
  font-weight: bolder;
}

.pricing .box-container .box .price span {
  font-size: 2rem;
  font-weight: normal;
}

.pricing .box-container .box h3 {
  color: #fff;
  background: linear-gradient(90deg, #ed176f, #f7817f);
  font-size: 3rem;
  padding: 1.5rem 0;
  margin: 1rem 0;
}

.pricing .box-container .box ul {
  list-style: none;
  padding: 2rem 0;
  border-bottom: 0.1rem solid #ed176f;
}

.pricing .box-container .box ul li {
  padding: 0.7rem 0;
  font-size: 1.7rem;
  color: #666;
}

.pricing .box-container .box .btn {
  margin-top: 2rem;
}

.contact {
  background: linear-gradient(#fff 50%, #272d3b 50.1%);
}

.contact form {
  padding: 2rem;
  background: #fff;
  box-shadow: 0 0.5rem 3rem rgba(0, 0, 0, 0.1);
}

.contact form .inputBox {
  position: relative;
}

.contact form .inputBox input,
.contact form .inputBox textarea {
  width: 100%;
  margin: 1.5rem 0;
  padding: 1rem 0;
  border-bottom: 0.2rem solid rgba(0, 0, 0, 0.3);
  font-size: 1.7rem;
  text-transform: none;
}

.contact form .inputBox textarea {
  resize: none;
  height: 15rem;
}

.contact form .inputBox input:focus,
.contact form .inputBox textarea:focus {
  border-color: #ed176f;
}

.contact form .inputBox label {
  font-size: 1.7rem;
  position: absolute;
  top: 2.3rem;
  left: 0;
}

.contact form .inputBox input:focus ~ label,
.contact form .inputBox textarea:focus ~ label,
.contact form .inputBox input:valid ~ label,
.contact form .inputBox textarea:valid ~ label {
  top: -0.4rem;
  font-size: 1.5rem;
  color: #ed176f;
}

.footer {
  text-align: center;
  background: #272d3b;
}

.footer .share a {
  height: 4.5rem;
  width: 4.5rem;
  line-height: 4.5rem;
  background: #eee;
  color: #272d3b;
  border-radius: 50%;
  font-size: 2rem;
  margin: 0.3rem;
}

.footer .share a:hover {
  color: #fff;
  background: linear-gradient(90deg, #ed176f, #f7817f);
}

.footer .credit {
  color: #eee;
  padding: 2.5rem 1rem;
  font-weight: normal;
  font-size: 2rem;
}

.footer .credit span {
  color: #ed176f;
}

/* media queries */

@media (max-width: 991px) {
  html {
    font-size: 55%;
  }

  header {
    padding: 2rem 4%;
  }

  section {
    padding: 3rem 4%;
  }

  .usage .row {
    flex-flow: column;
  }

  .usage .row .divider {
    display: none;
  }

  .usage .row .box-container .box {
    text-align: center;
  }
}

@media (max-width: 768px) {
  #menu-bar {
    display: block;
  }

  header .navbar {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: #272d3b;
    border-top: 0.1rem solid #fff3;
    padding: 1rem 2rem;
    clip-path: polygon(0 0, 100% 0, 100% 0, 0 0);
  }

  header .navbar.nav-toggle {
    clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
  }

  header .navbar a {
    display: block;
    margin: 1.5rem 0;
    padding: 1rem;
    background: linear-gradient(90deg, #ed176f, #f7817f);
    text-align: center;
    border-radius: 0.5rem;
  }

  header .navbar a:hover {
    color: #272d3b;
  }

  .fa-times {
    transform: rotate(180deg);
  }

  .home .content h3 {
    font-size: 4rem;
  }

  .home .content p {
    font-size: 1.5rem;
  }

  .about .row .content {
    text-align: center;
  }

  .about .row .content .buttons a {
    width: 100%;
  }

  .about .row .content .buttons a:last-child {
    margin: 1rem 0;
  }
}

@media (max-width: 400px) {
  html {
    font-size: 50%;
  }

  .heading {
    font-size: 3.5rem;
  }
}
</style>