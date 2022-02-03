<template>
  <div class="flexContainer">
    <div id="navbar" class="sidenav">
      <span id="logo">Startup Ideation System</span>
      <ul class="list-group pages"></ul>
      <div class="tabs">
        <div class="wrapper">
          <input type="radio" name="slider" checked id="blocksRadio" />
          <input type="radio" name="slider" id="layers" />
          <nav>
            <label for="blocksRadio" class="blocksRadio"
              ><blocks></blocks
            ></label>
            <label for="layers" class="layers"><layers></layers></label>
            <div class="slider"></div>
          </nav>
          <section>
            <div class="content content-1">
              <div id="blocks"></div>
            </div>
            <div class="content content-2">
              <div id="layer-container"></div>
            </div>
          </section>
        </div>
      </div>
      <div></div>
    </div>

    <div
      class="main-content"
      :style="{ width: fillMainContent ? '85%' : '70%' }"
    >
      <div class="panel__top">
        <div class="panel__basic-actions"></div>
        <div class="panel-save">
          <general-button
            v-if="editingMode === false"
            @click.native="handleBack"
            >Choose Another Template</general-button
          >
          <general-button v-if="editingMode" @click.native="handleBackDashboard"
            >Back to Dashboard</general-button
          >
          <general-button @click.native="handleSave">Save</general-button>
          <general-button @click.native="handlePreview">Preview</general-button>
        </div>
      </div>
      <!-- <div class="mainNav"></div> -->
      <div id="editor"></div>
    </div>
    <div
      id="style-nav"
      :style="{
        width: styleComponents
          ? (fillMainContent = false)
          : (fillMainContent = true),
        display: styleComponents ? 'block' : 'none',
      }"
    >
      <x-mark @click.native="closeStyleManager" :toggleHover="false"></x-mark>
      <h2>Settings</h2>
      <div id="traits"></div>
      <h2>Style Manager</h2>
    </div>
  </div>
</template>

<script>
import "grapesjs/dist/css/grapes.min.css";
import grapesjs from "grapesjs";
import grapesjsBlocks from "grapesjs-blocks-basic";
import grapesjsTabs from "grapesjs-tabs";
import grapesjsForms from "grapesjs-plugin-forms";
import grapesjsNavbar from "grapesjs-navbar";
import blocks from "../../components/icons/blocks.vue";
import Layers from "../../components/icons/layers.vue";
import XMark from "../../components/icons/x-mark.vue";
import GeneralButton from "../../components/GeneralButton.vue";
import landingApi from "@/api/landingApi.js";
import { mapGetters } from "vuex";

export default {
  components: {
    blocks,
    Layers,
    XMark,
    GeneralButton,
  },
  data() {
    return {
      styleComponents: false,
      fillMainContent: true,
      editor: "",
      editingHTML: "",
      editingCSS: "",
      currentProjectID: 0,
    };
  },
  methods: {
    closeStyleManager() {
      this.styleComponents = false;
      this.fillMainContent = true;
    },
    handleBack() {
      this.$router.push({ name: "LandingChooseTemplates" });
    },
    handleBackDashboard() {
      this.$store.commit("setEditingMode", false);
      this.$router.push({ name: "LandingDashboard" });
    },
    injectModal() {
      let stringHTML = this.editor.getHtml();
      switch (this.currentTemplate) {
        case "ideation": {
          let injectedStringHTML = stringHTML.replaceAll(
            `<a href="#" class="btn">check out</a>`,
            `<div class="btn pricing-btn">check out</div>`
          );
          return injectedStringHTML;
        }
        case "tech": {
          let injectedStringHTML = stringHTML.replaceAll(
            `<a href="#" class="btn">select plan</a>`,
            `<div class="btn pricing-btn">select plan</div>`
          );
          return injectedStringHTML;
        }
      }
    },
    handlePreview() {
      //Get HTML and edit Checkout Button to inject @click="showmodal = true"
      this.$store.commit("setpageCSS", this.editor.getCss());
      this.$store.commit("setpageHTML", this.injectModal());
      this.$store.commit("setPreviewTrue");
      this.$router.push("/landingpage");
    },
    async handleSave() {
      alert("Are you sure with this design?");
      let landingdata = {
        html: this.injectModal(),
        css: this.editor.getCss(),
        landingName: this.landingName,
        landingRevGoal: this.landingRevenueGoal,
      };
      if (this.editingMode) {
        let updatePage = await landingApi.updateLandingPage(
          landingdata,
          this.currentProjectID
        );
        if (updatePage.data.success === false) {
          throw new Error("Update Landing Page Fail!");
        } else {
          this.$store.commit("setEditingMode", false);
          this.$router.push({ name: "LandingDashboard" });
        }
      } else {
        let addPage = await landingApi.addLandingPage(
          landingdata,
          this.currentProjectID
        );
        if (addPage.data.success === false) {
          throw new Error("Add Landing Page Fail!");
        } else {
          this.$store.commit("setEditingMode", false);
          this.$router.push({ name: "LandingDashboard" });
        }
      }
    },
  },
  computed: {
    ...mapGetters([
      "templateHTML",
      "templateCSS",
      "templatePricingHTML",
      "templateFooterHTML",
      "currentTemplate",
      "landingName",
      "landingRevenueGoal",
      "editingMode",
      "fromPreview",
      "pageHTML",
      "pageCSS"
    ]),
  },
  async mounted() {
    this.currentProjectID = this.$route.params.id
    this.editor = grapesjs.init({
      container: "#editor",
      fromElement: true,
      width: "auto",
      storageManager: {
        id: "gjs-", // Prefix identifier that will be used on parameters
        type: "local", // Type of the storage
        autosave: true, // Store data automatically
        autoload: true, // Autoload stored data on init
        stepsBeforeSave: 1, // If autosave enabled, indicates how many changes are necessary before store method is triggered
      },
      // assetManager:{
      //   // upload: 'http://localhost/api/landing/uploadeditorimage/1',
      //   upload: await landingApi.uploadEditorImage(1,'files'),
      //   uploadName: 'files',
      // },

      plugins: [grapesjsBlocks, grapesjsTabs, grapesjsForms, grapesjsNavbar],
      pluginsOpts: {
        grapesjsBlocks: {},
        grapesjsTabs: {},
        grapesjsForms: {},
        grapesjsNavbar: {},
      },
      traitManager: {
        appendTo: "#traits",
      },
      blockManager: {
        appendTo: "#blocks",
        custom: true,
      },
      layerManager: {
        appendTo: "#layer-container",
      },
      styleManager: {
        appendTo: "#style-nav",
        sectors: [
          {
            name: "General",
            open: false,
            buildProps: [
              "float",
              "display",
              "position",
              "top",
              "right",
              "left",
              "bottom",
            ],
          },
          {
            name: "Layout",
            open: false,
            buildProps: [
              "width",
              "height",
              "max-width",
              "min-height",
              "margin",
              "padding",
            ],
          },
          {
            name: "Typography",
            open: false,
            buildProps: [
              "font-family",
              "font-size",
              "font-weight",
              "letter-spacing",
              "color",
              "line-height",
              "text-align",
              "text-shadow",
            ],
            properties: [
              {
                property: "text-align",
                list: [
                  { value: "left", className: "fa fa-align-left" },
                  { value: "center", className: "fa fa-align-center" },
                  { value: "right", className: "fa fa-align-right" },
                  { value: "justify", className: "fa fa-align-justify" },
                ],
              },
            ],
          },
          {
            name: "Decorations",
            open: false,
            buildProps: [
              "border-radius-c",
              "background-color",
              "border-radius",
              "border",
              "box-shadow",
              "background",
            ],
          },
          {
            name: "Extra",
            open: false,
            buildProps: ["transition", "perspective", "transform"],
          },
        ],
      },
      panels: {
        defaults: [{}],
      },
    });
    const editor = this.editor;
    const handleOpen = () => {
      this.styleComponents = true;
    };
    const handleClose = () => {
      this.styleComponents = false;
    };
    editor.on("component:selected", handleOpen);
    editor.on("component:deselected", handleClose);

    //Add Panels
    const panelManager = editor.Panels;
    panelManager.addPanel({
      id: "panel-top",
      el: ".panel__top",
    });
    panelManager.addPanel({
      id: "basic-actions",
      el: ".panel__basic-actions",
      buttons: [
        {
          id: "visibility",
          active: true, // active by default
          className: "btn-toggle-borders",
          label: "<u>B</u>",
          command: "sw-visibility", // Built-in command
        },
        {
          id: "export",
          className: "btn-open-export",
          label: "Exp",
          command: "export-template",
          context: "export-template", // For grouping context of buttons from the same panel
        },
        {
          id: "show-json",
          className: "btn-show-json",
          label: "JSON",
          context: "show-json",
          command(editor) {
            editor.Modal.setTitle("Components JSON")
              .setContent(
                `<textarea style="width:100%; height: 250px;">
            ${JSON.stringify(editor.getComponents())}
          </textarea>`
              )
              .open();
          },
        },
        {
          id: "undo",
          className: "fa fa-undo",
          command: (e) => e.runCommand("core:undo"),
        },
        {
          id: "redo",
          className: "fa fa-repeat",
          command: (e) => e.runCommand("core:redo"),
        },
        {
          id: "canvas-clear",
          className: "fa fa-trash",
          command: (e) =>
            e.runCommand(
              "core:canvas-clear",
              window.confirm("Clear the whole canvas?")
            ),
        },
        {
          id: "sw-visibility",
          command: "sw-visibility",
          context: "sw-visibility",
          className: "fa fa-square-o",
        },
      ],
    });

    //If Editing mode true
    if (this.editingMode) {
      let landing = await landingApi.getLandingData(this.currentProjectID);
      this.editingHTML = landing.data.data[0].landingHTML;
      this.editingCSS = landing.data.data[0].landingCSS;
      editor.addComponents(landing.data.data[0].landingHTML);
      editor.setStyle(landing.data.data[0].landingCSS);
      //Bug Editing
    } else if (this.fromPreview) {
      editor.addComponents(this.pageHTML);
      editor.setStyle(this.pageCSS);
      this.$store.commit("setFromPreview",false);
    } else {
      //Get Passed Landing Page Template
      editor.addComponents(this.templateHTML);
      // editor.addComponents(` <head> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" /> </head> <header> <a href="#" class="logo"><span>best</span>App</a> <input type="checkbox" id="menu-bar" /> <label for="menu-bar" class="fas fa-bars"></label> <nav class="navbar"> <a href="#home">home</a> <a href="#features">features</a> <a href="#about">about</a> <a href="#review">review</a> <a href="#pricing">pricing</a> </nav> </header> <section class="home" id="home"> <div class="content"> <h3>best mobile app <span>showcase</span></h3> <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus suscipit porro nam libero natus error consequatur sed repudiandae eos quo? </p> <a href="#pricing" class="btn">download now</a> </div> <div class="image"> <img src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-1/home-img.png" alt="" /> </div> </section> <section class="features" id="features"> <h1 class="heading">app features</h1> <div class="box-container"> <div class="box"> <img src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-1/f-icon1.png" alt="" /> <h3>amazing UI design</h3> <p> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ullam minus recusandae autem, repellendus fugit quaerat provident voluptatum non officiis ratione. </p> <a href="#" class="btn">read more</a> </div> <div class="box"> <img src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-1/f-icon2.png" alt="" /> <h3>soft and smooth animations</h3> <p> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ullam minus recusandae autem, repellendus fugit quaerat provident voluptatum non officiis ratione. </p> <a href="#" class="btn">read more</a> </div> <div class="box"> <img src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-1/f-icon3.png" alt="" /> <h3>freindly interactions</h3> <p> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ullam minus recusandae autem, repellendus fugit quaerat provident voluptatum non officiis ratione. </p> <a href="#" class="btn">read more</a> </div> </div> </section> <section class="about" id="about"> <h1 class="heading">about the app</h1> <div class="column"> <div class="image"> <img src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-1/about-img.png" alt="" /> </div> <div class="content"> <h3>Easy And Perfect Solution For Your Business App</h3> <p> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nulla placeat deserunt saepe repudiandae veniam soluta minima dolor hic aperiam iure. </p> <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium, quaerat. Dolorem ratione saepe magni quo inventore porro ab voluptates eos, nam eius provident accusantium, quia similique est, repellendus et reiciendis. </p> <div class="buttons"> <a href="#pricing" class="btn"> <i class="fab fa-apple"></i> app store </a> <a href="#pricing" class="btn"> <i class="fab fa-google-play"></i> google-play </a> </div> </div> </div> </section> <div class="newsletter"> <h3>Subscribe For New Features</h3> <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus sed aliquam quibusdam neque magni magnam est laborum doloribus, facere dolores. </p> </div> <section class="review" id="review"> <h1 class="heading">people's review</h1> <div class="box-container"> <div class="box"> <i class="fas fa-quote-right"></i> <div class="user"> <img src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-1/pic1.png" alt="" /> <h3>john deo</h3> <div class="stars"> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> </div> <div class="comment"> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus et, perspiciatis nisi tempore aspernatur accusantium sed distinctio facilis aperiam laborum autem earum repellat, commodi eum. Ullam cupiditate expedita officiis obcaecati? </div> </div> </div> <div class="box"> <i class="fas fa-quote-right"></i> <div class="user"> <img src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-1/pic2.png" alt="" /> <h3>john deo</h3> <div class="stars"> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star-half-alt"></i> </div> <div class="comment"> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus et, perspiciatis nisi tempore aspernatur accusantium sed distinctio facilis aperiam laborum autem earum repellat, commodi eum. Ullam cupiditate expedita officiis obcaecati? </div> </div> </div> <div class="box"> <i class="fas fa-quote-right"></i> <div class="user"> <img src="https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-1/pic3.png" alt="" /> <h3>john deo</h3> <div class="stars"> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="far fa-star"></i> </div> <div class="comment"> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus et, perspiciatis nisi tempore aspernatur accusantium sed distinctio facilis aperiam laborum autem earum repellat, commodi eum. Ullam cupiditate expedita officiis obcaecati? </div> </div> </div> </div> </section> `)[0];
      //Pricing Section Starts
      const DomComponents = editor.DomComponents;
      DomComponents.addComponent({
        tagName: "section",
        removable: false, // Can't remove it
        draggable: true, // Can't move it
        copyable: true, // Disable copy/past
        // components: `<div class="pricing" id="pricing"> <h1 class="heading">Our Pricing Plans</h1> <div class="box-container"> <div class="box"> <h3 class="title">basic</h3> <div class="price">$10<span>/monthly</span></div> <ul> <li><i class="fas fa-check"></i> 1000+ downloads</li> <li><i class="fas fa-check"></i> No transaction fees</li> <li><i class="fas fa-times"></i> unlimited storage</li> <li><i class="fas fa-times"></i> 5 downloads</li> </ul> <a href="#" class="btn">check out</a> </div> <div class="box"> <h3 class="title">standard</h3> <div class="price">$15<span>/monthly</span></div> <ul> <li><i class="fas fa-check"></i> 1000+ downloads</li> <li><i class="fas fa-check"></i> No transaction fees</li> <li><i class="fas fa-check"></i> unlimited storage</li> <li><i class="fas fa-times"></i> 5 downloads</li> </ul> <a href="#" class="btn">check out</a> </div> <div class="box"> <h3 class="title">premium</h3> <div class="price">$25<span>/monthly</span></div> <ul> <li><i class="fas fa-check"></i> 1000+ downloads</li> <li><i class="fas fa-check"></i> No transaction fees</li> <li><i class="fas fa-check"></i> unlimited storage</li> <li><i class="fas fa-check"></i> 5 downloads</li> </ul> <a href="#" class="btn">check out</a> </div> </div> </div>`,
        components: this.templatePricingHTML,
      });
      //Add Footer Template
      editor.addComponents(this.templateFooterHTML);
      //Add CSS Style for canvas
      editor.setStyle(this.templateCSS);
      // editor.setStyle(
      //   `html { font-size: 62.5%; overflow-x: hidden; } .sticky{ position: fixed; top: 10; z-index: 100; height: 50px; width: 50px; margin-left: 15px; cursor: pointer; } * { font-family: "Poppins", sans-serif; margin: 0; padding: 0; box-sizing: border-box; text-decoration: none; outline: none; border: none; text-transform: capitalize; } *::selection { background: #f83292; color: #fff; } section { min-height: 100vh; padding: 0 9%; padding-top: 7.5rem; padding-bottom: 2rem; } .btn { display: inline-block; margin-top: 1rem; padding: 0.8rem 3rem; border-radius: 5rem; background: linear-gradient(90deg, #814096, #f83292); font-size: 1.7rem; color: #fff; cursor: pointer; box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1); transition: all 0.3s linear; } .btn:hover { transform: scale(1.1); } .heading { text-align: center; color: #814096; font-size: 3.5rem; text-transform: uppercase; padding: 1rem; } header { position: fixed; top: 0; left: 0; width: 100%; background: #fff; box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1); padding: 2rem 9%; display: flex; align-items: center; justify-content: space-between; z-index: 99; } header .logo { font-size: 2rem; color: #814096; } header .logo span { color: #f83292; } header .navbar a { font-size: 1.7rem; margin-left: 2rem; color: #814096; } header .navbar a:hover { color: #f83292; } header input { display: none; } header label { font-size: 3rem; color: #814096; cursor: pointer; visibility: hidden; opacity: 0; } .home { display: flex; align-items: center; justify-content: center; background: url(https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-1/home-bg-img.png) no-repeat; background-size: cover; background-position: center; } .home .image img { width: 40vw; animation: float 3s linear infinite; } @keyframes float { 0%, 100% { transform: translateY(0rem); } 50% { transform: translateY(-3.5rem); } } .home .content h3 { font-size: 5.5rem; color: #333; text-transform: uppercase; } .home .content h3 span { color: #f83292; text-transform: uppercase; } .home .content p { font-size: 1.7rem; color: #666; padding: 1rem 0; } .features .box-container { display: flex; align-items: center; justify-content: center; flex-wrap: wrap; } .features .box-container .box { flex: 1 1 30rem; background: #fff; border-radius: 0.5rem; border: 0.1rem solid rgba(0, 0, 0, 0.2); box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1); margin: 1.5rem; padding: 3rem 2rem; border-radius: 0.5rem; text-align: center; transition: 0.2s linear; } .features .box-container .box img { height: 15rem; } .features .box-container .box h3 { font-size: 2rem; color: #333; padding-top: 1rem; } .features .box-container .box p { font-size: 1.3rem; color: #666; padding: 1rem 0; } .about { background: url(https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-1/about-bg.png) no-repeat; background-size: cover; background-position: center; padding-bottom: 3rem; } .about .column { display: flex; align-items: center; justify-content: center; flex-wrap: wrap; } .about .column .image { flex: 1 1 40rem; } .about .column .image img { width: 100%; } .about .column .content { flex: 1 1 40rem; } .about .column .content h3 { font-size: 3rem; color: #666; } .about .column .content p { font-size: 1.5rem; color: #666; padding: 1rem 0; } .about .column .content .buttons a:last-child { margin-left: 2rem; } .newsletter { text-align: center; padding: 5rem 1rem; background: url(https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-1/subscribe-bg.png) no-repeat; background-size: cover; background-position: center; } .newsletter h3 { color: #fff; font-size: 3rem; text-transform: uppercase; } .newsletter p { color: #fff; font-size: 1.6rem; margin: 2rem auto; width: 70rem; } .newsletter form { display: flex; max-width: 70rem; border: 0.2rem solid #fff; padding: 0.5rem; border-radius: 5rem; margin: 2rem auto; height: 5.5rem; } .newsletter form input[type="email"] { padding: 0 2rem; font-size: 1.7rem; background: none; width: 100%; color: #fff; text-transform: none; background: none; } .newsletter form input[type="email"]::placeholder { color: #eee; text-transform: capitalize; } .newsletter form input[type="submit"] { background: #fff; width: 20rem; font-size: 1.7rem; border-radius: 5rem; cursor: pointer; } .newsletter form input[type="submit"]:hover { color: #f83292; } .review .box-container { display: flex; align-items: center; justify-content: center; flex-wrap: wrap; } .review .box-container .box { background: #fff; margin: 1rem; padding: 1rem; text-align: center; position: relative; border: 0.1rem solid rgba(0, 0, 0, 0.2); box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1); flex: 1 1 30rem; border-radius: 0.5rem; } .review .box-container .box .fa-quote-right { position: absolute; top: 1rem; right: 2rem; font-size: 8rem; color: #f83292; opacity: 0.3; } .review .box-container .box .user img { border-radius: 50%; object-fit: cover; height: 7rem; width: 7rem; margin-top: 2rem; } .review .box-container .box .user h3 { color: #f83292; font-size: 2rem; } .review .box-container .box .user .stars i { color: #814096; font-size: 1.5rem; padding: 1rem 0; } .review .box-container .box .comment { color: #666; font-size: 1.4rem; padding: 1rem; } .pricing .box-container { display: flex; align-items: center; justify-content: center; flex-wrap: wrap; } .pricing .box-container .box { flex: 1 1 27rem; margin: 1rem; padding: 1rem; background: #fff; border: 0.1rem solid rgba(0, 0, 0, 0.2); box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1); border-radius: 0.5rem; text-align: center; padding-bottom: 3rem; } .pricing .box-container .box:nth-child(2), .pricing .box-container .box:hover { border: 0.2rem solid #f83292; } .pricing .box-container .box .title { color: #814096; font-size: 2.5rem; padding-top: 1rem; } .pricing .box-container .box .price { font-size: 4rem; color: #f83292; padding: 1rem 0; } .pricing .box-container .box .price span { font-size: 2rem; } .pricing .box-container .box ul { padding: 1rem 0; list-style: none; } .pricing .box-container .box ul li { font-size: 1.7rem; color: #666; padding: 0.5rem 0; } .pricing .box-container .box ul li .fa-check { color: lightgreen; } .pricing .box-container .box ul li .fa-times { color: tomato; } .contact { display: flex; align-items: center; justify-content: center; flex-wrap: wrap; padding-bottom: 4rem; } .contact .image { flex: 1 1 40rem; } .contact .image img { width: 100%; padding: 2rem; } .contact form { flex: 1 1 40rem; padding: 2rem 3rem; border: 0.1rem solid rgba(0, 0, 0, 0.2); box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1); border-radius: 0.5rem; background: #fff; } .contact form .heading { text-align: left; padding: 0; padding-bottom: 2rem; } .contact form .inputBox { position: relative; } .contact form .inputBox input, .contact form .inputBox textarea { width: 100%; background: none; color: #666; margin: 1.5rem 0; padding: 0.5rem 0; font-size: 1.7rem; border-bottom: 0.1rem solid rgba(0, 0, 0, 0.1); text-transform: none; } .contact form .inputBox textarea { resize: none; height: 13rem; } .contact form .inputBox label { position: absolute; top: 1.7rem; left: 0; font-size: 1.7rem; color: #666; transition: 0.2s linear; } .contact form .inputBox input:focus ~ label, .contact form .inputBox input:valid ~ label, .contact form .inputBox textarea:focus ~ label, .contact form .inputBox textarea:valid ~ label { top: -0.5rem; font-size: 1.5rem; color: #f83292; } .footer { padding-top: 3rem; background: url(https://storage.googleapis.com/startup-ideation/landing-page/templates/landingpage-1/footer-bg.png) no-repeat; background-size: cover; background-position: center; } .footer .box-container { display: flex; flex-wrap: wrap; } .footer .box-container .box { flex: 1 1 25rem; margin: 2rem; } .footer .box-container .box h3 { font-size: 2.5rem; padding: 1rem 0; color: #fff; text-decoration: underline; text-underline-offset: 1rem; } .footer .box-container .box p { font-size: 1.5rem; padding: 0.5rem 0; color: #eee; } .footer .box-container .box a { display: block; font-size: 1.5rem; padding: 0.5rem 0; color: #eee; } .footer .box-container .box a:hover { text-decoration: underline; } .footer .box-container .box .info { display: flex; align-items: center; } .footer .box-container .box .info i { margin: 0.5rem 0; margin-right: 1rem; border-radius: 50%; background: #fff; color: #f83292; font-size: 1.5rem; height: 4.5rem; width: 4.5rem; line-height: 4.5rem; text-align: center; } .footer .credit { font-size: 2rem; font-weight: normal; letter-spacing: 0.1rem; color: #fff; border-top: 0.1rem solid #fff5; padding: 2.5rem 1rem; text-align: center; } /* media queries  */ @media (max-width: 1200px) { html { font-size: 55%; } } @media (max-width: 991px) { section { padding: 0 3%; padding-top: 7.5rem; padding-bottom: 2rem; } } @media (max-width: 768px) { header label { visibility: visible; opacity: 1; } header .navbar { position: absolute; top: 100%; left: 0; width: 100%; background: #fff; padding: 1rem 2rem; border-top: 0.1rem solid rgba(0, 0, 0, 0.2); box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1); transform-origin: top; transform: scaleY(0); opacity: 0; transition: 0.2s linear; } header .navbar a { display: block; margin: 2rem 0; font-size: 2rem; } header input:checked ~ .navbar { transform: scaleY(1); opacity: 1; } header input:checked ~ label::before { content: "\f00d"; } .home { flex-flow: column-reverse; } .home .image img { width: 100%; } .home .content h3 { font-size: 3.6rem; } .home .content p { font-size: 1.5rem; } .about { background-position: right; } .newsletter p { width: auto; } } @media (max-width: 450px) { html { font-size: 50%; } .about .column .content .buttons a { width: 100%; text-align: center; } .about .column .content .buttons a:last-child { margin: 1rem 0; } }`
      // );
    }
  },
  beforeDestroy() {
    this.$store.commit("setFromPreview",false);
    this.editor.runCommand("core:canvas-clear");
  },
};
</script>

<style lang="scss" scoped>
.fa-xmark {
  cursor: pointer;
}
.flexContainer {
  max-width: 100%;
  display: flex;
}

.closeStyle {
  cursor: pointer;
}

/* Theming */
::v-deep {
  .gjs-one-bg {
    background-color: #fff;
  }
  .gjs-two-color {
    color: #222222;
  }
  .gjs-three-bg {
    background-color: #8743ff;
    color: white;
  }

  .gjs-four-color {
    color: #8743ff;
  }

  .gjs-four-color-h:hover {
    color: #8743ff;
  }

  .gjs-pn-panels {
    position: relative;
    display: none;
  }
  .gjs-cv-canvas {
    width: 100%;
    height: 100%;
    top: 0;
  }

  .gjs-category-title,
  .gjs-layer-title,
  .gjs-block-category .gjs-title,
  .gjs-sm-sector .gjs-sm-title,
  .gjs-clm-tags .gjs-sm-title {
    background-color: rgb(247 247 247);
  }
}

.sidenav {
  position: fixed;
  top: 0;
  left: 0;
  width: 15%;
  height: 100vh;
  overflow: scroll;
  overflow-x: hidden;
  scrollbar-width: none;
  background-color: rgba(255, 255, 255, 0.95);
  transition: 0.5s;
  box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
  display: flex;
  flex-direction: column;
  align-items: center;
  // z-index: 99;
}

#style-nav {
  position: fixed;
  display: block;
  top: 0;
  left: 85%;
  width: 15%;
  height: 100vh;
  overflow: scroll;
  overflow-x: hidden;
  background-color: rgba(255, 255, 255, 0.95);
  box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
}

#logo {
  margin-top: 10px;
}

::v-deep svg {
  height: 25px;
  width: 25px;
}

::selection {
  background: linear-gradient(180deg, #8743ff 0%, #4136f1 100%);
}
.wrapper {
  position: absolute;
  left: 0;
  width: 100%;
  border-radius: 5px;
  background: #fff;
  box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.1);
}

.wrapper nav {
  position: relative;
  width: 100%;
  height: 35px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 10px;
}
.wrapper nav label {
  height: 100%;
  width: 100%;
  text-align: center;
  line-height: 50px;
  cursor: pointer;
  position: relative;
  z-index: 1;
  color: #8743ff;
  border-radius: 5px;
  transition: all 0.3s ease;
}
.wrapper nav label:hover {
  background: linear-gradient(180deg, #8743ff 0%, #4136f1 100%);
  color: #ffffff;
}
#blocksRadio:checked ~ nav label.blocksRadio,
#styles:checked ~ nav label.styles,
#layers:checked ~ nav label.layers {
  color: #fff;
}

nav .slider {
  position: absolute;
  height: 100%;
  width: 50%;
  left: 0;
  bottom: 0;
  z-index: 0;
  border-radius: 5px;
  background: linear-gradient(180deg, #8743ff 0%, #4136f1 100%);
  transition: all 0.3s ease;
}
input[type="radio"] {
  display: none;
}
#layers:checked ~ nav .slider {
  left: 50%;
}

section .content {
  display: none;
  background: #fff;
}
#blocksRadio:checked ~ section .content-1,
#layers:checked ~ section .content-2 {
  display: block;
}

.main-content {
  position: relative;
  // width: 85%;
  left: 15%;
  .panel__top {
    padding: 10;
    display: flex;
    position: initial;
    justify-content: center;
    justify-content: space-between;
    .panel-save {
      display: flex;
      gap: 15px;
    }
    .panel__basic-actions {
      display: flex;
      position: initial;
    }
  }
}
</style>