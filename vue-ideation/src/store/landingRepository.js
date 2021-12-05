const state = {
    previewMode: false,
    pageHTML : "",
    pageCSS : "",
};

const getters = {
};

const actions = {
    addLandingPageCSS({commit},css){
        commit('setpageCSS',css);
    },
    addLandingPageHTML({commit},html){
        commit('setpageHTML',html);
    },
    clearLandingPageData({commit}){
        commit('clearHTMLCSS');
    }
};

const mutations = {
    setpageCSS(state, css){
        state.pageCSS = css;
    },
    setpageHTML(state,html){
        state.pageHTML = html;
    },
    setPreviewTrue(state){
        state.previewMode = true;
    },
    setPreviewFalse(state){
        state.previewMode = false;
    },
    clearHTMLCSS(state){
        state.pageHTML = "";
        state.pageCSS = "";
    }
};

export default {
    state,
    getters,
    actions,
    mutations
}