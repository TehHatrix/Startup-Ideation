<template lang="">
    <div>
        <div class="c-body-card">
            <div class="c-body-title " >
                Customer Segment
            </div>
            <div class="c-body-content" :style="guide ? {height: '70vh' } : {height: '30rem'}">
                <div class="general-button" @click="openAddModal">
                    NEW
                </div>
                <!--!! list of customer segment  -->
                <div class="content-container">
                    <div v-for="(seg, index) in customerSegment" :key="index" class="lean-content-card">
                        <div class="lean-divider">
                            <div class="lean-topic">
                                <span>{{ seg.topic }}</span>
                                <span class="created-by">
                                    Created by: {{ getPublisherName(seg.publisher_id) }}
                                </span>
                            </div>
                            <div class="lean-btn-container grid grid-cols-2 gap-4">
                                <button class="general-button-success lean-update" @click="openUpdateModal(seg)">
                                    <font-awesome-icon icon="fa-pen-to-square" v-if="!guide"></font-awesome-icon>
                                    <span v-else>Update</span>
                                </button>
                                <button class="general-button-danger lean-delete" @click="openDeleteModal(seg.id)">
                                    <font-awesome-icon icon="fa-trash-alt"  v-if="!guide"  ></font-awesome-icon>
                                    <span v-else>Delete</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <!-- add new modal   -->
        <modal
            :showModal="showAddModal"
            @close="closeAddModal" >

            <h2 class="modal-title">Add Customer Segment</h2>
            <form @submit.prevent="addContent">
                <div class="input-container">
                    <input type="text" class="material-input" id="topic" v-model="contentForm.topic" >
                    <label for="topic" class="material-label">Content</label>
                </div>
                <div class="text-right">
                    <button class="general-button">Submit</button>
                </div>
            </form>

        </modal>
    <!-- delete confirm modal -->
        <modal
            :showModal="showDeleteModal"
            @close="closeDeleteModal" >

            <h2 class="modal-title">Confirm Delete?</h2>
            <div class="grid grid-cols-2 gap-2">
                <button class="general-button full-width" @click="closeDeleteModal">Cancel</button>
                <button class="general-button-danger full-width" @click="deleteContent">Delete</button>
            </div>                            

        </modal>
    <!-- udpate modal -->
        <modal
            :showModal="showUpdateModal"
            @close="closeUpdateModal" >

            <h2 class="modal-title">Update </h2>
            <form @submit.prevent="addContent">
                <div class="input-container">
                    <input type="text" class="material-input" id="topic" v-model="tempContent.topic" >
                    <label for="topic" class="material-label">Customer Segment</label>
                </div>
                <div class="text-right">
                    <button class="general-button" @click="updateContent">Update</button>
                </div>
            </form>

        </modal>


    </div>
</template>
<script>
import ProjectModalVue from '../ProjectModal.vue'
import api from '../../api/leanCanvasApi'
import { mapGetters } from 'vuex'

export default {
    name: "CustomerSegment",
    components: {
        'modal': ProjectModalVue
    },
    props: ['user', 'guide'],
    computed: {
        ...mapGetters([
            'customerSegment',
            'collaborator'
        ])
    },

    data() {
        return {
            type: 1,
            projectId: this.$route.params.id,
            showAddModal: false,
            contentForm: {
                topic: null,
                customer_segment_id: null,
                publisher_id: this.user.id,
                contentType: 1,
            },
            tempId: null,

            showDeleteModal: false,

            showUpdateModal: false, 
            tempContent: {
                topic: null
            },

            processing: false,
        }
    },

    created() {
    },

    destroyed() {
        this.$store.commit('closeToast')
    },

    methods: {
        connect() {
            window.Echo.private(`Project.${this.$route.params.id}`)
                        .listen('LeanCanvasUpdated', async (e) => {
                            if(e.type == this.type) {
                                let {data} = await api.getSegment(this.projectId, this.type)

                                if(data.success) {
                                    this.$store.commit('SET_CUSTOMER_SEGMENT', data.content)
                                } 
                                this.updateAllSegmentDependent()
                            }
                        })
        },

        disconnect() {
            window.Echo.leaveChannel(`Project.${this.$route.params.id}`)
        },

        async updateAllSegmentDependent() {
            this.updateSolution()
            this.updateProblem()
            this.updateUniqueValueProposition()
        },

        async updateSolution() {
            try {
                let {data} = await api.getSegment(this.projectId, 4)
                if(data.success) {
                    this.$store.commit('SET_LEAN_SOLUTION', data.content)
                }

            } catch (error) {
                console.log(error)
            }
        },

        async updateProblem() {
            try {
                let {data} = await api.getSegment(this.projectId, 2)
                if(data.success) {
                    this.$store.commit('SET_LEAN_PROBLEM', data.content)
                }

            } catch (error) {
                console.log(error)
            }
        },

        async updateUniqueValueProposition() {
            try {
                let {data} = await api.getSegment(this.projectId, 5)
                if(data.success) {
                    this.$store.commit('SET_UNIQUE_VALUE_PROPOSITION', data.content)
                }

            } catch (error) {
                console.log(error)
            }
        },

        closeAddModal() {
            this.showAddModal = false
            this.contentForm.topic = null
        },

        openAddModal() {
            this.showAddModal = true
        },

        async addContent() {
            try {
                if(!this.processing && this.showAddModal) {
                    this.processing = true
                    let {data} = await api.addContent(this.projectId, this.contentForm)
                    if(data.success) {
                        let res = await api.getSegment(this.projectId, this.type)
                        if(res.data.success) {
                            this.$store.commit('SET_CUSTOMER_SEGMENT', res.data.content)
                        }

                        this.updateAllSegmentDependent()
                        this.closeAddModal()

                        this.processing = false

                        this.$store.commit('setTypeToast', 'Success')
                        this.$store.commit('setMessage', 'Successfully Added')
                        this.$store.commit('showTimeoutToast')
                    } else {
                        this.closeAddModal()
                        this.processing = false

                        this.$store.commit('setTypeToast', 'Error')
                        this.$store.commit('setMessage', 'Attempt unsuccessful')
                        this.$store.commit('showTimeoutToast')
                    }
                }
            } catch (error) {
                console.log(error)
            }
        },

        getPublisherName(id) {
            let user = this.collaborator.find( (user) => user.id === id )
            return user != null ? user.username : 'removed collaborator' 
        },

        openDeleteModal(id) {
            this.tempId = id
            this.showDeleteModal = true
        }, 

        closeDeleteModal() {
            this.tempId = null
            this.showDeleteModal = false
        },

        async deleteContent() {
            try {
                if(!this.processing && this.showDeleteModal) {
                    this.processing = true
                    let res = await api.deleteContent(this.tempId, this.type)
                    if(res.data.success) {
                        let resAll = await api.getSegment(this.projectId, this.type)
                        if(resAll.data.success) {
                            this.$store.commit('SET_CUSTOMER_SEGMENT', resAll.data.content)
                        }
                        this.updateAllSegmentDependent()
                        this.closeDeleteModal()

                        this.processing = false
                    } else {

                        this.closeDeleteModal()
                        this.processing = false

                        this.$store.commit('setTypeToast', 'Error')
                        this.$store.commit('setMessage', 'Delete is unsuccessful')
                        this.$store.commit('showToast')
                    }
                }
            } catch (error) {
                console.log(error)
            }
        },

        openUpdateModal(segment) {
            this.tempContent.topic = segment.topic
            this.tempId = segment.id  
            this.showUpdateModal = true
        }, 

        closeUpdateModal() {
            this.tempContent.topic = null
            this.tempId = null
            this.showUpdateModal = false

        },

        async updateContent() {
            try {
                if(!this.processing && this.showUpdateModal) {
                    this.processing = true
                    let {data} = await api.updateContent(this.tempId, this.type, this.tempContent)
                    if(data.success) {
                        let resAll = await api.getSegment(this.projectId, this.type)
                        if(resAll.data.success) {
                            this.$store.commit('SET_CUSTOMER_SEGMENT', resAll.data.content)
                        }
                        this.updateAllSegmentDependent()
                        this.closeUpdateModal()
                        
                        this.processing = false
                    } else {
                        this.closeUpdateModal() 
                        this.processing = false

                        this.$store.commit('setTypeToast', 'Error')
                        this.$store.commit('setMessage', 'Update is unsuccessful')
                        this.$store.commit('showToast')
                    }
                }
            } catch (error) {
                console.log(error)
            }
        }

        

        
    }


    
}
</script>
<style lang="scss" scoped>
    .text-right {
        text-align: right;
        .general-button {
            width: 8rem;
        }
    }

    .content-container {
        padding: 0 2rem;
    }

    
</style>