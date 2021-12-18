const state = {
    showModalCustomer: false,
    showModalConclude: false,
    showInterviewLogs: false,
    interviewLogsContent: "",
    fromCustomer: true,
  };
  
  const getters = {};
  
  const actions = {

  };
  
  const mutations = {
    showModalCustomer(state) {
        state.showModalCustomer = true;
      },
    closeModal(state){
        state.showModalCustomer = false;
        state.showModalConclude = false;
        state.showInterviewLogs = false;
        state.fromCustomer = false;
    },
    fromInterviewHeader(state){
      state.fromCustomer = false;
    },
    fromCustomerProfile(state){
      state.fromCustomer = true;
    },
    showCustomerContent(state){
        state.showModalCustomer = true;
        state.showModalConclude = false;
        state.showInterviewLogs = false;
    },
    showInterviewNotepad(state){
        state.showModalCustomer = true;
        state.showModalConclude = false;
        state.showInterviewLogs = true;
    },
    showModalConclude(state){
      state.showModalCustomer = true;
      state.showModalConclude = true;
      state.showInterviewLogs = false;
    },
    
  }

  export default {
    state,
    getters,
    actions,
    mutations,
  };
  