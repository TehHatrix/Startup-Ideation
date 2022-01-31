import api from "./config";

export default {
  async addLandingPage(payload, projectID) {
    return api.post(`api/landing/store/${projectID}`, payload);
  },
  async getLandingData(projectID) {
    return api.get(`api/landing/index/${projectID}`);
  },

  async updateLandingPage(payload, projectID) {
    return api.put(`api/landing/update/${projectID}`, payload);
  },

  async updateLandingGoalName(payload,projectID){
    return api.put(`api/landing/updateGoalName/${projectID}`, payload);
  },

  async deleteLandingPage(projectID) {
    return api.delete(`api/landing/delete/${projectID}`);
  },

  // async create

  async updateSeries(projectID, payload) {
    return api.put(`api/landing/updateseries/${projectID}`, payload);
  },

  async updateCurrentDate(projectID, payload) {
    return api.put(`api/landing/updatecurrentdate/${projectID}`, payload);
  },

  async updateTodayPageView(projectID, payload) {
    return api.put(`api/landing/updatetodaypageview/${projectID}`, payload);
  },
  async resetRemainderPageView(projectID) {
    return api.put(`api/landing/resetremainderpageview/${projectID}`);
  },

  async handleRevenueSignUp(projectID, payload) {
    return api.put(`api/landing/handlerevenuesignup/${projectID}`, payload);
  },

  async incrementTodayPageView(projectID) {
    return api.put(`api/landing/incrementtodaypageview/${projectID}`);
  },
  async incrementTotalPageView(projectID) {
    return api.put(`api/landing/incrementtotalpageview/${projectID}`);
  },
  async incrementRemainderPageView(projectID) {
    return api.put(`api/landing/incrementremainderpageview/${projectID}`);
  },
  async checkExist(projectID) {
    return api.get(`api/landing/checkexistproject/${projectID}`);
  },

  async setValidated(projectID){
    return api.put(`api/landing/validate/${projectID}`);
  },

  async checkValidated(projectID){
    return api.get(`api/landing/checkvalidate/${projectID}`);
  }

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
