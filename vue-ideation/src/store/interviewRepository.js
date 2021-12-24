const state = {
  showModalCustomer: false,
  showModalConclude: false,
  showInterviewLogs: false,
  interviewLogsContent: "",
  interviewScript: "",
  script: false,
  customerlog: false,
  fromCustomer: false,
  interviewIndex: 0,
};

const getters = {
  interviewIndex: (state) => state.interviewIndex,
  interviewLogsContent: (state) => state.interviewLogsContent,
  interviewScript: (state) => state.interviewScript,
  script: (state) => state.script,
  customerlog: (state) => state.customerlog,
};

const actions = {};

const mutations = {
  showModalCustomer(state) {
    state.showModalCustomer = true;
  },
  closeModal(state) {
    state.showModalCustomer = false;
    state.showModalConclude = false;
    state.showInterviewLogs = false;
    state.fromCustomer = false;
  },
  fromInterviewHeader(state) {
    state.fromCustomer = false;
  },
  fromCustomerProfile(state) {
    state.fromCustomer = true;
  },
  showCustomerContent(state) {
    state.showModalCustomer = true;
    state.showModalConclude = false;
    state.showInterviewLogs = false;
  },
  showInterviewNotepad(state) {
    state.showModalCustomer = true;
    state.showModalConclude = false;
    state.showInterviewLogs = true;
  },
  showModalConclude(state) {
    state.showModalCustomer = true;
    state.showModalConclude = true;
    state.showInterviewLogs = false;
  },
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
