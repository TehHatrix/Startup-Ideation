const state = {
  showToast: false,
  type: "Error",
  message: "Your hypothesis is too mild!",
};

const getters = {};

const actions = {
  //   checkHypothesisInitialized({ commit }, index) {
  //     commit("checkInitialiseHypothesis", index);
  //   },
};

const mutations = {
  showToast(state) {
    state.showToast = true;
  },
  closeToast(state) {
    state.showToast = false;
  },
};

export default {
  state,
  getters,
  actions,
  mutations,
};
