<template lang="">
    <div class="content-container">
        <div class="content-title">
            <h2>{{ typeOfContent[type-1] }}</h2>
            <button @click="showModalAddContent = true"><font-awesome-icon icon="fa-plus"></font-awesome-icon></button>
        </div>

        <div class="content-body">
            <div v-for="(content, index) in content[type-1]" :key="index" >
                <div class="notifications__item">
                    <div class="notifications__item__content">
                        <span class="notifications__item__title">{{content.topic}}</span>
                        <div v-for="(cust, index) in customerSegment" :key="index">
                            <span class="notifications__item__message" v-if="cust.id === content.customer_segment_id" >for: {{ cust.topic }}</span>
                        </div>
                    </div>
                    <div>
                        <div class="notifications__item__option edit">
                            <font-awesome-icon icon="fa-edit" size="xs" @click="openUpdateModal(content.topic, content.id)"></font-awesome-icon>
                            
                        </div>
                        <div class="notifications__item__option delete">
                            <font-awesome-icon icon="trash-alt" size="xs"  @click="deleteContent(content.id, type)"  ></font-awesome-icon>
                            
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- add content modal -->
        <modal
        :showModal="showModalAddContent"
        @close="closeAddModal" >

            <h2 class="modal-title"> {{ typeOfContent[type-1] }} </h2>
            <form @submit.prevent="addContent" >
                <div class="input-container">
                    <input class="material-input" id="topic" type="text" v-model="contentForm.topic" required>
                    <label class="material-label" for="topic" >Topic</label>
                </div>

                <div class="select input-container" v-if="type === 2 || type === 4">
                    <select id="" class="select-text" v-model="contentForm.customer_segment_id" required>
                        <option value="" disabled selected></option>
                        <option v-for="(cust, index) in customerSegment" :key="index" :value="cust.id">{{ cust.topic }}</option>
                    </select>

                    <span class="select-highlight"></span>
                    <span class="select-bar"></span>
                    <label for="" class="select-label">For Customer Segment</label>
                </div>

                <div class="select input-container" v-if="type === 5 || type === 9" >
                    <select id="" class="select-text" v-model="contentForm.customer_segment_id" required>
                        <option value="" disabled selected></option>

                        <option value="-1"  >General</option>
                        <option v-for="(cust, index) in customerSegment" :key="index" :value="cust.id" >{{ cust.topic }}</option>
                    </select>

                    <span class="select-highlight"></span>
                    <span class="select-bar"></span>
                    <label for="" class="select-label">For Customer Segment</label>
                </div>
                
                <input type="hidden" v-model="contentForm.publisher_id" >
                <input type="hidden" v-model="contentForm.contentType">
                <div>
                    <!-- <input type="submit" > -->
                    <button class="general-button">Submit</button>
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



                    <div id="btn-container">
                        <button class="general-button">Submit</button>
                    </div>
                </form>
            </div>
        </modal>


        
    </div>
</template>
<script>
import api from '@/api/leanCanvasApi'
import { mapGetters } from 'vuex'
import ProjectModal from '@/components/ProjectModal.vue'

export default {
    name: 'LeanContent',
    props: [
        'type',
        'user',
        'content'
    ],

    components: {
        'modal': ProjectModal,
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
                customer_segment_id: null,
                publisher_id: this.user.id,
                contentType: this.type,
            },

            showUpdateModal: false,
            updatedContent: {
                topic: '',
                customer_segment_id: null,
            },
            tempId: null,
            
        }
    },

    computed: {
        ...mapGetters([
            'customerSegment'
        ]),
    },

    methods: {
        async addContent() {
            try {
                if(this.contentForm.customer_segment_id === -1 ) this.contentForm.customer_segment_id = null
                let {data} = await api.addContent(this.$route.params.id, this.contentForm)
                if(data.success) {
                    await this.$store.dispatch('getContents', this.$route.params.id)
                }
                // console.log(res)
            } catch(error) {
                console.log(error)
            } finally {
                this.contentForm.topic = ''
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

        openUpdateModal(topic, id) {
            this.updatedContent.topic = topic
            this.tempId = id
            this.showUpdateModal = true


        },

        closeUpdateModal() {
            this.showUpdateModal = false

            this.updatedContent.topic = ''
        },

        closeAddModal() {
            this.showModalAddContent = false

            this.contentForm.topic = ''
            this.contentForm.customer_segment_id = null
        }
    }

}
</script>
<style lang="scss" scoped>
    
    .content-container {
        
        border-radius: 0.5rem;
        background: #fff;
        margin: 0.5rem 0.5rem;
        

        .content-title {
            background: #B983FF;
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
            color: white;
            padding: 1px 5px 1px 5px;
            display: flex;
            justify-content: space-between;
            align-items: center; 
        }

        .content-body {
            margin-top: 1rem;
            overflow: scroll;
            max-height: 18rem;
            height: 18rem;
            padding: 1px 5px 1px 5px;

        }
    }


    .notifications__item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 95%;
        margin-bottom: 1rem;
        padding: 0 20px;
        margin-left:auto;
        margin-right: auto;

        background-color: white;
        border-radius: 5px;
        border: 1px solid #B983FF;
        transition: all .3s ease-in;
    }

    .notifications__item__title,
    .notifications__item__message { display: block; }

    .notifications__item__title {
        letter-spacing: 2px;
        font-family: 'atvice', sans-serif;
        font-size: 17px;
    }

    .notifications__item__message {
        font-family: Roboto, sans-serif;
        font-size: 14px;
        color: #929292;
    }

    .notifications__item__option {
        width: 20px;
        height: 20px;
        margin: 8px 0;

        border-radius: 50%;
        color: white;
        opacity: 0;

        font-size: 1rem;
        text-align: center;
        line-height: 20px;

        cursor: pointer;
        transition: all .2s;
    }

    .notifications__item__option.edit { background-color: #3dc98c; }

    .notifications__item__option.delete { background-color: #c93d4d; }


    /*
    * Animation part
    */
    .notifications__item:hover {
    background-color: #f7f7f7;
    transform: scale( 1.05 );
    box-shadow: 0px 5px 10px 0px rgb( 0, 0, 0, .2 );
    }

    .notifications__item:hover .notifications__item__option { opacity: 1; }


    /* select starting stylings ------------------------------*/
    .select {
        position: relative;
    }

    .select-text {
        position: relative;
        font-family: inherit;
        background-color: transparent;
        width: stretch;
        padding: 10px 10px 10px 0;
        font-size: 18px;
        border-radius: 0;
        border: none;
        border-bottom: 1px solid rgba(0,0,0, 0.12);
    }

    /* Remove focus */
    .select-text:focus {
        outline: none;
        border-bottom: 1px solid rgba(0,0,0, 0);
    }

        /* Use custom arrow */
    .select .select-text {
        appearance: none;
        -webkit-appearance:none
    }

    .select:after {
        position: absolute;
        top: 18px;
        right: 10px;
        /* Styling the down arrow */
        width: 0;
        height: 0;
        padding: 0;
        content: '';
        border-left: 6px solid transparent;
        border-right: 6px solid transparent;
        border-top: 6px solid rgba(0, 0, 0, 0.12);
        pointer-events: none;
    }


    /* LABEL ======================================= */
    .select-label {
        color: rgba(0,0,0, 0.5);
        font-size: 18px;
        font-weight: normal;
        position: absolute;
        pointer-events: none;
        left: 0;
        top: 10px;
        transition: 0.2s ease all;
    }

    /* active state */
    .select-text:focus ~ .select-label, .select-text:valid ~ .select-label {
        color: #2F80ED;
        top: -20px;
        transition: 0.2s ease all;
        font-size: 14px;
    }

    /* BOTTOM BARS ================================= */
    .select-bar {
        position: relative;
        display: block;
        width: stretch;
    }

    .select-bar:before, .select-bar:after {
        content: '';
        height: 2px;
        width: 0;
        bottom: 1px;
        position: absolute;
        background: #2F80ED;
        transition: 0.2s ease all;
    }

    .select-bar:before {
        left: 50%;
    }

    .select-bar:after {
        right: 50%;
    }

    /* active state */
    .select-text:focus ~ .select-bar:before, .select-text:focus ~ .select-bar:after {
        width: 50%;
    }

    /* HIGHLIGHTER ================================== */
    .select-highlight {
        position: absolute;
        height: 60%;
        width: stretch;
        top: 25%;
        left: 0;
        pointer-events: none;
        opacity: 0.5;

    }

</style>