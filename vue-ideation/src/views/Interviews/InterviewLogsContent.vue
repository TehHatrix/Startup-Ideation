<template>
  <div class="interviewLogs">
    <div class="notepad">
      <div class="top"></div>
      <div class="paper" contenteditable="true" @input="handleNotepad($event)">
        <div>
          {{ currentContent }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// import customerApi from "@/api/customerApi.js";
// import interviewApi from "@/api/interviewApi.js";
import { mapGetters } from "vuex";
export default {
  props: {
    interviewLogsContent: {
      type: String,
    },
    noteType: {
      type: String,
    },
  },
  data() {
    return {
      currentContent: this.interviewLogsContent,
    }
  },
  computed: {
    ...mapGetters(["currentID", "interviewIndex"]),
  },
  methods: {
    async handleNotepad(e) {
      let textObject = {
        text: e.target.innerText,
      };
      if (this.noteType === "logs") {
        this.$emit("changeLogs", textObject);
        // let logsUpdate = await customerApi.updateLogsCustomer(
        //   this.currentID,
        //   textObject
        // );
        // if (logsUpdate.data.success === false) {
        //   throw new Error("Could not update Customer Logs");
        // } else {

        // }
      } else if (this.noteType === "script") {
        this.$emit("changeScript", textObject);
      } else {
        throw new Error("Note Type could not found!");
      }
    },
  },
};
</script>

<style lang="scss" scoped>
.notepad {
  width: 100%;
  max-width: 900px;
  box-shadow: 10px 10px 40px rgba(black, 0.15);
  border-radius: 0 0 10px 10px;
  overflow: scroll;
  margin: auto;
  max-height: 650px;
}

.top {
  width: 100%;
  height: 50px;
  background: #333;
  border-radius: 5px 5px 0 0;
}

.paper {
  white-space: pre-wrap; 
  width: 100%;
  height: 100%;
  min-height: 60vh;
  padding: 35px 20px;
  background: repeating-linear-gradient(
    #f1ede9,
    #f1ede9 31px,
    #94acd4 31px,
    #94acd4 32px
  );
  font-family: "Shadows Into Light", cursive;
  line-height: 32px;
  outline: 0;
  font-size: 22px;
}
</style>