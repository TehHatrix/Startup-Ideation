<template lang="">
    <div>
        <div class="input-message-show">
            <chat-message :messages="messages" ></chat-message>
        </div>
        <div class="input-message-container ">
            <input class="input-text-chat" type="text" v-model="messageForm.message">
            <button class="btn-send" @click="postMessage" >Send</button>
        </div>
    </div>
</template>
<script>
import ChatMessageVue from './ChatMessage.vue'
import api from '@/api/messageApi'
import { mapGetters } from 'vuex'

export default {
    name: 'ChatContainer',
    components: {
        'chat-message': ChatMessageVue
    },

    computed: {
        ...mapGetters([
            'user',
        ])
    },

    created() {
        window.Echo.private(`chat.${this.$route.params.id}`)
                    // eslint-disable-next-line no-unused-vars
                    .listen('.App\\Events\\communication\\ChatUpdated', async (e) => {
                        this.messages = await this.getMessages()
                    })
    },

    beforeDestroy() {
        window.Echo.leaveChannel(`chat.${this.$route.params.id}`)
    },

    async mounted() {
        try {
            let {data} = await api.getMessages(this.$route.params.id)
            if(data.success) {
                this.messages = data.messages
            }else {
                return [];
            }
        } catch (error) {
            console.log(error)
        }
    },

    data() {
        return {
            messageForm: {
                message: null,
                user_id: null
            },
            messages: [],
        }
    },

    methods: {
        async postMessage() {
            console.log('press send')
            this.messageForm.user_id = this.user.id
            try {
                let res = await api.postMessage(this.$route.params.id, this.messageForm)
                if(res.data.success) {
                    console.log('success post message')
                } else {
                    console.log(res.data.errors)
                }
            } catch (error) {
                console.log(error)
            }
        },

        async getMessages() {
            try {
                let {data} = await api.getMessages(this.$route.params.id)
                if(data.success) {
                    return data.messages
                }else {
                    return [];
                }
            } catch (error) {
                console.log(error)
            }
        }
    },


}
</script>
<style lang="scss" scoped>
    .input-message-container {
        gap: 1rem;
        height: 10%;
        bottom: 0;
        width: 100%;
    }

        .input-message-show {
        border: 1px solid black;
        overflow: scroll;
        margin-bottom: .5rem;
        height: 30rem;
        width: 100%;
    }


    .input-text-chat {
        width: 80%;
        height: 2rem;

    }
    
    .btn-send {
        width: 20%;
        outline: none;
        
    }


</style>