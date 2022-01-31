<template lang="">
    <div v-if="!loading">
        <div class="c-container">
            <section class="page-title">
                <span v-if="canvas !== null">
                    {{ canvas.name }}
                </span>
                <span>
                    <button class="general-button-colored" @click="saveContent()" :disabled="editorContent.content === FreeCanvasContent " >Save</button>
                </span>
            </section>
            <section class="page-body">
                <div>
                    <editor class="mce-editor"
                        api-key="sycm4scmp8pngqkbaofnjb8ujisrq4trrvperlja1ml7d63c"
                        :init="{
                            height: '43rem',
                            menubar: false,

                            plugins: [
                            'advlist autolink lists link image charmap print preview anchor',
                            'searchreplace visualblocks code fullscreen',
                            'insertdatetime media table paste code help wordcount', 
                            ],
                            toolbar:
                            'undo redo | formatselect | bold italic backcolor | \
                            alignleft aligncenter alignright alignjustify | \
                            bullist numlist outdent indent | removeformat | help'
                        }"
                        :id="editorId"
                        v-model="editorContent.content"
                    />
                </div>

            </section>
        </div>
    </div>
    <div v-else>
        <loading-screen></loading-screen>
    </div>
</template>
<script>
import { mapGetters } from 'vuex'
import LoadingScreenVue from '../../components/general/LoadingScreen.vue'
import api from '@/api/freeCanvasApi'
import Editor from '@tinymce/tinymce-vue'

export default {
    name: 'EditorPage',
    components: {
        'loading-screen': LoadingScreenVue,
        'editor': Editor
    },

    async created() {
        try {
            this.connect()
            await this.$store.dispatch('showCanvas', {id: this.$route.params.id, canvasId: this.$route.params.canvasId})
            let data = await this.$store.dispatch('getFreeCanvasContent', this.$route.params.canvasId)
            if(data.success) {
                this.loading = false
            }
        } catch (error) {
            console.log(error)
        }
    },

    beforeDestroy() {
        this.disconnect()
    },
    computed: {
        ...mapGetters([
            'canvas',
            'FreeCanvasContent',
            'user',
            'collaborator'
        ]),

    },

    data() {
        return {
            currentCanvas: null,
            loading: true,
            editorId: String(this.$route.params.canvasId),
            editorContent: {
                content: ''
            },

            processing: false,
        }
        
    },

    async mounted() {
        try {
            let data = await this.$store.dispatch('getFreeCanvasContent', this.$route.params.canvasId)
            if(data.success) {
                this.editorContent.content = data.content.content
            }
        } catch (error) {
            console.log(error)
        }
    },

    methods: {
        async saveContent() {
            try {
                if(!this.processing) {
                    this.processing = true
                    let {data} = await api.updateFreeContent(this.editorId, this.editorContent)
                    if(data.success) {
                        this.$store.commit('setTypeToast', 'Success')
                        this.$store.commit('setMessage', 'Successfully Updated')
                        this.$store.commit('showTimeoutToast')
                        await this.$store.dispatch('getFreeCanvasContent', this.$route.params.canvasId)
                        this.processing = false
                    } else { 
                        this.$store.commit('setTypeToast', 'Error')
                        this.$store.commit('setMessage', 'Error update')
                        this.$store.commit('showTimeoutToast')
                        this.processing = false
                    }

                }
            } catch (error) {
                console.log(error)
            }
        },

        connect() {
            window.Echo.private(`FreeCanvas.${this.$route.params.canvasId}`)
                        .listen('FreeCanvasContentUpdated', async () => {
                            console.log('j')
                            let data = await this.$store.dispatch('getFreeCanvasContent', this.$route.params.canvasId)
                            if(data.success) {
                                this.editorContent.content = this.FreeCanvasContent
                            }
                        }) 
        },

        disconnect() {
            window.Echo.leaveChannel(`FreeCanvas.${this.$route.params.canvasId}`)
        }

    }
}
</script>
<style lang="scss" scoped>
    .page-title {
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 0 40px rgb(0 0 0 / 5%);
        margin-bottom: 2rem;
        min-height: 2rem;
        padding: 1rem 1rem;

        display: flex;
        justify-content: space-between;
        align-items: center;
        
        span {
            letter-spacing: 0.2rem;
            font-weight: bold;
            font-size: 2rem;
        }

        button {
            width: 6rem;
        }
    }

    .page-body {
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 0 40px rgb(0 0 0 / 5%);
        padding: 2rem 1rem;
        height: 49rem;
        max-height: 49rem;


    }

    .btn-container {
        margin-top: 1rem;
        text-align: right;
    }




</style>