<template lang="">
    <div class="card-white" >
        <div class="card-title">
            <h2 class="inline-block" >{{ typeOfContent[type-1] }}</h2>
            <font-awesome-icon icon="plus-square"  class="plus-content" @click="showModalAddContent = true" />
        </div>

        <div class="card-body" >
            <!-- <p>{{content[type-1]}}</p> -->
            <div v-for="(content, index) in content[type-1]" :key="index" >
                <div class="task-topic" >
                    <p >{{ content.topic }}</p>
                    <div class="inline-block">
                        <font-awesome-icon id="edit" icon="fa-edit" @click="openUpdateModal(content.topic, content.description, content.id)"></font-awesome-icon>
                        <font-awesome-icon icon="trash-alt"  @click="deleteContent(content.id, type)" class="delete-icon" ></font-awesome-icon>
                    </div>

                </div>
            </div>

            <div>

            </div>
        </div>


        <modal
        :showModal="showModalAddContent"
        @close="showModalAddContent = false" >

            <form @submit.prevent="addContent" >
                <div class="input-container">
                    <input class="material-input" id="topic" type="text" v-model="contentForm.topic" required>
                    <label class="material-label" for="topic" >Topic</label>
                </div>
                <div class="input-container">
                    <input class="material-input" type="text" id="description"  v-model="contentForm.description" >
                    <label class="material-label" for="description" >Description</label>
                </div>
                
                <input type="hidden" v-model="contentForm.publisher_id" >
                <input type="hidden" v-model="contentForm.contentType">
                <div>
                    <!-- <input type="submit" > -->
                    <general-button>Submit</general-button>
                </div>
            </form>

        </modal>
        <!-- update content modal -->
        <modal 
         :showModal="showUpdateModal" 
         @close="showUpdateModal = false">
            <div>
                <h2 class="modal-title"> {{ typeOfContent[type-1] }} </h2>
                <form @submit.prevent="updateContent">
                    <div class="input-container">
                        <input id="topic" type="text" class="material-input"  v-model="updatedContent.topic" >
                        <label for="topic" class="material-label">Topic</label>
                    </div>

                    <div class="input-container">
                        <input id="desc" type="text" class="material-input" v-model="updatedContent.description">
                        <label for="desc" class="material-label">Description</label>
                    </div>


                    <div id="btn-container">
                        <button class="c-btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </modal>
    </div>
</template>
<script>
import ProjectModal from '@/components/ProjectModal.vue'
import api from '@/api/leanCanvasApi'
import GeneralButton from '@/components/GeneralButton.vue'

export default {
    name: 'LeanContent',
    props: [
        'type',
        'user',
        'content'
    ],

    components: {
        'modal': ProjectModal,
        'general-button': GeneralButton
    },

    data() {
        return {
            typeOfContent: [
                'Customer Segment', 
                'Problem', 
                'Revenue', 
                'Solution',
                'Unique Value Proposition',
                'Channel',
                'Key Metric',
                'Cost Structure',
                'Unfair Advantage'
            ],

            showModalAddContent: false,

            contentForm: {
                topic: '',
                description: '',
                publisher_id: this.user.id,
                contentType: this.type,
            },

            showUpdateModal: false,
            updatedContent: {
                topic: '',
                description: ''
            },
            tempId: null,
            
        }
    },

    methods: {
        async addContent() {
            try {
                let {data} = await api.addContent(this.$route.params.id, this.contentForm)
                if(data.success) {
                    await this.$store.dispatch('getContents', this.$route.params.id)
                }
                // console.log(res)
            } catch(error) {
                console.log(error)
            } finally {
                this.contentForm.topic = ''
                this.contentForm.description = ''
                this.showModalAddContent = false
            }
        },

        async deleteContent(contentId, contentType) {
            try {

                let {data} = await api.deleteContent(contentId, contentType)
                
                if(data.success) {
                    console.log(data)
                    await this.$store.dispatch('getContents', this.$route.params.id)
                    
                }
            } catch (error) {
                console.log(error)
            }
        },

        async updateContent() { 

            try {
                let {data} = await api.updateContent(this.type, this.tempId, this.updatedContent)
                if(data.success) {
                    await this.$store.dispatch('getContents', this.$route.params.id)
                    this.closeUpdateModal() 
                } else {
                    alert("not successful")
                }
            } catch (error) {
                console.log(error)
            }

        },

        openUpdateModal(topic, description, id) {
            this.updatedContent.topic = topic
            this.updatedContent.description = description
            this.tempId = id
            this.showUpdateModal = true


        },

        closeUpdateModal() {
            this.showUpdateModal = false

            this.updatedContent.topic = ''
            this.updatedContent.description = ''
        }
    }

}
</script>
<style lang="css" scoped>
    
    .card-white {
        margin: 0.5rem 0.5rem;
        padding: 0.25rem 0.75rem;
        max-height: 25rem;
        height: 20rem;
        overflow: auto;
    }

    .card-title {
        display: flex;
        align-items: center;
        justify-content: space-between;
        
    }

   

    .plus-content:hover {
        cursor: pointer;
    }

    .plus-content {
        height: 25px;
        width: 25px;
        color: #560BAD;
    }

    .task-topic {
        border:1px solid #634d9a;
        border-radius: 20px;
        padding: 0px 0.75rem;
        font-weight: 500;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.5rem;
    }

    .delete-icon {
        cursor:pointer;
    }

    #edit {
        margin-right: 1rem;
        cursor: pointer;
    }
    #btn-container {
        text-align: right;
    }
    
    
</style>