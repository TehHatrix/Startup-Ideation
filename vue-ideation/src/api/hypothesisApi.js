import api from "./config";

export default {
  async addHypothesis(payload) {
   return api.post('api/hypothesis/store',payload)
  },
  async getinterviewbyHypothesis(hypothesisID) {
    return api.get(`api/getinterviewIDbyHypothesis/${hypothesisID}`)
   },

  async deleteHypothesis(hypothesisID){
    return api.delete(`api/hypothesis/delete/${hypothesisID}`)
  },
  async updateHypothesis(hypothesisID,payload){
    return api.put(`api/hypothesis/update/${hypothesisID}`,payload)
  },

  async setHypothesisValidated(interviewID){
    return api.put(`api/hypothesis/validate/${interviewID}`)
  },

  async checkHypothesisValidated(projectID){
    return api.get(`api/hypothesis/checkvalidate/${projectID}`)
  }
};
