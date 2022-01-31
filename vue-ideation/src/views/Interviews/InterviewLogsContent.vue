<template>
  <div class="interviewLogs">
    <div class="notepad">
      <div class="top"></div>
      <div class="paper" contenteditable="true" @blur="handleNotepad($event)">
        <div>
          {{ interviewLogsContent }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import customerApi from "@/api/customerApi.js";
import interviewApi from "@/api/interviewApi.js";
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
  computed: {
    ...mapGetters(["currentID", "interviewIndex"]),
  },
  methods: {
    async handleNotepad(e) {
      let textObject = {
        text: e.target.innerText,
      };
      if (this.noteType === "logs") {
        let logsUpdate = await customerApi.updateLogsCustomer(
          this.currentID,
          textObject
        );
        if (logsUpdate.data.success === false) {
          throw new Error("Could not update Customer Logs");
        } else {
          this.$emit("changeLogs", textObject);
        }
      } else if (this.noteType === "script") {
        let scriptUpdate = await interviewApi.updateScript(
          this.interviewIndex,
          textObject
        );
        if (scriptUpdate.data.success === false) {
          throw new Error("Could not update Interview Script");
        } else {
          this.$emit("changeScript", textObject);
        }
      } else {
        throw new Error("Note Type could not found!");
      }
    },
  },
  mounted() {},
};
</script>

<style lang="scss" scoped>
.notepad {
  width: 100%;
  max-width: 900px;
  box-shadow: 10px 10px 40px rgba(black, 0.15);
  border-radius: 0 0 10px 10px;
  overflow: hidden;
  margin: auto;
}

.top {
  width: 100%;
  height: 50px;
  background: #333;
  border-radius: 5px 5px 0 0;
}

.paper {
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