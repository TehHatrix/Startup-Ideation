<template lang="">
    <div class="inherit">
        <div id="chat-container" class="input-message-show">
            <chat-message ></chat-message>
        </div>
        <div class="input-message-container grid grid-cols-8 gap-2">
            <input class="input-text-chat col-span-7" type="text" v-model="messageForm.message">
            <button id="send-btn" class="btn-send general-button-success col-span-1" @click="postMessage" >Send</button>
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
    data() {
        return {
            messageForm: {
                message: '',
                user_id: null
            },

            processing: false
        }
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
                        // this.messages = await this.getMessages()
                        let {data} = await this.$store.dispatch('getMessages', this.$route.params.id)
                        if(data.success) {
                            let container = this.$el.querySelector('#chat-container')
                            container.scrollTop = container.scrollHeight
                        }
                    })
    },

    beforeDestroy() {
        window.Echo.leaveChannel(`chat.${this.$route.params.id}`)
    },

    async mounted() {
        try {
            let {data} = await this.$store.dispatch('getMessages', this.$route.params.id)
            if(data.success) {
                let container = this.$el.querySelector('#chat-container')
                container.scrollTop = container.scrollHeight
            }


        } catch (error) {
            console.log(error)
        }
    },

    methods: {
        async postMessage() {
            this.messageForm.user_id = this.user.id
            try {
                if(!this.processing && this.messageForm.message !== '') {
                    this.processing = true
                    let res = await api.postMessage(this.$route.params.id, this.messageForm)
                    if(res.data.success) {
                        this.messageForm.message = ''
                        this.processing = false 
                    } else {
                        this.$store.commit('setTypeToast', 'Error')
                        this.$store.commit('setMessage', 'message not send ')
                        this.$store.commit('showTimeoutToast')
                        this.processing = false 
                    }
                }
            } catch (error) {
                console.log(error)
            }
        },
    },


}
</script>
<style lang="scss" scoped>

    .inherit {
        height: inherit;
    }

    .input-message-show {
        border: 1px solid black;
        overflow: scroll;
        margin-bottom: .5rem;
        border-radius: 1rem;
        height: 80%;
        width: 100%;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='160' height='160' viewBox='0 0 200 200'%3E%3Cpolygon fill='%23DCEFFA' points='100 0 0 100 100 100 100 200 200 100 200 0'/%3E%3C/svg%3E");
    }

    .input-message-container {
        gap: 1rem;
        height: 10%;
        bottom: 0;
        width: 100%;  
    }

    .input-text-chat {        
        /* optional CSS */
        border: 1px solid #222021;
        outline: 0;
        background: white;
        border-radius: 20px;
        font-weight: 500;
        font-size: 1.5rem;
        color: #343434;
        height: 3.5rem;
        margin: auto;
        width: 100%;
        padding: 0 .5rem 0 .5rem;
    }
    

    #chat-container {
        scroll-behavior: smooth;
    }

    #send-btn {
        width: 100%;
        margin: auto;
        height: 3rem;
    }


</style>