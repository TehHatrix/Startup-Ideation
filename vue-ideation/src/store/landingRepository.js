const state = {
    previewMode: false,
    pageHTML : "",
    pageCSS : "",
    landingName: "",
    currentTemplate: "",
    templateHTML: "",
    templatePricingHTML: "",
    templateCSS: "",
    templateFooterHTML: "",
    landingRevenueGoal: 0,
};

const getters = {
    templateHTML: (state) => state.templateHTML,
    templateCSS: (state) => state.templateCSS,
    templatePricingHTML: (state) => state.templatePricingHTML,
    templateFooterHTML: (state) => state.templateFooterHTML,
    currentTemplate: (state) => state.currentTemplate,
    landingRevenueGoal: (state) => state.landingRevenueGoal,
    landingName: (state) => state.landingName,
    
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
    setLandingName(state, name){
        state.landingName = name;
    },
    setLandingRevenueGoal(state,goal){
        state.landingRevenueGoal = goal;
    },
    setcurrentTemplate(state,templatetype){
        state.currentTemplate = templatetype;
    },
    setTemplateHTML(state,html){
        state.templateHTML = html;
    },
    setTemplatePricingHTML(state,pricinghtml){
        state.templatePricingHTML = pricinghtml;
    },
    setTemplateFooterHTML(state,footerhtml){
        state.templateFooterHTML = footerhtml;
    },
    setTemplateCSS(state,css){
        state.templateCSS = css;
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