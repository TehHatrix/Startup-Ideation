import api from "./config";

export default {
  async checkExist(projectID) {
    return api.get(`api/survey/checkexistproject/${projectID}`);
  },

  async addSurvey(payload,projectID) {
    return api.post(`/api/survey/store/${projectID}`,payload);
  },

  async getSurveyData(projectID){
    return api.get(`/api/survey/index/${projectID}`)
  },


  async updateSeries(projectID,payload){
    return api.put(`/api/survey/updateseries/${projectID}`,payload);
  },

  async resetUpdateTodayPageView(projectID,payload){
    return api.put(`/api/survey/resetupdatetpw/${projectID}`,payload);
  },
  
  async updateCurrentDate(projectID,payload){
    return api.put(`/api/survey/updatedate/${projectID}`,payload);
  }

};
