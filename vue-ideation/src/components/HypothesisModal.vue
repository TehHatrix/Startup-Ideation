<template>
  <div id="modal-comp">
    <general-button
      class="outerButton"
      @click.native="
        showModal = true;
        showPreInterview = true;
      "
    >
      Start Interview
    </general-button>
    <transition name="fade" appear>
      <div
        class="modal-overlay"
        v-if="showModal"
        @click="
          showModal = false;
          showPreInterview = false;
          showNotepad = false;
        "
      ></div>
    </transition>
    <transition name="slide" appear>
      <div class="modal" v-if="showModal">
        <transition name="fade" appear>
          <div class="preInterview" v-if="showPreInterview">
            <h1>Pre-Interview Form</h1>
            <slot name="hypothesisTitle"> </slot>
            <h3>Choose Learning Objectives</h3>
            <dropdown
              :optionsValue="learningObjectives"
              :passedValue="currentLearningObjectives"
              @clicked="passOption"
            ></dropdown>
            <h3>Customize Interview Script</h3>
            <general-button
              @click.native="
                showPreInterview = false;
                showNotepad = true;
              "
              >Show Notepad</general-button
            >
            <div class="footerButton">
              <general-button @click.native="showModal = false">
                Close</general-button
              >
              <general-button @click.native="routeInterview">
                Start Interview</general-button
              >
            </div>
          </div>
        </transition>
        <transition name="fade" appear>
          <div class="notepadContent" v-if="showNotepad">
            <notepad v-model="interviewScript"> </notepad>
            <general-button
              v-if="showNotepad"
              @click.native="
                showNotepad = false;
                showPreInterview = true;
              "
              >Back</general-button
            >
          </div>
        </transition>
      </div>
    </transition>
  </div>
</template>

<script>
import GeneralButton from "./GeneralButton.vue";
import Dropdown from "./GeneralDropdown.vue";
import Notepad from "./Notepad.vue";
export default {
  components: { GeneralButton, Dropdown, Notepad },
  data() {
    return {
      showModal: false,
      showNotepad: false,
      showPreInterview: false,
      learningObjectives: [
        "Does the customer care enough about this problem?",
        "Does the customer already have a solution that's good enough?",
        "Does the customer think our solution solves the right problem?",
        "Does the customer think our solution is better than existing products/services?",
      ],
      currentLearningObjectives: "",
      interviewScript:
        "1. Thanks for taking my call, I’m doing some research on [main activity related to problem]. Before we start, can you tell me a bit about yourself? \
  - Focus on learning about WHO your customer is before moving onto the problem.\
2. When was the last time you [main activity related to problem]?\
3. What’s the biggest challenge you face when [main activity related to problem]?\
  - Listen if they mention the problem you’re trying to solve.\
  - If not mentioned, then it may not be a big enough problem! Dig deeper into their biggest problem.\
4. Why is this a problem for you?\
5. How often does this happen?\
6. Have you tried to solve it? If so, what did you do?\
7. How did you discover that solution?\
8. How satisfied were you with the outcome?\
  - If unsatisfied, what does your preferred solution look like? How would this solve the problem?\
9. I’m actually exploring a solution to solve your problem. Can I contact you for feedback if we find a solution?\
10. I’m trying to understand this from more perspectives. Do you know 1 or 2 other people dealing with this problem who I can speak with?",
    };
  },
  methods: {
    routeInterview() {
      this.$emit("routeInterview");
    },
    passOption(value) {
      this.currentLearningObjectives = value
      this.$emit("clickedObjective", value);
    },
  },
  mounted () {
    this.currentLearningObjectives = this.$store.state.hypothesisRepository.hypothesis[this.$store.state.hypothesisRepository.currentIndex].learningObjectives
  },
  computed: {
    getLearningObjState() {
      return this.$store.state.hypothesisRepository.hypothesis[this.$store.state.hypothesisRepository.currentIndex].learningObjectives
    }
  },
};
</script>

<style lang = 'scss' scoped>
::v-deep .notepad {
  max-height: 600px;
  overflow: scroll;
  margin: auto;
}

.outerButton {
  margin-top: 3px;
}

.modal {
  display: grid;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 99;

  width: 100%;
  max-width: 800px;
  max-height: 750px;
  background-color: #fff;
  border-radius: 16px;
  overflow: scroll;
  padding: 25px;

  p {
    padding-top: 2px;
    padding-bottom: 3px;
  }

  .footerButton {
    margin-top: 25px;
    display: flex;
    gap: 20px;
  }
}

.notepadContent,
.preInterview {
  grid-column: 1;
  grid-row: 1;
}

.notepadContent {
  ::v-deep button {
    margin-top: 30px;
  }
}

.modal-overlay {
  position: fixed;
  top: 0;
  right: 0;
  left: 0;
  bottom: 0;
  overflow: auto;
  z-index: 99;
  /* min-height: 100%; */
  background-color: rgba(0, 0, 0, 0.3);
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}

.slide-enter-active,
.slide-leave-active {
  transition: transform 0.5s;
}

.slide-enter,
.slide-leave-to {
  transform: translateY(-50%) translateX(100vw);
}
</style>