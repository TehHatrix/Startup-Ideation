const state = {
  interviewLogsContent: "",
  interviewScript: "",
  script: false,
  customerlog: false,
  interviewIndex: 0,
};

const getters = {
  interviewIndex: (state) => state.interviewIndex,
  interviewLogsContent: (state) => state.interviewLogsContent,
  interviewScript: (state) => state.interviewScript,
  script: (state) => state.script,
  customerlog: (state) => state.customerlog,
  modalCustomer: (state) => state.showModalCustomer,
  modalConclude: (state) => state.showModalConclude,
  modalScript: (state) => state.showInterviewLogs,
  fromCustomer: (state) => state.fromCustomer,
};

const actions = {};

const mutations = {
  setInterviewIndex(state, id) {
    state.interviewIndex = id;
  },
  setInterviewLogs(state, text) {
    state.interviewLogsContent = text;
  },
  setinterviewScript(state,text){
    state.interviewScript = text;
  },
  clearInterviewLogs(state) {
    state.interviewLogsContent = "";
  },
  setScriptTrue(state) {
    state.script = true;
  },
  setScriptFalse(state) {
    state.script = false;
  },
  setCustomerLogTrue(state) {
    state.customerlog = true;
  },
  setCustomerLogFalse(state) {
    state.customerlog = false;
  },
};

export default {
  state,
  getters,
  actions,
  mutations,
};
