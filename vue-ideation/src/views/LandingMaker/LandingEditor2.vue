<template>
  <div>
    <div id="navbar" class="sidenav">
      <span id="logo">Startup Ideation System</span>
      <div class="addPage">
        <!-- <general-button> Add Page </general-button> -->
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
      <div class="panel__top">
        <div class="panel__basic-actions"></div>
      </div>
      <div class="mainNav"></div>
      <div id="editor"></div>
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
import styles from "../../components/icons/style.vue";

export default {
  components: {
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
        appendTo: "#style-view",
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
    editor;
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
          command: (e) => e.runCommand("preview"),
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

const script = function() {
  alert('hi');
  console.log('the element', this);
}
// Define a new custom component
editor.DomComponents.addType('my-input-type', {
  // Make the editor understand when to bind `my-input-type`
  isComponent: el => el.tagName === 'INPUT',
  // Model definition
  model: {
    // Default properties
    defaults: {
      script,
      tagName: 'input',
      draggable: 'form, form *', // Can be dropped only inside `form` elements
      droppable: false, // Can't drop other elements inside
      attributes: { // Default attributes
        type: 'text',
        name: 'default-name',
        placeholder: 'Insert text here',
      },
      traits: [
        'name',
        'placeholder',
        { type: 'checkbox', name: 'required' },
      ],
    }
  }
});

// Create a block for the component, so we can drop it easily
editor.Blocks.add('test-block', {
  label: 'Test block',
  attributes: { class: 'fa fa-text' },
  content: { type: 'my-input-type' },
});
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
  // z-index: 99;
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
  width: 100%;
  left: 15%;
  .panel__top {
    padding: 0;
    display: flex;
    position: initial;
    justify-content: center;
    justify-content: space-between;
    .panel__basic-actions {
      position: initial;
    }
  }
}
</style>