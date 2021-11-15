<template lang="">
    <div class="card-white" >
        <div class="card-title">
            <h2 class="inline-block" >{{ typeOfContent[type-1] }}</h2>
            <font-awesome-icon icon="plus-square" class="plus-content" @click="showModalAddContent = true" />
        </div>


        <modal
        :showModal="showModalAddContent"
        @close="showModalAddContent = false" >

            <form @submit.prevent="addContent" >
                <div>
                    <label >Topic</label>
                    <input type="text" v-model="contentForm.topic" >
                </div>
                <div>
                    <label >Description</label>
                    <input type="text" v-model="contentForm.description">
                </div>
                
                <input type="hidden" v-model="contentForm.publisher_id" >
                <input type="hidden" v-model="contentForm.contentType">
                <div>
                    <input type="submit" >
                </div>
            </form>

        </modal>
    </div>
</template>
<script>
import ProjectModal from '@/components/ProjectModal.vue'
import api from '@/api/leanCanvasApi'

export default {
    name: 'LeanContent',
    props: [
        'type',
        'user'
    ],

    components: {
        'modal': ProjectModal
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
            }
        }
    },

    methods: {
        async addContent() {
            try {
                let res = await api.addContent(this.$route.params.id, this.contentForm)
                console.log(res)
            } catch(error) {
                console.log(error)
            } finally {
                this.contentForm.topic = ''
                this.contentForm.description = ''
                this.showModalAddContent = false
            }
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
    
    
</style>