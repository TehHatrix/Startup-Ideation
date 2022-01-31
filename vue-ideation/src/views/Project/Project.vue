<template lang="">
  <div class="c-container" v-if="!loading">

    <!-- project card -->
    <div class="">
      <div class="project-desc-card">
        <div class="title">
          <span class="desc-name">{{ project.project_name }}</span>
          <span class="desc-description">{{ project.project_description }}</span>
        </div>
        
        <button class="general-button-colored" @click="openSettingModal">SETTING</button>
      </div>
    </div>
<!-- ??? quick accessbutton -->
    <div class="quick-access-container grid grid-cols-4 gap-2">
      <router-link :to="{name: 'TodoPage', params: projectId}" class="quick-link toolbar-container">
        To do list
        <font-awesome-icon icon="fa-list" ></font-awesome-icon>
      </router-link>

      <router-link :to="{name: 'ChatPage', params: projectId}" class="quick-link toolbar-container">
        Project Chat
        <font-awesome-icon icon="fa-comment-dots" ></font-awesome-icon>
      </router-link>

      <router-link :to="{name: 'LeanCanvas', params: projectId}" class="quick-link toolbar-container">
        Lean Canvas
        <font-awesome-icon icon="fa-brain" ></font-awesome-icon>
      </router-link>

      <router-link :to="{name: 'FreeCanvas', params: projectId}" class="quick-link toolbar-container">
        Free Canvas
        <font-awesome-icon icon="fa-chalkboard" ></font-awesome-icon>
      </router-link>
      
    </div>

    <!-- announcement card  -->
    <section class="grid grid-cols-3 gap-4">
        <div class="col-span-2">
          <announcement-card></announcement-card>
        </div>

        <div class="col-span-1 ">
            <collaborator-card></collaborator-card>
        </div>

    </section>




    <!-- setting modal  -->
    <modal
      :showModal="showSettingModal"
      @close="resetSettingModal">
        <form @submit.prevent="updateProject" >
            <h2 class="modal-title" >Update Project</h2>
            <div class="input-container" >
                <input type="text" class="material-input" id="name" v-model="updatedProjectForm.project_name" required>
                <label class="material-label" for="name">Project Name</label>
            </div>

            <div class="input-container" >
                <input type="text" class="material-input" id="description" v-model="updatedProjectForm.project_description" required>
                <label class="material-label" for="description">Project Description</label>
            </div>

            <div class="grid grid-cols-2 gap-2" >
                <button @click="confirmDelete" type="button" class="general-button-danger full-width" >Delete</button>
                <button class="general-button-colored full-width" type="submit" >Update</button>
            </div>
        </form>
    </modal>

    <!-- confirm delete modal --> 
    <modal
      :showModal="showDeleteModal"
      @close="showDeleteModal = false" >
        <div class="delete-modal">
            <h2 class="modal-title">Confirm Delete ?</h2>
            <div class="grid grid-cols-2 gap-2">
                <button class="general-button full-width" @click="showDeleteModal = false">Cancel</button>
                <button class="general-button-danger full-width" @click="deleteProject" >Confirm</button>
            </div>
        </div>
    </modal>


<!-- Validation modal -->
    <div class="validationContainer">
      <h2>Validation</h2>
      <div class="validationCard">
        <div class="cardProgress" :class="validationProgress"></div>
        <div class="cardContent">
          <p>
            <strong>{{ phaseUpperCase }} Validation</strong>
          </p>
          <p>3 {{ phaseUpperCase }} Validation to Complete</p>
        </div>
        <div class="cardFooter">
          <div class="logoCard">
            <circle-check></circle-check>
          </div>

          <p>
            <strong>Validate {{ phaseUpperCase }} Now</strong> <br />
            Complete the current validation phase to unlock new phase along the
            way.
          </p>
          <general-button v-if="validated" @click.native="handleResume()">Resume Validating</general-button>
          <landing-form-modal v-if="validationPhase === 'landing' && landingvalidated === false" @click.native="handleValidate"></landing-form-modal>
          <pre-survey-modal v-if="validationPhase === 'survey' && surveyvalidated === false"></pre-survey-modal>
        </div>
      </div>
    </div>

  </div>

  <div v-else>
    <loading-screen></loading-screen>
  </div>
</template>
<script>
import ProjectModal from "@/components/ProjectModal.vue";
import { mapGetters } from "vuex";
import api from "@/api/projectApi";
import AnnouncementCardVue from "../../components/project/AnnouncementCard.vue";
import CollabCardVue from "../../components/project/CollabCard.vue";
// import GeneralButton from "../../components/GeneralButton.vue";
import CircleCheck from "../../components/icons/circleCheck.vue";
import landingApi from "@/api/landingApi";
import LandingFormModal from "@/components/PreLandingModal.vue";
import PreSurveyModal from "@/components/PreSurveyModal.vue";
import GeneralButton from "@/components/GeneralButton.vue";
import surveyApi from "@/api/surveyApi.js";
import LoadingScreenVue from '../../components/general/LoadingScreen.vue';

export default {
  name: "Project",
  data() {
    return {
      loading: true,
      projectId: this.$route.params.id,

      showSettingModal: false,
      updatedProjectForm: {
        project_name: "",
        project_description: "",
      },

      showDeleteModal: false,
      //validationPhase
      validationPhase: "landing",
      //definedboolean
      landingvalidated: false,
      hypothesisvalidated: false,
      surveyvalidated: false,
    };
  },

  components: {
    modal: ProjectModal,
    "announcement-card": AnnouncementCardVue,
    "collaborator-card": CollabCardVue,
    GeneralButton,
    CircleCheck,
    LandingFormModal,
    PreSurveyModal,
    'loading-screen': LoadingScreenVue
  },

  async created() {
    await this.initialise();

    //Validation Phase
    this.$store.commit("setCurrentProjectID", this.projectId);

    switch (this.validationPhase) {
      case "hypothesis":
        break;
      case "landing": {
        //Check Landing Exist based on project
        let checkExistLanding = await landingApi.checkExist(this.projectId);
        if (checkExistLanding.data === 1) {
          this.landingvalidated = true;
        }
        break;
      }
      case "survey": {
        //Check Survey Exist
        let checkExistSurvey = await surveyApi.checkExist(this.projectId);
        if (checkExistSurvey.data === 1) {
          this.surveyvalidated = true;
        }
        break;
      }
    }
  },

  computed: {
    ...mapGetters(["project", "collaborator", "user"]),
    phaseUpperCase() {
      return (
        this.validationPhase.charAt(0).toUpperCase() +
        this.validationPhase.slice(1)
      );
    },
    validationProgress() {
      return {
        hypothesis: this.validationPhase == "hypothesis",
        landing: this.validationPhase == "landing",
        survey: this.validationPhase == "survey",
      };
    },
    validated() {
      return (
        this.landingvalidated ||
        this.hypothesisvalidated ||
        this.surveyvalidated
      );
    },
  },

  methods: {
    handleResume() {
      this.$store.commit("setCurrentProjectID", this.projectId);
      if (this.validationPhase == "hypothesis") {
        this.$router.push("/hypothesis");
      } else if (this.validationPhase == "landing") {
        this.$router.push({ name: "LandingDashboard" });
      } else if (this.validationPhase == "survey") {
        this.$router.push({
          name: "SurveyDashboard",
          params: { projectID: this.projectId },
        });
      }
    },

    handleValidate() {
      if (this.validationPhase == "hypothesis") {
        this.$router.push("/hypothesis");
      } else if (this.validationPhase == "landing") {
        if (this.landingvalidated === false) {
          console.log("in development");
        } else {
          this.$router.push({ name: "LandingEditor" });
        }
      } else if (this.validationPhase == "survey") {
        this.$router.push({ name: "SurveyDashboard" });
      }
    },
    resetSettingModal() {
      this.showSettingModal = false;
      this.updatedProjectForm.project_name = this.project.project_name;
      this.updatedProjectForm.project_description =
        this.project.project_description;
    },

    openSettingModal() {
      this.updatedProjectForm.project_name = this.project.project_name;
      this.updatedProjectForm.project_description =
        this.project.project_description;
      this.showSettingModal = true;
    },

    confirmDelete() {
      this.showDeleteModal = true;
    },

    connect() {
      // eslint-disable-next-line no-unused-vars
      window.Echo.private("").listen("", (e) => {});
    },

    disconnect() {
      window.Echo.leaveChannel("");
    },

    async initialise() {
      try {

        let res = await this.$store.dispatch("getProject", this.projectId);
        if(!res.data.success) {
          alert(res.data.errors)
          this.$router.push({name: 'ProjectsList'})
        }
        let annRes = await this.$store.dispatch("getAnnouncement", this.projectId);
        if(res.data.success && annRes.data.success) {
          this.loading = false
        }
      } catch (error) {
        console.log(error);
      }
    },

    async deleteProject() {
      try {
        let { data } = await api.deleteProject(this.projectId);
        if (data.success) {
          this.$router.push({ name: "ProjectsList" });
        } else {
          alert("fail");
        }
      } catch (error) {
        console.log(error);
      }
    },

    async updateProject() {
      try {
        let res = await api.updateProject(
          this.projectId,
          this.updatedProjectForm
        );

        if (res.data.success) {
          await this.$store.dispatch("getProject", this.projectId);
          // !!!! check this later thus performance gain significant
          this.$store.dispatch("getProjects");

          this.resetSettingModal();
        } else if (!res.data.success || res.status !== 200) {
          // !temp
          alert("unsuccessful");
        }
      } catch (error) {
        console.log(error);
      }
    },

   
  },

  beforeDestroy() {
    // this.disconnect()
  },
};
</script>
<style lang="scss" scoped>

.modal-title {
  letter-spacing: 0.25rem;
}


.side {
  display: flex;
  justify-content: space-between;
  align-items: center;

  h2 {
    letter-spacing: 2px;
    color: #0b090a;
  }
}



.validationCard {
  height: 200px;
  width: 100%;
  max-width: 1000px;
  position: relative;
  background: #fff;
  box-shadow: 0 5px 8px rgba(0, 0, 0, 0.16), 0 5px 8px rgba(0, 0, 0, 0.23);
  border-radius: 20px;
  transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
  &:hover {
    box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
  }
  .cardContent {
    display: flex;
    position: relative;
    justify-content: space-between;
    p {
      margin-left: 20px;
      margin-right: 20px;
    }
  }
  .cardFooter {
    position: absolute;
    border-radius: inherit;
    display: flex;
    justify-content: space-between;
    background: linear-gradient(180deg, #8843ff1c 0%, #4236f125 100%);
    position: relative;
    top: 20px;
    height: 115px;
    p {
      margin-top: 30px;
    }
    ::v-deep button {
      margin-right: 10px;
    }
    .logoCard {
      height: 60px;
      width: 60px;
      background: #ffffff;
      border-radius: 10px;
      align-self: center;
      margin-left: 10px;
      ::v-deep svg {
        height: 45px;
        width: 45px;
        text-align: center;
        margin-left: 7px;
        margin-top: 5px;
      }
    }
  }
}

.cardProgress {
  position: relative;
  display: block;
  right: 0;
  top: 0;
  left: 5px;
  width: 0%;
  border-radius: 20px;
  height: 10px;
  background: linear-gradient(180deg, #8743ff 0%, #4136f1 100%);
}

.hypothesis {
  width: 33.33%;
}

.landing {
  width: 66.66%;
}

.survey {
  width: 99.99%;
}

.cardFooter {
  position: absolute;
  border-radius: inherit;
  display: flex;
  justify-content: space-between;
  background: linear-gradient(180deg, #8843ff1c 0%, #4236f125 100%);
  position: relative;
  top: 20px;
  height: 115px;
  p {
    margin-top: 30px;
  }
  ::v-deep button {
    margin-right: 10px;
  }
  .logoCard {
    height: 60px;
    width: 60px;
    background: #ffffff;
    border-radius: 10px;
    align-self: center;
    margin-left: 10px;
    ::v-deep svg {
      height: 45px;
      width: 45px;
      text-align: center;
      margin-left: 7px;
      margin-top: 5px;
    }
  }
}

.project-desc-card {
    background: #fff;
    
    border-radius: 1rem;
    box-shadow: 0 0 40px rgb(0 0 0 / 5%);
    margin-bottom: 2rem;
    width: 100%;
    padding: 1rem 1rem;

    display: flex;
    align-items: center;
    justify-content: space-between;

    .title {
      .desc-name {
          letter-spacing: 0.2rem;
          font-weight: bold;
          font-size: 2rem;
          display: block;
  
      }
  
      .desc-description {
        font-size: 1rem;
        letter-spacing: .2rem;
        display: block;
        color: #60696b;
      }
    }

    button {
      width: 8rem;
    }

}

.quick-access-container {

    margin-bottom: 2rem;
  a {
    text-decoration: none;
  }
  
  .toolbar-container {
    background: gray;
    background: #fff;
    border-radius: 2rem;
    box-shadow: 0 0 40px rgb(0 0 0 / 5%);
    text-align: center;
    padding: .5rem 1rem;
    box-shadow: 0 0 40px rgb(0 0 0 / 5%);
    background: linear-gradient(135deg, #557c93 0%, #08203e 100%);
    
    font-size: 1rem;
    color: #fff;
    font-weight: 500;
    letter-spacing: .1rem;
    transition: all 0.3s ease 0s;
    cursor: pointer;
    
    text-decoration: none ;
    color: #fff;
    

    &:hover {
      transform: translateY(-7px) scale(105%);
      box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.212);

    }

    &:nth-child(even) {
      background: linear-gradient(135deg, #08203e 0%, #557c93 100%);
    }


  }
}
</style>