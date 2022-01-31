const state = {
  showToast: false,
  type: "Error",
  message: "",
};

const getters = {};

const actions = {
};

const mutations = {
  showToast(state) {
    state.showToast = true;
  },
  closeToast(state) {
    state.showToast = false;
  },
  setTypeToast(state,type){
    state.type = type;
  },
  setMessage(state,message){
    state.message = message
  },
  showTimeoutToast(state) {
    state.showToast = true
    setTimeout( () => {
      state.showToast = false
    }, 2000)
  }
};

export default {
  state,
  getters,
  actions,
  mutations,
};
