import api from "./config";

export default {
  async createInterview(payload) {
   return api.post('api/interview/store',payload)
  },

  async getInterview(interviewId){
    return api.get(`api/interview/index/${interviewId}`)
  },

  async updateScript(interviewId,text){
  return api.post(`api/interview/updatescript/${interviewId}`,text)
  }

//   async getAllContent(projectId) {
//     return api.get(`api/projects/${projectId}/leancanvas`);
//   },

//   async deleteContent(contentId, contentType) {
//     return api.delete(`api/projects/leancanvas/${contentType}/${contentId}`);
//   },

//   async updateContent(type, contentId, payload) {
//     return api.put(`api/projects/leancanvas/${type}/${contentId}`, payload);
//   },
};
