const state = {
    currentID: 0,
    customer:{
        currentEditedName:"",
        currentEditedOcc: "",
        currentEditedPhone: "",
        currentEditedEmail: "",
    }
    
  };
  
  const getters = {
    currentID: (state) => state.currentID,
    customer: (state) => state.customer,
  };
  
  const actions = {};
  
  const mutations = {
    setcurrentID(state,id){
        state.currentID = id;
    },
    setEditedName(state,name){
        state.customer.currentEditedName = name;
    },
    setEditedOcc(state,occ){
        state.customer.currentEditedOcc = occ;
    },
    setEditedPhone(state,phone){
        state.customer.currentEditedPhone = phone;
    },
    setEditedEmail(state,email){
        state.customer.currentEditedEmail = email;
    },
  };
  
  export default {
    state,
    getters,
    actions,
    mutations,
  };
  