<template lang="">
  <div>
    <h1>Testing page</h1>
  </div>
</template>
<script>
export default {
  name: 'Test',
  data() {
    return { 
       
    }
  },

  async created() {

      this.connected()
  },

  beforeDestroy() {
    this.disconnect()
  },

  methods: {
    connected() {
        window.Echo.private('first-try')
                    .listen('TestTry', (e) => {
                        console.log(e)
                        console.log('hello')
                    })
    },

    disconnect() {
        window.Echo.leaveChannel('first-try')
    },

    hello() {
        window.Echo.channel('hello').listen('Hello', (e) => {
            console.log(e)
            console.log(';asdlfkj')
        })
    }
  },


  
}
</script>
<style lang="">
  
</style>