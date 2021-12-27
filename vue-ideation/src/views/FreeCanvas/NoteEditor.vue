<template lang="">
    <div class="editor" v-if="editor" >
        <menu-bar class="editor__header" :editor="editor" />
        <editor-content class="editor__content" :editor="editor" />
        <div class="editor__footer">
            <button @click="test" >Save</button>
        </div>
    </div>
</template>
<script>
import { Editor, EditorContent } from "@tiptap/vue-2";
import Starterkit from "@tiptap/starter-kit";
import MenuBar from "./MenuBar.vue";
import TaskList from "@tiptap/extension-task-list";
import TaskItem from "@tiptap/extension-task-item";
import Highlight from "@tiptap/extension-highlight";

export default {
  name: "NoteEditor",

  components: {
    EditorContent,
    MenuBar,
  },

  data() {
    return {
      editor: null,
      asyncContent: ``,
    };
  },
  created() {},

  mounted() {
    this.editor = new Editor({
      content: `<p>Start Editing here</p><br/><br/><br/><br/>`,
      extensions: [Starterkit, TaskList, TaskItem, Highlight],
    });
  },

  beforeDestroy() {
    this.editor.destroy();
  },

  methods: {
    test() {
      console.log(this.editor.getHTML());
    },
  },
};
</script>
<style lang="scss" >
.editor {
  display: flex;
  flex-direction: column;
  color: #0d0d0d;
  background-color: #fff;
  border: 3px solid #0d0d0d;
  border-radius: 0.75rem;
  &__header {
    display: flex;
    align-items: center;
    flex: 0 0 auto;
    flex-wrap: wrap;
    padding: 0.25rem;
    border-bottom: 3px solid #0d0d0d;
  }
  &__content {
    flex: 1 1 auto;
    overflow-x: hidden;
    overflow-y: auto;
    max-height: 35rem;
    height: 32rem;
    -webkit-overflow-scrolling: touch;
  }

  &__footer {
    display: flex;
    flex: 0 0 auto;
    align-items: center;
    justify-content: flex-end;
    flex-wrap: wrap;
    white-space: nowrap;
    border-top: 3px solid #0d0d0d;
    font-size: 12px;
    font-weight: 600;
    color: #0d0d0d;
    white-space: nowrap;
    padding: 0.25rem 0.75rem;

    button {
      border: none;
      border-radius: 0.4rem;
      background: #14213d;
      color: white;
      border: 1px solid #14213d;
      padding: 0.5rem 0.5rem;
      cursor: pointer;
      transition: all 0.5s ease-in 0.3s;
      width: 7rem;
      letter-spacing: 0.1rem;
      font-weight: 800;
    }
  }
}

/* Basic editor styles */
.ProseMirror {
  padding: 0.3rem 0.5rem;
  height: 30rem;
  > * + * {
    margin-top: 0.75em;
  }
  ul,
  ol {
    padding: 0 1rem;
  }
  h1,
  h2,
  h3,
  h4,
  h5,
  h6 {
    line-height: 1.1;
  }
  code {
    background-color: rgba(#616161, 0.1);
    color: #616161;
  }
  pre {
    background: #0d0d0d;
    color: #fff;
    padding: 0.75rem 1rem;
    border-radius: 0.5rem;
    code {
      color: inherit;
      padding: 0;
      background: none;
      font-size: 0.8rem;
    }
  }
  mark {
    background-color: #faf594;
  }
  img {
    max-width: 100%;
    height: auto;
  }
  hr {
    margin: 1rem 0;
  }
  blockquote {
    padding-left: 1rem;
    border-left: 2px solid rgba(#0d0d0d, 0.1);
  }
  hr {
    border: none;
    border-top: 2px solid rgba(#0d0d0d, 0.1);
    margin: 2rem 0;
  }
  ul[data-type="taskList"] {
    list-style: none;
    padding: 0;
    li {
      display: flex;
      align-items: center;
      > label {
        flex: 0 0 auto;
        margin-right: 0.5rem;
        user-select: none;
      }
      > div {
        flex: 1 1 auto;
      }
    }
  }
}
</style>