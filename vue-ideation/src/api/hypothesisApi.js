import api from "./config";

export default {
  async addHypothesis(payload) {
   return api.post('api/hypothesis/store',payload)
  },
  async getinterviewbyHypothesis(hypothesisID) {
    return api.get(`api/getinterviewIDbyHypothesis/${hypothesisID}`)
   },

  
};
