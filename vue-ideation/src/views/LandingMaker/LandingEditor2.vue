<template>
  <div>
    <div id="navbar" class="sidenav">
      <span id="logo">Startup Ideation System</span>
      <div class="addPage">
        <general-button> Add Page </general-button>
      </div>
      <ul class="list-group pages"></ul>
      <div class="tabs">
        <div class="wrapper">
          <input type="radio" name="slider" checked id="blocksRadio" />
          <input type="radio" name="slider" id="styles" />
          <input type="radio" name="slider" id="layers" />
          <nav>
            <label for="blocksRadio" class="blocksRadio"
              ><blocks></blocks
            ></label>
            <label for="layers" class="layers"><layers></layers></label>
            <label for="styles" class="styles"><styles></styles></label>
            <div class="slider"></div>
          </nav>
          <section>
            <div class="content content-1">
              <div id="blocks"></div>
            </div>
            <div class="content content-2">
              <div id="layer-container"></div>
            </div>
            <div class="content content-3">
              <div id="style-view"></div>
            </div>
          </section>
        </div>
      </div>
      <div></div>
    </div>

    <div class="main-content">
      <div class="mainNav">
        <div class="navActions">Device Manager</div>
      </div>
      <div id="editor"></div>
    </div>
  </div>
</template>

<script>
import "grapesjs/dist/css/grapes.min.css";
import grapesjs from "grapesjs";
import grapesjsBlocks from "grapesjs-blocks-basic";
import GeneralButton from "../../components/GeneralButton.vue";
import blocks from "../../components/icons/blocks.vue";
import Layers from "../../components/icons/layers.vue";
import styles from "../../components/icons/style.vue";

export default {
  components: {
    GeneralButton,
    blocks,
    styles,
    Layers,
  },
  mounted() {
    const editor = grapesjs.init({
      container: "#editor",
      fromElement: true,
      width: "auto",
      storageManager: false,
      plugins: [grapesjsBlocks],
      pluginsOpts: {
        grapesjsBlocks: {},
      },
      blockManager: {
        appendTo: "#blocks",
      },
      layerManager: {
        appendTo: "#layer-container",
      },
      styleManager: {
        appendTo: "#style-view",
        sectors: [
          {
            name: "Dimension",
            open: false,
            // Use built-in properties
            buildProps: ["width", "min-height", "padding"],
            // Use `properties` to define/override single property
            properties: [
              {
                // Type of the input,
                // options: integer | radio | select | color | slider | file | composite | stack
                type: "integer",
                name: "The width", // Label for the property
                property: "width", // CSS property (if buildProps contains it will be extended)
                units: ["px", "%"], // Units, available only for 'integer' types
                defaults: "auto", // Default value
                min: 0, // Min value, available only for 'integer' types
              },
            ],
          },
          {
            name: "Extra",
            open: false,
            buildProps: ["background-color", "box-shadow", "custom-prop"],
            properties: [
              {
                id: "custom-prop",
                name: "Custom Label",
                property: "font-size",
                type: "select",
                defaults: "32px",
                // List of options, available only for 'select' and 'radio'  types
                options: [
                  { value: "12px", name: "Tiny" },
                  { value: "18px", name: "Medium" },
                  { value: "32px", name: "Big" },
                ],
              },
            ],
          },
        ],
      },
      panels: {
        defaults: [{}],
      },
    });
    editor;
  },
};
</script>

<style lang="scss" scoped>
#block {
  height: 100%;
}

#block #blocks {
  height: 100%;
  width: 100%;
}

/* Theming */
::v-deep .gjs-one-bg {
  background-color: #fff;
}

::v-deep .gjs-two-color {
  color: #9ca8bb;
}

::v-deep .gjs-three-bg {
  background-color: #1e8fe1;
  color: white;
}

::v-deep .gjs-four-color,
.gjs-four-color-h:hover {
  color: #1e8fe1;
}

::v-deep .gjs-pn-panels {
  position: relative;
  display: none;
}

::v-deep .gjs-cv-canvas {
  width: 100%;
  height: 100%;
  top: 0;
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
  border: 1px solid rgba(0, 0, 0, 0.3);
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px;
  z-index: 99;
}

#logo {
  margin-top: 10px;
}

.addPage {
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
  width: 30%;
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
  left: 35%;
}
#styles:checked ~ nav .slider {
  left: 70%;
}

section .content {
  display: none;
  background: #fff;
}
#blocksRadio:checked ~ section .content-1,
#layers:checked ~ section .content-2,
#styles:checked ~ section .content-3 {
  display: block;
}

.main-content {
  position: relative;
  z-index: 100;
  width: 85%;
  left: 15%;
}
</style>