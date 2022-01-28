<template lang="">
    <div>
        <div v-for="(message, index) in messages" :key="index" >
            <div v-if="message.user_id === user.id"  >
                {{ message.message }} || {{ updatedMessagetime(message.created_at) }}
            </div>

            <div v-else >
                {{ message.message }} || {{ updatedMessagetime(message.created_at) }}
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters } from 'vuex'


export default {
    name: 'ChatMessage',
    props: ['messages'],
    computed: {
        ...mapGetters([
            'user'
        ]),
    },


    created() {
        // this.connect()
    },
    async mounted() {
        // this.messages = await this.getMessages()
    },
    beforeDestroy() {
        // this.disconnect()
    },

    data() {
        return {
        }
    },

    methods: {

        updatedMessagetime(timestamp) {
            let date = new Date(timestamp)
            return `${date.getDate()}/${date.getMonth() + 1}/${date.getFullYear()} -- ${date.getHours()}:${date.getMinutes()}`
            // return date.getHours();
        }

    }
}
</script>
<style lang="">
    
</style>