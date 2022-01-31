import api from "./config";

export default {
  async checkExist(projectID) {
    return api.get(`api/survey/checkexistproject/${projectID}`);
  },

  async addSurvey(payload, projectID) {
    return api.post(`/api/survey/store/${projectID}`, payload);
  },

  async storeUserSurvey(projectID, payload) {
    return api.post(`/api/survey/storeUserSurvey/${projectID}`, payload);
  },

  async getSurveyData(projectID) {
    return api.get(`/api/survey/index/${projectID}`)
  },

  async getUserAnswer(projectID) {
    return api.get(`/api/survey/indexuseranswer/${projectID}`)
  },


  async updateGoalName(projectID, payload) {
    return api.put(`api/survey/updategoalname/${projectID}`, payload)
  },

  async updateSeries(projectID, payload) {
    return api.put(`/api/survey/updateseries/${projectID}`, payload);
  },

  async resetUpdateTodayPageView(projectID, payload) {
    return api.put(`/api/survey/resetupdatetpw/${projectID}`, payload);
  },

  async updateCurrentDate(projectID, payload) {
    return api.put(`/api/survey/updatedate/${projectID}`, payload);
  },

  async incrementRemainderPageView(projectID) {
    return api.put(`/api/survey/incrementremainderpageview/${projectID}`);
  },
  async incrementTotalPageView(projectID) {
    return api.put(`/api/survey/incrementtotalpageview/${projectID}`);
  },
  async incrementTodayPageView(projectID) {
    return api.put(`/api/survey/incrementtodaypageview/${projectID}`);
  },

  async deleteSurvey(projectID) {
    return api.delete(`api/survey/delete/${projectID}`);
  },

  async setValidated(projectID){
    return api.put(`api/survey/validate/${projectID}`);
  },

  async checkValidated(projectID){
    return api.get(`api/survey/checkvalidate/${projectID}`);
  },



};
