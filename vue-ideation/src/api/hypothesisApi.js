import api from "./config";

export default {
  async addHypothesis(payload) {
   return api.post('api/hypothesis/store',payload)
    // return api.post(`api/projects/${projectId}/leancanvas`, payload);
  },

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
