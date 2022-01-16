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
  }
};
