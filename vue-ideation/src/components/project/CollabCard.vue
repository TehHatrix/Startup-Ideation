<template lang="">
    <div>
        <div class="card-black">
            <div class="card-title">
                <span>Collaborator</span>
                <font-awesome-icon icon="fa-user-edit" id="setting" @click="openAddModal" ></font-awesome-icon>
            </div>
            <div class="card-body">
                <table>
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="user-row" v-for="(collab, index) in collaborator" :key="index">
                            <td>{{ collab.username }}</td>
                            <td>{{ collab.name }}</td>
                            <td v-if="collab.id === project.creator_id">Owner</td>
                            <td v-else>
                                Collaborator
                                <span @click="openDeleteModal(collab.id)" v-if="user.id === project.creator_id" class="delete-button">
                                    <font-awesome-icon icon="trash-alt" size="xs"></font-awesome-icon>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- user add Modal -->
        <modal
         :showModal="showAddModal"
         @close="closeAddModal">
            <h2>Add Collaborator</h2>
            <form @submit.prevent="addCollab">
                <div class="input-container">
                    <input type="text" id="username" class="material-input" v-model="tempUserSearch" required>
                    <label for="username" class="material-label">Username</label>
                </div>
                <div class="input-container">
                    <button class="c-btn-primary">Add</button>

                </div>
            </form>
        </modal>

        <!-- confirm delete modal -->
        <modal 
         :showModal="showDeleteModal"
         @close="closeDeleteModal">
            <h2>Confirm Delete</h2>
            <div >
                <button @click="removeCollab" class="c-btn-danger">Confirm</button>
                <button @click="closeDeleteModal" class="c-btn-primary-outline">Cancel</button>
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
        background-color: #14121f;
        border-radius: 1rem;
        color: white;
        .card-title {  
            color: white;
            font-size: 1.25rem;
            letter-spacing: 0.1rem;
            padding: 0.75rem 0.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-body {
            overflow: scroll;
            max-height: 20rem;
            min-height: 20rem;
        }
    }

    table {
        width: 100%;
        table-layout: fixed;
        border-collapse: collapse;
    }

    td, tr, th {
        padding: 0.75rem 0.75rem;
        padding-bottom: 0.3rem;
        border-bottom: 1px solid white;
    }

    .user-row:hover {
        transform: scale(0.95);
        transition: all .3s ease-in;


        &:hover .delete-button {
            opacity: 1;
            
        }
    }

    #setting {
        cursor: pointer;
    }
    
    .tip {
        color: rgb(0, 0, 0, 0.6);
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
    }

    .btn-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }


</style>