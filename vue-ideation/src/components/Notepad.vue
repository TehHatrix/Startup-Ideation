<template>
  <div>
    <div class="notepad">
      <div class="top"></div>
      <div class="paper" contenteditable="true" @input="handleInput($event)">
        {{ interviewScript }}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    passedValue: {
      type: String,
    },
  },
  data() {
    return {
      interviewScript: this.passedValue,
      passedScript: null,
    };
  },
  methods: {
    handleInput(e){
      this.passedScript = e.target.innerText;
      this.$emit("updateScript",this.passedScript)
    }
  },
};
</script>

<style lang="scss" scoped>
$paper-color: #f1ede9;
$paper-line: #94acd4;

.notepad {
  width: 80%;
  max-width: 700px;
  box-shadow: 10px 10px 40px rgba(black, 0.15);
  border-radius: 0 0 10px 10px;
  overflow: scroll;
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
    $paper-color,
    $paper-color 31px,
    $paper-line 31px,
    $paper-line 32px
  );
  font-family: "Shadows Into Light", cursive;
  line-height: 32px;
  outline: 0;
  font-size: 17px;
}
</style>