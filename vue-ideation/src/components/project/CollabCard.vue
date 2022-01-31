<template lang="">
    <div>
        <div class="card-black">
            <div class="card-title">
                <span>Collaborator</span>
                <font-awesome-icon icon="fa-user-edit" id="setting" @click="openAddModal" ></font-awesome-icon>
            </div>
            <div class="card-body">
                
                <div class="user-list" v-for="(collab, index) in collaborator" :key="index">
                    <span>{{ collab.username }}</span>
                    <button id="collab-btn" class="general-button-danger" @click="openDeleteModal(collab.id)">
                        <font-awesome-icon icon="trash-alt" ></font-awesome-icon>
                    </button>
                </div>

                <!-- <table>
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="user-row" v-for="(collab, index) in collaborator" :key="index">
                            <td>{{ collab.username }}</td>
                            <td v-if="collab.id === project.creator_id">Owner</td>
                            <td v-else>
                                Collaborator
                                <span @click="openDeleteModal(collab.id)" v-if="user.id === project.creator_id" class="delete-button">
                                    <font-awesome-icon icon="trash-alt" size="xs"></font-awesome-icon>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table> -->
            </div>
        </div>

        <!-- user add Modal -->
        <modal
         :showModal="showAddModal"
         @close="closeAddModal">
            <h2 class="modal-title">Add Collaborator</h2>
            <form @submit.prevent="addCollab">
                <div class="input-container">
                    <input type="text" id="username" class="material-input" v-model="tempUserSearch" required>
                    <label for="username" class="material-label">Username</label>
                </div>
                <div class="text-right">
                    <button class="general-button">Add</button>

                </div>
            </form>
        </modal>

        <!-- confirm delete modal -->
        <modal 
         :showModal="showDeleteModal"
         @close="closeDeleteModal">
            <h2 class="modal-title">Confirm Remove Collaborator</h2>
            <div class="grid grid-cols-2 gap-2">
                <button @click="closeDeleteModal" class="general-button full-width">Cancel</button>
                <button @click="removeCollab" class="general-button-danger full-width">Confirm</button>
            </div>
        </modal>
    </div>
</template>
<script>
import { mapGetters } from 'vuex'
import ProjectModalVue from '../ProjectModal.vue'
import api from '@/api/projectApi'
export default {
    name: 'CollabCard',
    data() {
        return {
            showAddModal: false,
            tempUserSearch: '',
            showDeleteModal: false,

            tempUserId: '',
        }
    },
    
    components: {
        'modal': ProjectModalVue
    },

    computed: {
        ...mapGetters([
            'collaborator',
            'project',
            'user'
        ]),
    },

    methods: {
        openAddModal() {
            this.showAddModal = true

        },

        closeAddModal() {
            this.showAddModal = false
            this.tempUserSearch = ''
            this.addCollabArr = []
        },

        async addCollab() {
            try {
                let {data} = await api.addUser(this.project.id, {username: this.tempUserSearch})
                console.log(data)
                if(data.success) {
                    await this.$store.dispatch('getProject', this.project.id)
                    this.showAddModal = false
                } else {
                    alert(data.errors)
                }
            } catch(error) {
                console.log(error)
            }
        },

        openDeleteModal(id) {
            this.tempUserId = id
            this.showDeleteModal = true 
        },

        closeDeleteModal() {
            this.showDeleteModal = false
            this.tempUserId = ''
        },

        async removeCollab() {
            try {
                let { data } = await api.deleteCollab(this.project.id, {id: this.tempUserId})
                if(data.success) {
                    await this.$store.dispatch('getProject', this.project.id)
                    this.closeDeleteModal()
                }
            } catch (error) {
                console.log(error)
            }
        }

    }, 


}
</script>
<style lang="scss" scoped>
    .card-black {
        background-color: #fff;
        border-radius: 1rem;
        color: black;
        .card-title {  
            color: white;
            background: linear-gradient(180deg, #8743FF 0%, #4136F1 100%);
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
            font-size: 1.2rem;
            letter-spacing: 0.1rem;
            padding: 0.5rem 0.5rem;
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-body {
            overflow: scroll;
            height: 10rem;
            
            .user-list {
                padding: .5rem 1rem;
                border-bottom: 1px solid #000;

                display: flex;
                justify-content: space-between;
                align-items: center;

                span {
                    font-weight: 500;
                    font-size: 1.1rem;
                }

                #collab-btn {
                    padding: .3rem .5rem;
                }
            }
        }

    }


    #setting {
        cursor: pointer;
        &:hover {
            transform: scale(110%);
        }
    }
    

    .delete-button {
        opacity: 0;
        float: right;
        background: #c93d4d;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        margin: 8px 0;
        font-size: 1rem;
        text-align: center;
        line-height: 20px;
        cursor: pointer;
        transition: all .2s;
        color: white;
    }

    .btn-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .text-right > .general-button{
        width: 8rem;
    }


</style>