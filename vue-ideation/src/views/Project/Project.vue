<template lang="">
    <div>
        <section class="container">
            <div class="project-title">
                <h1 class="project-title-h1">Project dashboard</h1>
                <span>
                    <button class="c-btn-primary" @click="showModal = true">Setting</button>
                </span>
            </div>

            <div class="grid grid-cols-2 gap-4" >
                <!-- project description card -->
                <div class="card-white" >
                    <div v-if="project === null">loading</div>
                    <div v-else >
                        <div class="">
                            <h1 class="">{{ project.project_name }}</h1>
                         </div>

                        <div class="">
                            <p class="">{{ project.project_description }}</p>
                            <div v-for="user in project.collaborator" :key="user.id" class="collab-pill " >
                                <span class="pill">
                                    {{user.name}}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- announcement card -->
                <div class="card-white" >
                    <div >
                        <h1 >Announcement</h1>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4 " >
                <!-- todo card -->
                <div class="col-span-2 card-white">
                    <h1>todo card</h1>
                    <todo-list
                    :project="project" >

                    </todo-list>
                </div>
                <!-- project chat card -->
                <div class="card-white">
                    <h1>project chat</h1>
                </div>
            </div>
        </section>
        <!-- setting modal   -->
        <aside>
            <project-modal
            :showModal="showModal"
            @close="showModal = false"
            >
                <h2>Update Project</h2>
                <div>
                    <form @submit.prevent="updateProject" >
                        <div>
                            <label>Project Name</label>
                            <input type="text" v-model="updatedProjectForm.project_name">
                        </div>
                        <div>
                            <label >Project Description</label>
                            <input type="text" v-model="updatedProjectForm.project_description" >
                        </div>
                        <div>
                            <button type="button" @click="deleteProject" >Delete</button>
                            <button type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </project-modal>
        </aside>
    </div>
</template>
<script>
import { mapGetters } from 'vuex'
import api from '@/api/projectApi'
import ProjectModal from '@/components/ProjectModal.vue'
import TodoList from '@/components/TodoList.vue'

export default {
    name: 'Project',
    data() {
        return {
            projectId: this.$route.params.id,
            loading: false,
            showModal: false,

            updatedProjectForm: {
                project_name: '',
                project_description: '',
            },
        }
    },

    components: {
        'project-modal': ProjectModal,
        'todo-list': TodoList
    },

    async created() {
        try {
            await this.$store.dispatch('getProject', this.projectId)
            // console.log('after created')
        } catch (error) {
            console.log(error)
        }
    },

    mounted() {
        this.updatedProjectForm.project_name = this.project.project_name
        this.updatedProjectForm.project_description = this.project.project_description
        
    },

    computed: {
        ...mapGetters([
            'project'
        ])
    },

    methods: {
        async updateProject() {
            try {
                let {data} = await api.updateProject(this.projectId, this.updatedProjectForm)
                if(data.success) {
                    await this.$store.dispatch('getProject', this.projectId)
                    await this.$store.dispatch('getProjects')
                    this.showModal = false
                }
            } catch (error) {
                console.log(error)
            }
        },

        async deleteProject() {
            try {
                let res = await api.deleteProject(this.projectId)
                if(res.data.success) {
                    this.$router.push({name: 'ProjectsList'})
                }
            } catch (error) {
                console.log(error)
            }
        }
    }
}
</script>
<style lang="css" scoped>

    .card-white {
        margin-top: 0.75rem ;
        margin-bottom: 0.5rem;
        padding: 0.5rem 0.75rem;
    }

    .project-title-h1 {
        color: rgba(31, 41, 55, var(--tw-text-opacity));
        font-size: 3em;
        letter-spacing: 1px;
        font-weight: bold;
    }

    .project-title > span {
        align-self: center;
    }

    .pill {
        background-color: beige;
        border-radius: 40%;
        padding: 0.5rem 0.5rem;
        margin-left: 0.5rem;
    }

    .collab-pill {
        display: inline-flex;
    }

    
</style>