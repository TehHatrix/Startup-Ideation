<template lang="">
    <div class="card-white" >
        <div class="card-title">
            <h2 class="inline-block" >{{ typeOfContent[type-1] }}</h2>
            <font-awesome-icon icon="plus-square" class="plus-content" @click="showModalAddContent = true" />
        </div>

        <div class="card-body" >
            <!-- <p>{{content[type-1]}}</p> -->
            <div v-for="(content, index) in content[type-1]" :key="index" >
                <div class="task-topic" >
                    <p >{{ content.topic }}</p>
                    <font-awesome-icon icon="trash-alt" @click="deleteContent(content.id, type)" class="delete-icon" ></font-awesome-icon>

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

        updateContent() { 

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
        height: 20px;
        width: 20px;
        color: #560BAD;
    }

    .task-topic {
        background: #634d9a;
        border-radius: 20px;
        box-shadow: 10px 10px 10px 0px #dcd7e8;
        color: #fff;
        padding: 0px 0.75rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.5rem;
    }

    .delete-icon {
        cursor:pointer;
    }
    
    
</style>