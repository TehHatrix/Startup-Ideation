import api from "./config";

export default {
  async addLandingPage(payload,projectID){
    return api.post(`api/landing/store/${projectID}`,payload)
  },

  async getLandingData(projectID){
    return api.get(`api/landing/index/${projectID}`)
  },
  
  async checkExist(projectID) {
    return api.get(`api/landing/checkexistproject/${projectID}`);
  },

  
  //   async addHypothesis(payload) {
  //    return api.post('api/hypothesis/store',payload)
  //   },
  //   async getinterviewbyHypothesis(hypothesisID) {
  //     return api.get(`api/getinterviewIDbyHypothesis/${hypothesisID}`)
  //    },

  //   async deleteHypothesis(hypothesisID){
  //     return api.delete(`api/hypothesis/delete/${hypothesisID}`)
  //   },
  //   async updateHypothesis(hypothesisID,payload){
  //     return api.put(`api/hypothesis/update/${hypothesisID}`,payload)
};
