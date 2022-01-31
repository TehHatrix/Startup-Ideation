<template lang="">
    <div>
        <div v-for="(message, index) in chatMessages" :key="index" >

            <ul class="ul-chat" >
                <li :class=" message.user_id === user.id ? 'user-message' : '' " >
                    <div class="chat-bubble" :class=" message.user_id === user.id ? 'self-message' : 'other-message' " >
                        <div class="delete-button" @click="openDeleteModal(message.id)"  >
                            <font-awesome-icon icon="trash-alt" size="xs"></font-awesome-icon>
                        </div>
                        <div class="chat-name">
                            {{ getUsername(message.user_id) }}
                        </div>
                        <div class="chat-message">
                            <span>{{ message.message }}</span>
                            <span class="date">
                                {{ updatedMessagetime(message.created_at) }}
                            </span>
                        </div>
                    </div>
                </li>

            </ul>
        </div>


        <!-- confirm delete modal -->
        <modal 
            :showModal="showDeleteModal"
            @close="closeDeleteModal" >
            <div class="delete-modal">
                <h2>Confirm Delete</h2>
                <div class="grid grid-cols-2 gap-2">
                    <button id="cancel-btn" class="general-button" @click="closeDeleteModal">Cancel</button>
                    <button class="general-button-danger" @click="deleteMessage" >Confirm</button>
            </div>
        </div>
        </modal>
    </div>
</template>
<script>
import { mapGetters } from 'vuex'
import ProjectModalVue from '../ProjectModal.vue'
import api from '@/api/messageApi'

export default {
    name: 'ChatMessage',
    computed: {
        ...mapGetters([
            'user',
            'chatMessages',
            'collaborator'
        ]),
    },
    components: {
        'modal': ProjectModalVue
    },


    data() {
        return {
            tempId: null,

            showDeleteModal: false,
            processing: false
        }
    },

    methods: {
        updatedMessagetime(timestamp) {
            let date = new Date(timestamp)
            return `${date.getDate()}/${date.getMonth() + 1}/${date.getFullYear()} -- ${date.getHours()}:${date.getMinutes()}`
            // return date.getHours();
        },

        getUsername(id) {
            let username
            this.collaborator.forEach( (collab) => {
                if(collab.id == id) username = collab.username
            }) 
            return username
        },

        openDeleteModal(id) {
            this.tempId = id
            this.showDeleteModal = true
        },

        closeDeleteModal() {
            this.tempId = null
            this.showDeleteModal = false
        },

        async deleteMessage() {
            try {
                if(!this.processing && this.showDeleteModal) {
                    this.processing = true
                    let {data} = await api.deleteMessage(this.$route.params.id, this.tempId)
                    if(data.success) {
                        this.closeDeleteModal()
                        this.processing = false 
                    } else {
                        this.processing = false
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
    .general-button, .general-button-danger {
        width: 100%;
    }

    .ul-chat {
        list-style-type: none;
        
        li {
            width: 100%;
            display: flex;
            padding: 0 1.5rem;
        }
    }

    .user-message {
        justify-content: flex-end;
    }

    .self-message {
        background: #C0D8C0;
    }

    .other-message {
        background: #9AD0EC;
    }

    .chat-bubble {
        padding: 1rem 1rem 1rem 1rem;
        width: 25rem;
        border-radius: 1.5rem;
        margin: .5rem 0;      
        display: block;  
        position: relative;

        .chat-name {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .chat-message {
            font-size: 1rem;
            font-weight: 400;
            text-overflow: wrap;
            .date { 
                display: block;
                text-align: right;
                font-size: .8rem;
                font-weight: 500;
                color: #222021;
                
            }
        }

        .delete-button {
            top: 3%;
            right: 4%;
            position: absolute;

            background-color: #c93d4d; 
            width: 20px;
            height: 20px;
            margin: 8px 0;

            border-radius: 50%;
            color: white;

            font-size: 1rem;
            text-align: center;
            line-height: 20px;

            cursor: pointer;
            transition: all .2s;
        }

        
    }
</style>