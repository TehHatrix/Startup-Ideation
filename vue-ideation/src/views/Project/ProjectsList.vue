<template lang="">
    <div>
      <section class="mx-auto ">
        <div class="project-title">

        </div>
      </section>
    </div>
</template>
<script>
import api from "@/api/projectApi";
import { mapGetters } from "vuex";
// import ProjectModal from '@/components/ProjectModal.vue'
// import ProjectCard from '@/components/ProjectCard.vue'

export default {
  name: "ProjectsList",
  components: {
    // 'project-modal': ProjectModal,
    // 'project-card': ProjectCard
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
        let res = await api.setProject(this.project)
        console.log(res + 'from project dashboard')
      } catch (error) {
        console.log(error);
      }
    },
    async addProject() {
      try {
        let res = await api.setProject(this.project)
        if(res.data.success) {
          // alert(res.data.message)
          this.project.project_name = this.project.project_description = ''
          this.showModal = false
          await this.$store.dispatch('getProjects')
          // this.$router.go()
        }
      } catch (error) {
        console.log(error)
      }
    }
  },
  computed: {
    ...mapGetters([
      'user',
      'projects']),
  },
  async mounted() {
    console.log
    try {
      await this.$store.dispatch('getProjects')
    } catch (error) {
      console.log(error)
    }

  },

  created() {
    this.$store.commit('DESTROY_PROJECT_LOCALLY')
  }
};
</script>
<style lang="">
</style>