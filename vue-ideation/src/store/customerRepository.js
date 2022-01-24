const state = {
    currentID: 0,
  };
  
  const getters = {
    currentID: (state) => state.currentID,
  };
  
  const actions = {};
  
  const mutations = {
    setcurrentID(state,id){
        state.currentID = id;
    },
  };
  
  export default {
    state,
    getters,
    actions,
    mutations,
  };
  