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
          <general-button @click.native = "handleSave">Save</general-button>
          <general-button>Preview</general-button>
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
      <x-mark @click.native="closeStyleManager"></x-mark>
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
    };
  },
  methods: {
    closeStyleManager() {
      this.styleComponents = false;
      this.fillMainContent = true;
    },
    handleSave() {
      this.$store.commit('setpageCSS',this.editor.getCss())
      this.$store.commit('setpageHTML',this.editor.getHtml())
      this.$router.push('/landingpage')
      // console.log(this.$store.state.landingRepository.pageCSS);
      // console.log(this.$store.state.landingRepository.pageHTML);

      // console.log(this.editor.getHtml());
      // console.log(this.editor.getCss());
      // this.pageHTML = this.editor.getHtml();
      // this.pageCSS = this.editor.getCss();


    },
  },
  mounted() {
    this.editor = grapesjs.init({
      container: "#editor",
      fromElement: true,
      width: "auto",
      storageManager: false,
      plugins: [grapesjsBlocks, grapesjsTabs, grapesjsForms, grapesjsNavbar],
      pluginsOpts: {
        grapesjsBlocks: {},
        grapesjsTabs: {},
        grapesjsForms: {},
        grapesjsNavbar: {},
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
    console.log(this.styleComponents);

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
          id: "preview",
          context: "preview",
          // command: (e) => e.runCommand("preview"),
          command: "preview",
          className: "fa fa-eye",
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

    //LandingPage Header 1 Components

    editor.DomComponents.addType("landingpage-header-1", {
      model: {
        defaults: {
          attributes: { class: "home" },
          components: `
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
        <img src="https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.smashingmagazine.com%2F2019%2F04%2Fdesign-landing-page-mobile-conversion%2F&psig=AOvVaw2KYRMmOH0VGeq-Kb9_unVV&ust=1638533272133000&source=images&cd=vfe&ved=0CAsQjRxqFwoTCIjMj6CKxfQCFQAAAAAdAAAAABAD" alt="" />
      </div>
    </section>
      `,
          styles: `
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
      `,
        },
      },
    });

    // Create a block for the component, so we can drop it easily
    editor.Blocks.add("Landing-Page-Header-1", {
      label: "Header",
      attributes: { class: "fa fa-text" },
      content: { type: "landingpage-header-1" },
    });
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

// #block {
//   height: 100%;
// }

// #block #blocks {
//   height: 100%;
//   width: 100%;
// }

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

  // .gjs-field input, .gjs-field select, .gjs-field textarea{
  //   background-color: #272727;

  // }
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
      ::v-deep .button {
      }
    }
    .panel__basic-actions {
      display: flex;
      position: initial;
    }
  }
}
</style>