<template lang="">
    <div v-if="!loading">
      <section class=" c-container ">
        <div class="project-title" >
          <div>
            <h1 class="project-title-h1"  >Project List</h1>
          </div>
          <span>
            <!-- <button class="c-btn-primary" @click="showModal = true" >Add Project</button> -->
            <general-button @click.native="showModal = true"  >Add Project</general-button>
          </span>
        </div>

        <div>
          <project-card
          :projects="projects" >
          </project-card>
        </div>

        <!-- project add modal  -->
        <project-modal
        :showModal="showModal"
        @close="showModal = false; project.project_name = ''; project.project_description= ''" >
          <h2 class="modal-title" >Add New Project</h2>
          <form @submit.prevent="addProject" >
            <div>
              <div class="input-container">
                <input class="material-input" type="text" v-model="project.project_name" id="name" required>
                <label class="material-label" for="name" >Project Name</label>
              </div>
              <div class="input-container" >
                <input class="material-input" id="description" type="text " v-model="project.project_description" required>
                <label class="material-label" for="description">Project Description</label>
              </div>
            </div>

            <div class="button-modal">
              <!-- <button type="submit" >Submit</button> -->
              <general-button type=submit >Submit</general-button>
            </div>
          </form>
        </project-modal>
      </section>
    </div>

    <div v-else>
      <loading-screen></loading-screen>
    </div>
</template>
<script>
import api from "@/api/projectApi";
import { mapGetters } from "vuex";
import ProjectModal from '@/components/ProjectModal.vue'
import ProjectCard from '@/components/ProjectCard.vue'
import GeneralButton from '../../components/GeneralButton.vue';
import LoadingScreenVue from '../../components/general/LoadingScreen.vue';

export default {
  name: "ProjectsList",
  components: {
    'project-modal': ProjectModal,
    'project-card': ProjectCard,
    'general-button': GeneralButton,
    'loading-screen': LoadingScreenVue
  },
  data() {
    return {
      project: {
        project_name: "",
        project_description: "",
      },
      showModal: false,

      loading: true,
      processing: false,
    };
  },
  methods: {
    async addProject() {
      try {
        if(!this.processing && this.showModal) {
          this.processing = true
          let res = await api.setProject(this.project);
          if (res.data.success) {
            this.project.project_name = this.project.project_description = "";
            let res = await this.$store.dispatch("getProjects");
            if(res.data.success) {
              this.showModal = false;
              this.processing = false

              this.$store.commit("setTypeToast", "Success");
              this.$store.commit(
                "setMessage",
                'Successfully Create Project'
              );
              this.$store.commit("showTimeoutToast");  
            } else {
              this.showModal = false;
              this.processing = false

              this.$store.commit("setTypeToast", "Error");
              this.$store.commit(
                "setMessage",
                res.data.errors
              );
              this.$store.commit("showTimeoutToast");  
            }
          }
        }
      } catch (error) {
        console.log(error);
      }
    },

    connect() {
      window.Echo.private(`ProjectList.${this.user.id}`)
                  .listen('CollaboratorAdded', async (e) => {
                    console.log(e + 'from pusher ')
                    this.loading = true
                    let res = await this.$store.dispatch('getProjects')
                    if(res.data.success) {
                      this.loading = false 
                    }
                  })
    },

    disconnect() {
      window.Echo.leaveChannel(`ProjectList.${this.user.id}`)
    }

  
  },
  computed: {
    ...mapGetters(["user", "projects"]),
  },
  async mounted() {
    try {
      let res = await this.$store.dispatch("getProjects");
      if(res.data.success) {
        this.loading = false
      }
    } catch (error) {
      console.log(error);
    }
  },

  created() {
    this.$store.commit("DESTROY_PROJECT_LOCALLY");
    this.$store.commit('SET_TASKS_NULL')
    this.$store.commit('SET_FREE_CANVAS_NULL')
    this.$store.commit('SET_FREE_CANVAS_CONTENT_NULL')
    this.$store.commit('SET_ANNOUNCEMENT_NULL')
    // this.$store.commit('RESET_CURRENT_PROJECT')

    this.connect()

  },

  beforeDestroy() {
    this.disconnect()
  }
};
</script>
<style lang="scss" scoped>
  .project-title-h1 {
    font-size: 2.5rem;
    letter-spacing: 0.2rem;
  }

  .input-container {
    position: relative;
    margin-bottom: 2rem;
  }

  .material-input {
    border: 0;
    border-bottom: 2px solid #8743ff;
    transition: .2s ease-in-out;
    box-sizing: border-box;
  }

  .material-label {
    top: 0;
    left: 0;
    right: 0;
    color: #8743ff;
    display: flex;
    align-items: center;
    position: absolute;
    font-size: 1rem;
    cursor: text;
    transition: .2s ease-in-out;
    box-sizing: border-box;
  }

  .material-input, .material-label {
    width: 100%;
    height: 3rem;
    font-size: 1rem;
  }

  .material-input:valid,
  .material-input:focus {
    border-bottom: 2px solid #4136f1;  
    outline:none;
  }

  .material-input:valid + .material-label,
  .material-input:focus + .material-label {
    color: #4136f1;
    pointer-events: none;
    font-size: .8rem;
    top: -30px;
  }

  .modal-title {
    text-align: center;
    text-transform: uppercase;
    font-size: 2rem;
  }

  .button-modal {
    text-align: right;
  }
</style>