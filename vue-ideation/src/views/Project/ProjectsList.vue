<template lang="">
    <div>
      <section class=" container ">
        <div class="project-title" >
          <div>
            <h1 class="project-title-h1"  >Project List</h1>
          </div>
          <span>
            <button class="c-btn-primary" @click="showModal = true" >Add Project</button>
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
        @close="showModal = false" >
          <h2>Add New Project</h2>
          <form @submit.prevent="addProject" >
            <div>
              <div>
                <label >Project Name</label>
                <input type="text" v-model="project.project_name" required>
              </div>
              <div>
                <label for="">Project Description</label>
                <input type="text " v-model="project.project_description" required>
              </div>
            </div>

            <div>
              <button type="submit" >Submit</button>
            </div>
          </form>
        </project-modal>
      </section>
    </div>
</template>
<script>
import api from "@/api/projectApi";
import { mapGetters } from "vuex";
import ProjectModal from '@/components/ProjectModal.vue'
import ProjectCard from '@/components/ProjectCard.vue'

export default {
  name: "ProjectsList",
  components: {
    'project-modal': ProjectModal,
    'project-card': ProjectCard
  },
  data() {
    return {
      project: {
        project_name: "",
        project_description: "",
      },
      showModal: false,
    };
  },
  methods: {
    async setProject() {
      try {
        let res = await api.setProject(this.project);
        console.log(res + "from project dashboard");
      } catch (error) {
        console.log(error);
      }
    },
    async addProject() {
      try {
        let res = await api.setProject(this.project);
        if (res.data.success) {
          // alert(res.data.message)
          this.project.project_name = this.project.project_description = "";
          this.showModal = false;
          await this.$store.dispatch("getProjects");
          // this.$router.go()
        }
      } catch (error) {
        console.log(error);
      }
    },
  },
  computed: {
    ...mapGetters(["user", "projects"]),
  },
  async mounted() {
    console.log;
    try {
      await this.$store.dispatch("getProjects");
    } catch (error) {
      console.log(error);
    }
  },

  created() {
    this.$store.commit("DESTROY_PROJECT_LOCALLY");
  },
};
</script>
<style lang="">
</style>