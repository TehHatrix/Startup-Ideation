<template lang="">
    <div class="container">
        
        <div class="dashboard-title">
            <div class="dashboard-title-name">
                <h1>{{ project.project_name }}
                    <span>{{ project.project_description }}</span>
                </h1>
            </div>

            <div class="setting-container">
                <button class="general-button" @click="openSettingModal" >Setting</button>
            </div>
        </div>
        <section id="quick-access">
            <h2>Quick Access</h2>
            <div class="grid-cols-3 grid gap-4">

                <router-link :to="{name: 'TodoPage', params: projectId}" class="card-white"  >
                        <font-awesome-icon icon="fa-list" size="3x"></font-awesome-icon>
                        <p>To Do List</p>
                </router-link>

                <router-link :to="{name: 'LeanCanvas', params: projectId}" class="card-white">
                    <font-awesome-icon icon="fa-brain" size="3x"></font-awesome-icon>
                    <p>Lean Canvas</p>
                </router-link>

                <router-link :to="{name: 'FreeCanvas', params: projectId}" class="card-white">
                    <font-awesome-icon icon="fa-chalkboard" size="3x"></font-awesome-icon>
                    <p>Free Canvas</p>
                </router-link>

            </div>

        </section>
        <!-- announcement card  -->
        <section class="grid grid-cols-3 gap-4">
            <div class="col-span-2">
                <div class="announcement-card">
                    <div class="announcement-title">
                        <h2>Announcement</h2>
                        <div v-if="project.creator_id === user.id">
                            <button @click="showAnnounModal = true" class="general-button">Create Announcement</button>
                        </div>
                    </div>
                    <div class="announcement-body">
                        <announcement-card></announcement-card>
                    </div>
                </div>

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

                <div class="btn-container" >
                    <button @click="confirmDelete" type="button" class="c-btn-danger-outline" >Delete</button>
                    <button class="c-btn-primary" type="submit" >Update</button>
                </div>
            </form>
        </modal>

        <!-- confirm delete modal --> 
        <modal
         :showModal="showDeleteModal"
         @close="showDeleteModal = false" >
            <div class="delete-modal">
                <h2>Confirm Delete</h2>
                <div class="btn-container">
                    <button id="cancel-btn" class="c-btn-primary-outline" @click="showDeleteModal = false">Cancel</button>
                    <button class="c-btn-danger" @click="deleteProject" >Confirm</button>
                </div>
            </div>
        </modal>

        <!-- add announcement modal -->
        <modal 
         :showModal="showAnnounModal"
         @close="closeAnnounModal">
            <h2 class="modal-title" >Create Announcement</h2>
            <form @submit.prevent="addAnnouncement">
                <div class="input-container">
                    <input type="text" id="title" class="material-input" v-model="announForm.title" required>
                    <label for="title" class="material-label">Title</label>
                </div>
                <div class="input-container">
                    <input type="text" id="description" class="material-input" v-model="announForm.description" required>
                    <label for="description" class="material-label" >Description</label>
                </div>
                <div class="input-container">
                    <button class="general-button">Submit</button>
                </div>
            </form>
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
          <general-button v-if="validated" @click.native="handleResume">Resume Validating</general-button>
          <landing-form-modal v-if="validationPhase === 'landing' && landingvalidated === false" @click.native="handleValidate"></landing-form-modal>
          <pre-survey-modal v-if="validationPhase === 'survey'"></pre-survey-modal>
        </div>
      </div>
    </div>

    </div>
</template>
<script>
import ProjectModal from "@/components/ProjectModal.vue";
import { mapGetters } from "vuex";
import api from "@/api/projectApi";
import AnnouncementCardVue from "../../components/project/AnnouncementCard.vue";
import CollabCardVue from "../../components/project/CollabCard.vue";
import annApi from "@/api/communicationApi";
// import GeneralButton from "../../components/GeneralButton.vue";
import CircleCheck from "../../components/icons/circleCheck.vue";
import landingApi from "@/api/landingApi";
import LandingFormModal from "@/components/PreLandingModal.vue";
import PreSurveyModal from "@/components/PreSurveyModal.vue";
import GeneralButton from "@/components/GeneralButton.vue";

export default {
  name: "Project",
  data() {
    return {
      projectId: this.$route.params.id,

      showSettingModal: false,
      updatedProjectForm: {
        project_name: "",
        project_description: "",
      },

      showDeleteModal: false,

      showAnnounModal: false,
      announForm: {
        title: "",
        description: "",
      },
      //validationPhase
      validationPhase: "survey",
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
  },

  async created() {
    try {
      await this.$store.dispatch("getProject", this.projectId);
      // console.log(this.announcement)

      if (this.announcement === null) {
        await this.$store.dispatch("getAnnouncement", this.projectId);
      }

      //Validation Phase
      this.$store.commit("setCurrentProjectID", this.projectId);
      //Check Landing Exist based on project
      let checkExistLanding = await landingApi.checkExist(this.projectId);
      if (checkExistLanding.data === 1) {
        this.landingvalidated = true;
      }

      // console.log('after created')
    } catch (error) {
      console.log(error);
    }
  },

  computed: {
    ...mapGetters(["project", "collaborator", "user", "announcement"]),
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
    validated(){
      return this.landingvalidated || this.hypothesisvalidated || this.surveyvalidated
    }
  },

  methods: {
    handleResume() {
      this.$store.commit("setCurrentProjectID",this.projectId);
      if (this.validationPhase == "hypothesis") {
        this.$router.push("/hypothesis");
      } else if (this.validationPhase == "landing") {
          this.$router.push({ name: "LandingDashboard" });
      } else if (this.validationPhase == "survey") {
        this.$router.push({ name: "SurveyDashboard" });
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

    closeAnnounModal() {
      this.showAnnounModal = false;
      this.announForm.title = "";
      this.announForm.description = "";
    },

    async addAnnouncement() {
      try {
        let { data } = await annApi.postAnnouncement(
          this.project.id,
          this.announForm
        );
        if (data.success) {
          await this.$store.dispatch("getAnnouncement", this.project.id);
          this.closeAnnounModal();
        } else {
          alert("error");
        }
      } catch (error) {
        console.log(error);
      }
    },
  },
};
</script>
<style lang="scss" scoped>
.dashboard-title {
  display: flex;
  justify-content: space-between;
  align-items: center;

  .dashboard-title-name h1 {
    text-transform: uppercase;
    position: relative;
    letter-spacing: 0.2rem;
    padding: 0;
    margin: 0;
    font-weight: bold;
    font-size: 3rem;
    color: #080808;
    -webkit-transition: all 0.4s ease 0s;
    -o-transition: all 0.4s ease 0s;
    transition: all 0.4s ease 0s;

    span {
      font-size: 1.15rem;
      font-weight: 500;
      text-transform: uppercase;
      letter-spacing: 0.1rem;
      line-height: 3em;
      padding-left: 0.25em;
      color: rgba(0, 0, 0, 0.4);
      padding-bottom: 10px;
      display: block;
    }
  }
}

.modal-title {
  letter-spacing: 0.25rem;
}

.delete-modal {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.c-btn-danger {
  margin-right: 0.5rem;
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

#quick-access {
  margin-bottom: 2rem;
  h2 {
    letter-spacing: 0.2rem;
    font-size: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #000;
  }

  .grid {
    justify-items: center;
  }

  .grid > .card-white {
    padding: 0.5rem 0.5rem;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    height: 8rem;
    width: 10rem;
    cursor: pointer;
    font-weight: bold;
    letter-spacing: 0.2rem;
    background: white;
    color: #343a40;
    text-decoration: none;
  }
}

.announcement-card {
  box-shadow: 0 0 2rem -1rem rgba(0, 0, 0, 0.05);
  border-radius: 1rem;
  margin-bottom: 2rem;

  .announcement-title {
    background-color: #14213d;
    color: white;
    padding: 0.2rem 0.5rem;
    letter-spacing: 0.1rem;
    font-size: 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top-left-radius: 1rem;
    border-top-right-radius: 1rem;
  }

  .announcement-body {
    max-height: 25rem;
    padding-top: 2rem;
    min-height: 20rem;
    overflow: scroll;
    background-color: #e5e5e5;
    border-bottom-left-radius: 1rem;
    border-bottom-right-radius: 1rem;
  }
}

.btn-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

#cancel-btn {
  margin-right: 1rem;
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
</style>