<template>
  <div>
    <div id="gjs"></div>
  </div>
</template>

<script>
import "grapesjs/dist/css/grapes.min.css";
import "grapesjs-preset-webpage/src/style/main.scss";
// import "grapesjs-preset-webpage/dist/grapesjs-preset-webpage.min.css";

import grapesjs from "grapesjs";
import grapesjsWebpage from "grapesjs-preset-webpage";
// import grapesjsWebpage from "grapesjs-preset-webpage/dist/grapesjs-preset-webpage.min.js";

export default {
  mounted() {
    const editor = grapesjs.init({
      // Indicate where to init the editor. You can also pass an HTMLElement
      container: "#gjs",
      // Get the content for the canvas directly from the element
      // As an alternative we could use: `components: '<h1>Hello World Component!</h1>'`,
      fromElement: true,

      // Size of the editor
      // height: "auto",
      //   width: "100%",

      plugins: [grapesjsWebpage],
      pluginsOpts: {
        grapesjsWebpage: {
          // options
        },
      },

      storageManager: {
        id: "gjs-", // Prefix identifier that will be used inside storing and loading
        type: "local", // Type of the storage
        autosave: true, // Store data automatically
        autoload: true, // Autoload stored data on init
        stepsBeforeSave: 1, // If autosave enabled, indicates how many changes are necessary before store method is triggered
        storeComponents: true, // Enable/Disable storing of components in JSON format
        storeStyles: true, // Enable/Disable storing of rules in JSON format
        storeHtml: true, // Enable/Disable storing of components as HTML string
        storeCss: true, // Enable/Disable storing of rules as CSS string
      },
    });
    //Initialize Editor
    editor;
  },
};
</script>

<style lang="scss" scoped>
@import "grapesjs-preset-webpage/src/style/main.scss";
/* We can remove the border we've set at the beginnig */

#gjs {
  border: none;
}

.gjs-one-bg {
  background-color: #ff0000;
}
</style>