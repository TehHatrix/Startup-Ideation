const state = {
  hypothesis: [],
  currentIndex: 0,
};

const getters = {};

const actions = {
  checkHypothesisInitialized({ commit }, index) {
    commit("checkInitialiseHypothesis", index);
  },
  setPainValue({ commit }, hypothesisObject) {
    commit("checkInitialiseHypothesis", hypothesisObject.index);
    commit("setPainFrequency", hypothesisObject);
    commit("setPainSeverity", hypothesisObject);
  },
  setFeedbackValue({ commit }, hypothesisObject) {
    commit("checkInitialiseHypothesis", hypothesisObject.index);
    commit("setFeedback", hypothesisObject);
  },
  setLearningObjectives({ commit }, learningObjectives) {
    commit("setLearningObjectives", learningObjectives);
  },
  setScripts({ commit }, interviewScript) {
    commit("setInterviewScript", interviewScript);
  },
  setGoal({commit}, goal){
    commit("setGoal", goal);
  }
};

const mutations = {
  setPainFrequency(state, { frequency, index }) {
    state.hypothesis[index].pain.frequency = frequency;
  },
  setPainSeverity(state, { severity, index }) {
    state.hypothesis[index].pain.severity = severity;
  },
  setFeedback(state, { feedback, index }) {
    state.hypothesis[index].feedbackCycle = feedback;
  },
  setLearningObjectives(state, learningObjectives) {
    state.hypothesis[state.currentIndex].learningObjectives = learningObjectives
  },
  setInterviewScript(state,interviewScript){
    state.hypothesis[state.currentIndex].script = interviewScript
  },
  setCustomerSegment(state,custSeg){
    state.hypothesis[state.currentIndex].customerSegment = custSeg
  },
  setProblems(state,prob){
    state.hypothesis[state.currentIndex].problems = prob
  },
  setGoal(state,goalValue){
    state.hypothesis[state.currentIndex].goal = goalValue
  },
  checkInitialiseHypothesis(state, index) {
    if (state.hypothesis[index] === undefined) {
      let hypothesisObject = {
        customerSegment: "",
        problems: "",
        pain: {
          frequency: "",
          severity: "",
        },
        feedbackCycle: "",
        learningObjectives: "",
        goal: 0,
        script: "",
        status: false,
      };
      state.hypothesis[index] = hypothesisObject;
    }
  },
};

export default {
  state,
  getters,
  actions,
  mutations,
};
