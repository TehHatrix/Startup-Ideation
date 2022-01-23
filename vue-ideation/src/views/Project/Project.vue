<template lang="">
    <div class="container" v-if="project">
        
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
            <div class="grid-cols-4 grid gap-4">

                <router-link :to="{name: 'TodoPage', params: projectId}" class="card-white"  >
                        <font-awesome-icon icon="fa-list" size="3x"></font-awesome-icon>
                        <p>To Do List</p>
                </router-link>

                <router-link :to="{name: 'ChatPage', params: projectId}" class="card-white"  >
                        <font-awesome-icon icon="fa-comment-dots" size="3x"></font-awesome-icon>
                        <p>Project Chat</p>
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

    </div>
</template>
<script>
import ProjectModal from '@/components/ProjectModal.vue'
import { mapGetters } from 'vuex'
import api from '@/api/projectApi'
import AnnouncementCardVue from '../../components/project/AnnouncementCard.vue'
import CollabCardVue from '../../components/project/CollabCard.vue'
import annApi from '@/api/communicationApi'

export default {
    name: 'Project',
    data() {
        return {
            projectId: this.$route.params.id,

            showSettingModal: false,
            updatedProjectForm: {
                project_name: '',
                project_description: '',
            },

            showDeleteModal: false,

            showAnnounModal: false,
            announForm: {
                title: '',
                description: '',
                
            }
        }
    },

    components: {
        'modal': ProjectModal,
        'announcement-card': AnnouncementCardVue,
        'collaborator-card': CollabCardVue
    },

    async created() {
        await this.initialise()
        // this.connect()
    },

    beforeDestroy() {
        // this.disconnect()
    },

    computed: {
        ...mapGetters([
            'project',
            'collaborator',
            'user',
            'announcement'
        ])

    },

    methods: {

        connect() {
            // eslint-disable-next-line no-unused-vars
            window.Echo.private('').listen('', (e) => {

            })
        },

        disconnect() {
            window.Echo.leaveChannel('')
        },

        async initialise() {
            try {
                await this.$store.dispatch('getProject', this.projectId)
                await this.$store.dispatch('getAnnouncement', this.projectId)

            } catch (error) {   
                console.log(error)
            }
        },

        resetSettingModal() {
            this.showSettingModal = false
            this.updatedProjectForm.project_name = this.project.project_name
            this.updatedProjectForm.project_description = this.project.project_description

        },

        openSettingModal() {
            this.updatedProjectForm.project_name = this.project.project_name
            this.updatedProjectForm.project_description = this.project.project_description
            this.showSettingModal = true

        },

        confirmDelete() {
            this.showDeleteModal = true
        },

        async deleteProject() {
            try {
                let {data} = await api.deleteProject(this.projectId)
                if(data.success) {
                    this.$router.push({name: 'ProjectsList'})
                } else {
                    alert("fail")
                }
            } catch (error) {
                console.log(error)
            }
        },

        async updateProject() {
            try {
                let res = await api.updateProject(this.projectId, this.updatedProjectForm)

                if(res.data.success) {
                    await this.$store.dispatch('getProject', this.projectId)
                    // !!!! check this later thus performance gain significant
                    this.$store.dispatch('getProjects')

                    this.resetSettingModal()
                } else if(!res.data.success || res.status !== 200) {
                    // !temp
                    alert("unsuccessful")
                }
            } catch (error) {
                console.log(error)
            }
        },

        closeAnnounModal() {
            this.showAnnounModal = false
            this.announForm.title = ''
            this.announForm.description = ''
        },

        async addAnnouncement() {
            try {
                let { data } = await annApi.postAnnouncement(this.projectId, this.announForm)
                if(data.success) {
                    await this.$store.dispatch('getAnnouncement', this.projectId)
                    this.closeAnnounModal()
                } else {
                    alert('error')
                }
            } catch (error) {
                console.log(error)
            }
        },
    }
}
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
        box-shadow:0 0 2rem -1rem rgba(0,0,0,.05);
        border-radius: 1rem;
        margin-bottom: 2rem;

        .announcement-title {
            background-color: #14213d;   
            color: white;
            padding: 0.2rem 0.5rem;
            letter-spacing: .1rem;
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

</style>