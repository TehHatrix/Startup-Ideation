<template>
  <div>
    <div class="header"><h3>Choose Your Templates</h3></div>
    <div class="templates">
      <div class="firstTemp">
        <h2>Starter Template</h2>
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
        <h2>Pro Template</h2>
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
  data() {
    return {
      currentProjectID: 0,
      ideationHTML: ` <head> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" /> </head> <header> <a href="#" class="logo"><span>best</span>App</a> <input type="checkbox" id="menu-bar" /> <label for="menu-bar" class="fas fa-bars"></label> <nav class="navbar"> <a href="#home">home</a> <a href="#features">features</a> <a href="#about">about</a> <a href="#review">review</a> <a href="#pricing">pricing</a> </nav> </header> <section class="home" id="home"> <div class="content"> <h3>BEST MOBILE APP<span> SHOWCASE</span></h3> <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus suscipit porro nam libero natus error consequatur sed repudiandae eos quo? </p> <a href="#pricing" class="btn">Download Now</a> </div> <div class="image"> <img src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-1/home-img.png" alt="" /> </div> </section> <section class="features" id="features"> <h1 class="heading">APP FEATURES</h1> <div class="box-container"> <div class="box"> <img src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-1/f-icon1.png" alt="" /> <h3>Amazing UI design</h3> <p> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ullam minus recusandae autem, repellendus fugit quaerat provident voluptatum non officiis ratione. </p> <a href="#" class="btn">Read more</a> </div> <div class="box"> <img src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-1/f-icon2.png" alt="" /> <h3>Soft and smooth animations</h3> <p> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ullam minus recusandae autem, repellendus fugit quaerat provident voluptatum non officiis ratione. </p> <a href="#" class="btn">Read more</a> </div> <div class="box"> <img src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-1/f-icon3.png" alt="" /> <h3>friendly interactions</h3> <p> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ullam minus recusandae autem, repellendus fugit quaerat provident voluptatum non officiis ratione. </p> <a href="#" class="btn">Read more</a> </div> </div> </section> <section class="about" id="about"> <h1 class="heading">ABOUT THE APP</h1> <div class="column"> <div class="image"> <img src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-1/about-img.png" alt="" /> </div> <div class="content"> <h3>Easy And Perfect Solution For Your Business App</h3> <p> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nulla placeat deserunt saepe repudiandae veniam soluta minima dolor hic aperiam iure. </p> <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium, quaerat. Dolorem ratione saepe magni quo inventore porro ab voluptates eos, nam eius provident accusantium, quia similique est, repellendus et reiciendis. </p> <div class="buttons"> <a href="#pricing" class="btn"> <i class="fab fa-apple"></i> app store </a> <a href="#pricing" class="btn"> <i class="fab fa-google-play"></i> google-play </a> </div> </div> </div> </section> <div class="newsletter"> <h3>Subscribe For New Features</h3> <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus sed aliquam quibusdam neque magni magnam est laborum doloribus, facere dolores. </p> </div> <section class="review" id="review"> <h1 class="heading">PEOPLE'S REVIEW</h1> <div class="box-container"> <div class="box"> <i class="fas fa-quote-right"></i> <div class="user"> <img src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-1/pic1.png" alt="" /> <h3>John Doe</h3> <div class="stars"> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> </div> <div class="comment"> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus et, perspiciatis nisi tempore aspernatur accusantium sed distinctio facilis aperiam laborum autem earum repellat, commodi eum. Ullam cupiditate expedita officiis obcaecati? </div> </div> </div> <div class="box"> <i class="fas fa-quote-right"></i> <div class="user"> <img src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-1/pic2.png" alt="" /> <h3>John Doe</h3> <div class="stars"> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star-half-alt"></i> </div> <div class="comment"> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus et, perspiciatis nisi tempore aspernatur accusantium sed distinctio facilis aperiam laborum autem earum repellat, commodi eum. Ullam cupiditate expedita officiis obcaecati? </div> </div> </div> <div class="box"> <i class="fas fa-quote-right"></i> <div class="user"> <img src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-1/pic3.png" alt="" /> <h3>John Doe</h3> <div class="stars"> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="far fa-star"></i> </div> <div class="comment"> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus et, perspiciatis nisi tempore aspernatur accusantium sed distinctio facilis aperiam laborum autem earum repellat, commodi eum. Ullam cupiditate expedita officiis obcaecati? </div> </div> </div> </div> </section> `,
      ideationCSS: `html { font-size: 62.5%; overflow-x: hidden; } .sticky{ position: fixed; top: 10; z-index: 100; height: 50px; width: 50px; margin-left: 15px; cursor: pointer; } * { font-family: "Poppins", sans-serif; margin: 0; padding: 0; box-sizing: border-box; text-decoration: none; outline: none; border: none; } *::selection { background: #f83292; color: #fff; } section { min-height: 100vh; padding: 0 9%; padding-top: 7.5rem; padding-bottom: 2rem; } .btn { display: inline-block; margin-top: 1rem; padding: 0.8rem 3rem; border-radius: 5rem; background: linear-gradient(90deg, #814096, #f83292); font-size: 1.7rem; color: #fff; cursor: pointer; box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1); transition: all 0.3s linear; } .btn:hover { transform: scale(1.1); } .heading { text-align: center; color: #814096; font-size: 3.5rem; padding: 1rem; } header { position: fixed; top: 0; left: 0; width: 100%; background: #fff; box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1); padding: 2rem 9%; display: flex; align-items: center; justify-content: space-between; z-index: 99; } header .logo { font-size: 2rem; color: #814096; } header .logo span { color: #f83292; } header .navbar a { font-size: 1.7rem; margin-left: 2rem; color: #814096; } header .navbar a:hover { color: #f83292; } header input { display: none; } header label { font-size: 3rem; color: #814096; cursor: pointer; visibility: hidden; opacity: 0; } .home { display: flex; align-items: center; justify-content: center; background: url(https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-1/home-bg-img.png) no-repeat; background-size: cover; background-position: center; } .home .image img { width: 40vw; animation: float 3s linear infinite; } @keyframes float { 0%, 100% { transform: translateY(0rem); } 50% { transform: translateY(-3.5rem); } } .home .content h3 { font-size: 5.5rem; color: #333;} .home .content h3 span { color: #f83292; } .home .content p { font-size: 1.7rem; color: #666; padding: 1rem 0; } .features .box-container { display: flex; align-items: center; justify-content: center; flex-wrap: wrap; } .features .box-container .box { flex: 1 1 30rem; background: #fff; border-radius: 0.5rem; border: 0.1rem solid rgba(0, 0, 0, 0.2); box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1); margin: 1.5rem; padding: 3rem 2rem; border-radius: 0.5rem; text-align: center; transition: 0.2s linear; } .features .box-container .box img { height: 15rem; } .features .box-container .box h3 { font-size: 2rem; color: #333; padding-top: 1rem; } .features .box-container .box p { font-size: 1.3rem; color: #666; padding: 1rem 0; } .about { background: url(https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-1/about-bg.png) no-repeat; background-size: cover; background-position: center; padding-bottom: 3rem; } .about .column { display: flex; align-items: center; justify-content: center; flex-wrap: wrap; } .about .column .image { flex: 1 1 40rem; } .about .column .image img { width: 100%; } .about .column .content { flex: 1 1 40rem; } .about .column .content h3 { font-size: 3rem; color: #666; } .about .column .content p { font-size: 1.5rem; color: #666; padding: 1rem 0; } .about .column .content .buttons a:last-child { margin-left: 2rem; } .newsletter { text-align: center; padding: 5rem 1rem; background: url(https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-1/subscribe-bg.png) no-repeat; background-size: cover; background-position: center; } .newsletter h3 { color: #fff; font-size: 3rem; } .newsletter p { color: #fff; font-size: 1.6rem; margin: 2rem auto; width: 70rem; } .newsletter form { display: flex; max-width: 70rem; border: 0.2rem solid #fff; padding: 0.5rem; border-radius: 5rem; margin: 2rem auto; height: 5.5rem; } .newsletter form input[type="email"] { padding: 0 2rem; font-size: 1.7rem; background: none; width: 100%; color: #fff; text-transform: none; background: none; } .newsletter form input[type="email"]::placeholder { color: #eee;} .newsletter form input[type="submit"] { background: #fff; width: 20rem; font-size: 1.7rem; border-radius: 5rem; cursor: pointer; } .newsletter form input[type="submit"]:hover { color: #f83292; } .review .box-container { display: flex; align-items: center; justify-content: center; flex-wrap: wrap; } .review .box-container .box { background: #fff; margin: 1rem; padding: 1rem; text-align: center; position: relative; border: 0.1rem solid rgba(0, 0, 0, 0.2); box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1); flex: 1 1 30rem; border-radius: 0.5rem; } .review .box-container .box .fa-quote-right { position: absolute; top: 1rem; right: 2rem; font-size: 8rem; color: #f83292; opacity: 0.3; } .review .box-container .box .user img { border-radius: 50%; object-fit: cover; height: 7rem; width: 7rem; margin-top: 2rem; } .review .box-container .box .user h3 { color: #f83292; font-size: 2rem; } .review .box-container .box .user .stars i { color: #814096; font-size: 1.5rem; padding: 1rem 0; } .review .box-container .box .comment { color: #666; font-size: 1.4rem; padding: 1rem; } .pricing .box-container { display: flex; align-items: center; justify-content: center; flex-wrap: wrap; } .pricing .box-container .box { flex: 1 1 27rem; margin: 1rem; padding: 1rem; background: #fff; border: 0.1rem solid rgba(0, 0, 0, 0.2); box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1); border-radius: 0.5rem; text-align: center; padding-bottom: 3rem; } .pricing .box-container .box:nth-child(2), .pricing .box-container .box:hover { border: 0.2rem solid #f83292; } .pricing .box-container .box .title { color: #814096; font-size: 2.5rem; padding-top: 1rem; } .pricing .box-container .box .price { font-size: 4rem; color: #f83292; padding: 1rem 0; } .pricing .box-container .box .price span { font-size: 2rem; } .pricing .box-container .box ul { padding: 1rem 0; list-style: none; } .pricing .box-container .box ul li { font-size: 1.7rem; color: #666; padding: 0.5rem 0; } .pricing .box-container .box ul li .fa-check { color: lightgreen; } .pricing .box-container .box ul li .fa-times { color: tomato; } .contact { display: flex; align-items: center; justify-content: center; flex-wrap: wrap; padding-bottom: 4rem; } .contact .image { flex: 1 1 40rem; } .contact .image img { width: 100%; padding: 2rem; } .contact form { flex: 1 1 40rem; padding: 2rem 3rem; border: 0.1rem solid rgba(0, 0, 0, 0.2); box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1); border-radius: 0.5rem; background: #fff; } .contact form .heading { text-align: left; padding: 0; padding-bottom: 2rem; } .contact form .inputBox { position: relative; } .contact form .inputBox input, .contact form .inputBox textarea { width: 100%; background: none; color: #666; margin: 1.5rem 0; padding: 0.5rem 0; font-size: 1.7rem; border-bottom: 0.1rem solid rgba(0, 0, 0, 0.1); text-transform: none; } .contact form .inputBox textarea { resize: none; height: 13rem; } .contact form .inputBox label { position: absolute; top: 1.7rem; left: 0; font-size: 1.7rem; color: #666; transition: 0.2s linear; } .contact form .inputBox input:focus ~ label, .contact form .inputBox input:valid ~ label, .contact form .inputBox textarea:focus ~ label, .contact form .inputBox textarea:valid ~ label { top: -0.5rem; font-size: 1.5rem; color: #f83292; } .footer { padding-top: 3rem; background: url(https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-1/footer-bg.png) no-repeat; background-size: cover; background-position: center; } .footer .box-container { display: flex; flex-wrap: wrap; } .footer .box-container .box { flex: 1 1 25rem; margin: 2rem; } .footer .box-container .box h3 { font-size: 2.5rem; padding: 1rem 0; color: #fff; text-decoration: underline; text-underline-offset: 1rem; } .footer .box-container .box p { font-size: 1.5rem; padding: 0.5rem 0; color: #eee; } .footer .box-container .box a { display: block; font-size: 1.5rem; padding: 0.5rem 0; color: #eee; } .footer .box-container .box a:hover { text-decoration: underline; } .footer .box-container .box .info { display: flex; align-items: center; } .footer .box-container .box .info i { margin: 0.5rem 0; margin-right: 1rem; border-radius: 50%; background: #fff; color: #f83292; font-size: 1.5rem; height: 4.5rem; width: 4.5rem; line-height: 4.5rem; text-align: center; } .footer .credit { font-size: 2rem; font-weight: normal; letter-spacing: 0.1rem; color: #fff; border-top: 0.1rem solid #fff5; padding: 2.5rem 1rem; text-align: center; } /* media queries  */ @media (max-width: 1200px) { html { font-size: 55%; } } @media (max-width: 991px) { section { padding: 0 3%; padding-top: 7.5rem; padding-bottom: 2rem; } } @media (max-width: 768px) { header label { visibility: visible; opacity: 1; } header .navbar { position: absolute; top: 100%; left: 0; width: 100%; background: #fff; padding: 1rem 2rem; border-top: 0.1rem solid rgba(0, 0, 0, 0.2); box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1); transform-origin: top; transform: scaleY(0); opacity: 0; transition: 0.2s linear; } header .navbar a { display: block; margin: 2rem 0; font-size: 2rem; } header input:checked ~ .navbar { transform: scaleY(1); opacity: 1; } header input:checked ~ label::before { content: "\f00d"; } .home { flex-flow: column-reverse; } .home .image img { width: 100%; } .home .content h3 { font-size: 3.6rem; } .home .content p { font-size: 1.5rem; } .about { background-position: right; } .newsletter p { width: auto; } } @media (max-width: 450px) { html { font-size: 50%; } .about .column .content .buttons a { width: 100%; text-align: center; } .about .column .content .buttons a:last-child { margin: 1rem 0; } }`,
      ideationPricingHTML: `<div class="pricing" id="pricing"> <h1 class="heading">OUR PRICING PLANS</h1> <div class="box-container"> <div class="box"> <h3 class="title">Basic</h3> <div class="price">$10<span>/monthly</span></div> <ul> <li><i class="fas fa-check"></i> 1000+ downloads</li> <li><i class="fas fa-check"></i> No transaction fees</li> <li><i class="fas fa-times"></i> unlimited storage</li> <li><i class="fas fa-times"></i> 5 downloads</li> </ul> <a href="#" class="btn">check out</a> </div> <div class="box"> <h3 class="title">Standard</h3> <div class="price">$15<span>/monthly</span></div> <ul> <li><i class="fas fa-check"></i> 1000+ downloads</li> <li><i class="fas fa-check"></i> No transaction fees</li> <li><i class="fas fa-check"></i> unlimited storage</li> <li><i class="fas fa-times"></i> 5 downloads</li> </ul> <a href="#" class="btn">check out</a> </div> <div class="box"> <h3 class="title">Premium</h3> <div class="price">$25<span>/monthly</span></div> <ul> <li><i class="fas fa-check"></i> 1000+ downloads</li> <li><i class="fas fa-check"></i> No transaction fees</li> <li><i class="fas fa-check"></i> unlimited storage</li> <li><i class="fas fa-check"></i> 5 downloads</li> </ul> <a href="#" class="btn">check out</a> </div> </div> </div>`,
      ideationFooter: `<div class="footer"> <div class="box-container"> <div class="box"> <h3>About us</h3> <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet pariatur rerum consectetur architecto ad tempora blanditiis quo aliquid inventore a. </p> </div> <div class="box"> <h3>Quick links</h3> <a href="#">home</a> <a href="#">features</a> <a href="#">about</a> <a href="#">review</a> <a href="#">pricing</a> </div> <div class="box"> <h3>Follow us</h3> <a href="#">facebook</a> <a href="#">instagram</a> <a href="#">pinterest</a> <a href="#">twitter</a> </div> <div class="box"> <h3>Contact info</h3> <div class="info"> <i class="fas fa-phone"></i> <p>+60-195153880 <br /></p> </div> <div class="info"> <i class="fas fa-envelope"></i> <p> example@gmail.com <br /> example@gmail.com </p> </div> <div class="info"> <i class="fas fa-map-marker-alt"></i> <p>Kuala Lumpur Malaysia</p> </div> </div> </div> <h1 class="credit">&copy; copyright @ 2021 by Startup Ideation System</h1> </div>`,
      techHTML: `
      <head>
              <link
          rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        />
      </head>

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


            <section class="home" id="home">
          <div class="content">
            <h3>App Landing Page</h3>
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

        <section class="features" id="features">
          <h1 class="heading">APP FEATURES</h1>

          <div class="box-container">
            <div class="box">
              <i class="fas fa-magic"></i>
              <h3>Smooth design</h3>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque
                enim ad neque. Voluptatem alias beatae accusamus laudantium nisi
                assumenda libero.
              </p>
            </div>
            <div class="box">
              <i class="fas fa-shield-alt"></i>
              <h3>Privacy protect</h3>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque
                enim ad neque. Voluptatem alias beatae accusamus laudantium nisi
                assumenda libero.
              </p>
            </div>
            <div class="box">
              <i class="fas fa-globe"></i>
              <h3>Multiple language</h3>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque
                enim ad neque. Voluptatem alias beatae accusamus laudantium nisi
                assumenda libero.
              </p>
            </div>
            <div class="box">
              <i class="fas fa-map-marker-alt"></i>
              <h3>Location tracking</h3>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque
                enim ad neque. Voluptatem alias beatae accusamus laudantium nisi
                assumenda libero.
              </p>
            </div>
            <div class="box">
              <i class="fas fa-cogs"></i>
              <h3>Powerful settings</h3>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque
                enim ad neque. Voluptatem alias beatae accusamus laudantium nisi
                assumenda libero.
              </p>
            </div>
            <div class="box">
              <i class="fas fa-headset"></i>
              <h3>24/7 Service</h3>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque
                enim ad neque. Voluptatem alias beatae accusamus laudantium nisi
                assumenda libero.
              </p>
            </div>
          </div>
        </section>

                <section class="about" id="about">
          <h1 class="heading">ABOUT THE APP</h1>

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

               <section class="usage" id="usage">
          <h1 class="heading">How it works?</h1>

          <div class="row">
            <div class="box-container">
              <div class="box">
                <i class="fas fa-sort-amount-down"></i>
                <h3>Minimum progress</h3>
                <p>
                  Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rem
                  dolor nihil dicta eveniet quam nam explicabo, natus labore
                  quia cupiditate.
                </p>
              </div>
              <div class="box">
                <i class="fas fa-user-clock"></i>
                <h3>Active time</h3>
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
                <h3>Maximum progress</h3>
                <p>
                  Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rem
                  dolor nihil dicta eveniet quam nam explicabo, natus labore
                  quia cupiditate.
                </p>
              </div>
              <div class="box">
                <i class="fas fa-fire"></i>
                <h3>Calories burned</h3>
                <p>
                  Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rem
                  dolor nihil dicta eveniet quam nam explicabo, natus labore
                  quia cupiditate.
                </p>
              </div>
            </div>
          </div>
        </section>

       <section class="review" id="review">
          <h1 class="heading">Customers review</h1>

          <div class="box-container">
            <div class="box">
              <img
                src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-2/pic1.png"
                alt=""
              />
              <h3>John Doe</h3>
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
              <h3>John Doe</h3>
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
              <h3>John Doe</h3>
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
      `,
      techCSS: `
      @import url("https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700&display=swap");

.sticky {
  position: fixed;
  top: 30px;
  z-index: 100;
  height: 50px;
  width: 50px;
  margin-left: 15px;
  cursor: pointer;
}

* {
  font-family: "Nunito", sans-serif;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  text-decoration: none;
  outline: none;
  border: none;
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
      `,
      techPricingHTML: `
              <div class="pricing" id="pricing">
          <h1 class="heading">OUR PRICING PLANS</h1>

          <div class="box-container">
            <div class="box">
              <div class="price"><span>$</span>10<span>/month</span></div>
              <h3>Basic</h3>
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
              <h3>Standard</h3>
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
              <h3>Premium</h3>
              <ul>
                <li>100 MB Disk Space</li>
                <li>2 Subdomains</li>
                <li>5 Email Accounts</li>
                <li>email support</li>
              </ul>
              <a href="#" class="btn">select plan</a>
            </div>
          </div>
        </div>
      
      `,
      techFooter: `
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

      
      `,
    };
  },
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
      this.$store.commit("setEditingMode", false);
      switch (template) {
        case "ideation":
          //Pass Ideation HTML CSS
          this.$store.commit("setTemplateHTML", this.ideationHTML);
          this.$store.commit("setTemplateCSS", this.ideationCSS);
          this.$store.commit(
            "setTemplatePricingHTML",
            this.ideationPricingHTML
          );
          this.$store.commit("setTemplateFooterHTML", this.ideationFooter);
          this.$store.commit("setcurrentTemplate", "ideation");
          this.$router.push({
            name: "LandingEditor",
            params: { id: this.currentProjectID },
          });
          break;
        case "tech":
          this.$store.commit("setTemplateHTML", this.techHTML);
          this.$store.commit("setTemplateCSS", this.techCSS);
          this.$store.commit("setTemplatePricingHTML", this.techPricingHTML);
          this.$store.commit("setTemplateFooterHTML", this.techFooter);
          this.$store.commit("setcurrentTemplate", "tech");
          this.$router.push({
            name: "LandingEditor",
            params: { id: this.currentProjectID },
          });
          break;
        default:
          console.log("Invalid Template");
      }
    },
  },
  created() {
    this.currentProjectID = this.$route.params.id;
    console.log(this.currentProjectID);
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