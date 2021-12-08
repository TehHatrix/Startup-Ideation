<template lang="">
    <div>
        <section class="container">
            <div class="project-title">
                <h1 class="project-title-h1">Project dashboard</h1>
                    <!-- <button class="c-btn-primary" @click="showModal = true">Setting</button> -->
                    <div style="diplay: inline" >
                        <general-button @click.native="openCollabModal" >  Add Collaborator  </general-button>
                        <general-button @click.native="openModal" >   Setting   </general-button>

                    </div>
            </div>

            <div class="grid grid-cols-2 gap-4" >
                <!-- project description card -->
                <div class="card-white" >
                    <div v-if="project === null">loading</div>
                    <div v-else >
                        <div class="border-btm">
                            <h1 class="c-card-title">{{ project.project_name }}</h1>
                         </div>

                        <div class="grid grid-cols-2">
                            <div>
                                <h3>Description : </h3>
                                <p class="">{{ project.project_description }}</p>    
                            </div>
                            <div class="" style="text-align: right" >
                                <h3>Collaborator : </h3>
                                <div v-for="user in project.collaborator" :key="user.id" class="project-des-collab " >
                                    <span class="c-pill">
                                        {{user.name}}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- announcement card -->
                <div class="card-white" >
                    <div class="border-btm">
                        <h1 class="c-card-title">Announcement</h1>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4 " >
                <!-- todo card -->
                <div class="col-span-2 card-white ">
                    <div class="border-btm">
                        <h1 class="c-card-title">todo card</h1>
                    </div>
                    <todo-list
                    :project="project" >

                    </todo-list>
                </div>
                <!-- project chat card -->
                <div class="card-white">
                    <div class="border-btm">
                        <h1 class="c-card-title">project chat</h1>

                    </div>
                </div>
            </div>
        </section>
        <!-- setting modal   -->
        <aside>
            <project-modal
            :showModal="showModal"
            @close="resetModalValue"
            >
                <h2 class="modal-title">Update Project</h2>
                <div>
                    <form @submit.prevent="updateProject" >
                        <div class="input-container">
                            <input id="name" type="text" v-model="updatedProjectForm.project_name" class="material-input" required >
                            <label for="name" class="material-label" >Project Name</label>
                        </div>
                        <div class="input-container">
                            <input id="description" type="text" v-model="updatedProjectForm.project_description" class="material-input" required>
                            <label for="description" class="material-label">Project Description</label>
                        </div>
                        <div class="" >
                            <div v-for="(user, index) in updatedProjectForm.collaborator" :key="index" >
                                <p>{{user.name}}</p>
                            </div>
                        </div>
                        <div class="modal-btn-container">
                            <button type="button" class="c-btn-danger" @click="deleteProject" >Delete</button>
                            <general-button type="submit"  >Update</general-button>
                            <!-- <button type="submit">Update</button> -->
                        </div>
                    </form>
                </div>
            </project-modal>
        </aside>
        <!-- add collab modal  -->
        <div>
            <project-modal
            :showModal="showCollabModal"
            @close="resetCollabModal" >
                <h1 class="modal-title">Add Collaborator</h1>
                <div v-for="(user, index) in tempCollabName" :key="index" >
                    <p>{{user}}</p>
                </div>
                <div class="input-container" >
                    <input type="text" class="material-input" id="username" v-model="addCollab" >
                    <label for="username" class="material-label"  >Add Collaborator</label>
                </div>
                <div>
                    <button type="button" @click="searchUser" >Search User</button>
                </div>
                <form @submit.prevent="addCollaborator">
                    <input type="hidden" v-model="updatedCollaborator">
                    <general-button type="submit" >Submit</general-button>
                </form>
            </project-modal>
        </div>
    </div>
</template>
<script>
import { mapGetters } from 'vuex'
import api from '@/api/projectApi'
import ProjectModal from '@/components/ProjectModal.vue'
import TodoList from '@/components/TodoList.vue'
import GeneralButton from '@/components/GeneralButton.vue'

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

            updatedCollaborator: {
                collaborator: [],
                remove_collaborator: []
            },
            
            tempCollabName: [],

            addCollab: '',
            showCollabModal: false,
        }
    },

    components: {
        'project-modal': ProjectModal,
        'todo-list': TodoList,
        'general-button': GeneralButton,

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
        // this.updatedProjectForm.collaborator = this.project.collaborator
        this.project.collaborator.forEach(user => {
            this.updatedCollaborator.collaborator.push(user.id)
            this.tempCollabName.push(user.name)
        });
        
    },

    computed: {
        ...mapGetters([
            'project'
        ]),

        tempCollabNameComputed() {
            return this.tempCollabName
        },

    },

    methods: {
        resetModalValue() {
            this.showModal = false
            this.updatedProjectForm.project_name = this.project.project_name
            this.updatedProjectForm.project_description = this.project.project_description

        },

        async searchUser() {

            try {
                let {data} = await api.getUser({username: this.addCollab})
                if(data.success) {
                    this.updatedCollaborator.collaborator.push(data.user.id)
                    this.tempCollabName.push(data.user.username)
                    this.addCollab = ''
                } else {
                    alert('there is no user')
                    this.addCollab = ''
                }
            } catch (error) {
                console.log(error)
            }
        },

        openModal() {
            this.updatedProjectForm.project_name = this.project.project_name
            this.updatedProjectForm.project_description = this.project.project_description
            this.showModal = true
        },

        resetCollabModal() {
            this.showCollabModal = false
            this.addCollab = ''
        },

        openCollabModal() {

            this.showCollabModal = true
        },

        async updateProject() {
            try {
                // console.log(this.updatedProjectForm)
                let {data} = await api.updateProject(this.projectId, this.updatedProjectForm)
                if(data.success) {
                    // console.log(data)
                    await this.$store.dispatch('getProject', this.projectId)
                    await this.$store.dispatch('getProjects')
                    this.showModal = false
                }
            } catch (error) {
                console.log(error)
            }
        },

        async deleteProject() {
            // alert("confirm delete")
            try {
                let res = await api.deleteProject(this.projectId)
                if(res.data.success) {
                    this.$router.push({name: 'ProjectsList'})
                }
            } catch (error) {
                console.log(error)
            }
        },

        addCollaborator() {

        }
    }
}
</script>
<style lang="css" scoped>

    .card-white {
        margin-top: 0.75rem ;
        margin-bottom: 0.5rem;
        padding: 0.5rem 0.75rem;
        min-height: 20rem;
        max-height: 25rem;
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

    .c-card-title {
        text-transform: uppercase;
        letter-spacing: 0.25rem;
        font-size: 1.75rem;
    }

    .border-btm {
        border-bottom: 1px black solid;
    }

    .modal-title {
        text-align: center;
        letter-spacing: 0.25rem;
    }

    .modal-btn-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .project-desc-collab {
        margin-top: 2rem;
        text-align: right;
    }
    
</style>