<template lang="">
    <div class="container">
        <div class="dashboard-title">
            <h1>Project Dashboard</h1>

            <button id="setting-button" @click="openSettingModal">
                Setting   
                <font-awesome-icon icon="fa-cog" size="lg" ></font-awesome-icon>
            </button>
        </div>
        <div class="grid grid-cols-2 gap-4" >
            <section class="">
                <!-- project card -->
                <div id="project-card" class="card-white" >
                    <h2> {{project.project_name}} </h2>
                    <p> {{project.project_description}} </p>

                    <div class="collab-container ">
                        <div class="side">
                            <p>Collaborator</p>
                            <button @click="openCollabModal" ><font-awesome-icon icon="fa-user-edit"></font-awesome-icon></button>
                        </div>

                        <div class="collab-list">
                            <div v-for="(user, index) in collaborator" :key="index" >
                                <div class="block" >
                                    <div class="circle">
                                        {{user.username[0]}}
                                    </div>

                                    <div>
                                        {{user.username}}
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </section>


            <section class="col-span-1 bg-gray" >
                <!-- announcement card -->
                <div>
                    <div class="side">
                        <h2>Announcement</h2>
                        <button id="announcement-btn" class="general-button">Manage</button>
                    </div>
                    <div class="overflow-hidden">

                        <shrink-card>
                            <div class="notification" >
                                <div class="notification-item">
                                    <div class="notification-item-content">
                                        <span class="notification-item-title">
                                            something
                                        </span>
                                        <span class="notification-item-message">
                                            date i guess
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </shrink-card>

                    </div>

                </div>
            </section>
        </div>

        <section id="quick-access">
            <h2>Quick Access</h2>
            <div class="grid-cols-3 grid gap-4">

                <router-link :to="{name: 'TodoPage', params: projectId}" class="card-white"  >
                        <font-awesome-icon icon="fa-list" size="5x"></font-awesome-icon>
                        <p>To Do List</p>
                </router-link>

                <router-link :to="{name: 'LeanCanvas', params: projectId}" class="card-white">
                    <font-awesome-icon icon="fa-brain" size="5x"></font-awesome-icon>
                    <p>Lean Canvas</p>
                </router-link>

                <router-link :to="{name: 'LeanCanvas', params: projectId}" class="card-white">
                    <font-awesome-icon icon="fa-chalkboard" size="5x"></font-awesome-icon>
                    <p>Free Canvas</p>
                </router-link>
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
                <div class="del-btn-container">
                    <button class="c-btn-danger" @click="deleteProject" >Confirm</button>
                    <button class="c-btn-primary-outline" @click="showDeleteModal = false">Cancel</button>
                </div>
            </div>
        </modal>

        <!-- collaborator setting modal  -->
        <modal :showModal="showCollabSettingModal" @close="closeCollabModal">
            <div>
                <h2 class="modal-title">Collaborator Setting</h2>

                <form @submit.prevent="searchUser" class="">
                    <div class="input-container">
                        <input id="username" type="text" class="material-input" required>
                        <label class="material-label" for="username">UserName</label>
                        <p>Press "Enter" to search</p>
                    </div>

                </form>

                <div>
                    <h3>Collaborator</h3>
                </div>

                <div class="side">
                    <button class="c-btn-danger-outline">Cancel</button>
                    <button class="c-btn-primary">Save</button>
                </div>
            </div>
        </modal>

    </div>
</template>
<script>
import ProjectModal from '@/components/ProjectModal.vue'
import { mapGetters } from 'vuex'
import api from '@/api/projectApi'
import ShrinkCardVue from '../../components/ShrinkCard.vue'

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

            showCollabSettingModal: false,



        }
    },

    components: {
        'modal': ProjectModal,
        'shrink-card': ShrinkCardVue
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

        
    },

    computed: {
        ...mapGetters([
            'project',
            'collaborator'
        ])

    },

    methods: {

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

        openCollabModal() {
            this.showCollabSettingModal = true
        },

        closeCollabModal() {
            this.showCollabSettingModal = false;
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
                let {data} = await api.updateProject(this.projectId, this.updatedProjectForm)

                if(data.success) {
                    await this.$store.dispatch('getProject', this.projectId)
                    // !!!! check this later thus performance gain significant
                    this.$store.dispatch('getProjects')

                    this.resetSettingModal()
                } else {
                    // !temp
                    alert("unsuccessful")
                }
            } catch (error) {
                console.log(error)
            }
        },

        searchUser() {
            alert('test')
        }


    }
}
</script>
<style lang="scss" scoped>
    .dashboard-title {
        display: flex;
        justify-content: space-between;
        align-items: center;


        h1 {
            font-size: 3rem;
            color: #212529;
            letter-spacing: 1px;
            font-weight: bold;
        }

        #projectSetting {
            width: 3rem;
            height: 2.5rem;
            cursor: pointer;
            background-color: #fff;
            border: none;
        }

        #setting-button {
            appearance: none;
            outline: none;
            border: none;
            cursor: pointer;

            display: inline-block;
            padding: 10px 10px;
            background: linear-gradient(180deg, #8743ff 0%, #4136f1 100%);
            border-radius: 8px;
            color: #fff;
            font-size: 15px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1rem;

            box-shadow: 3px 3px rgba(0, 0, 0, 0.4);
            transition: 0.4s ease-out;
            &:hover {
                box-shadow: 6px 6px rgba(0, 0, 0, 0.6);
            }
        }
    }

    .bg-gray {
        background-color: #ced4da;
        padding: 0.25rem 1rem;
        border-radius: 0.5rem;
        max-height: 18rem;
        overflow: auto;
    }

    .modal-title {
        letter-spacing: 0.25rem;
    }

    .btn-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .delete-modal {
        display: flex;
        justify-content: space-between;
        align-items: center;

    }

    .c-btn-danger {
        margin-right: 0.5rem;
    }

    #project-card {
        background: linear-gradient(180deg, #4136f1 0%, #8743ff 100%);
        color: white;
        padding: 0.1rem 1rem;
        height: 18rem;
        h2 {
            font-size: 2rem;
            letter-spacing: 0.25rem;
            text-transform: uppercase;
        }

        p {
            letter-spacing: 0.08rem;
            font-weight: 500;
        }

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

        margin-bottom: 7rem;
        h2 {
            text-align: center;
            letter-spacing: 0.2rem;
            font-size: 2rem;
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
            height: 10rem;
            width: 15rem;
            cursor: pointer;
            font-weight: bold;
            letter-spacing: 0.2rem;

            background: linear-gradient(90deg, hsla(276, 91%, 79%, 1) 0%, hsla(254, 74%, 65%, 1) 100%);

            color: #fff;

            text-decoration: none;
        }
    }

    .collab-container {
        box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
        border-radius: 24px;
        background-color: #fff;
        color: #212529;
        padding: 0 1rem 0 1rem;

        .collab-list {
            overflow: auto;
            white-space: nowrap;
            div {
                display: inline-block;
                padding: 0.5rem 0.5rem;
            }
        }

    }


    .circle {
        color:#fff;
        background: blue;
        border-radius: 50%;
        width: 3rem;
        height: 3rem;
        text-align: center;
        text-transform: uppercase;
        font-weight: 700;
    }

    .overflow-hidden {
        height: 80%;
        
    }






    
    
</style>