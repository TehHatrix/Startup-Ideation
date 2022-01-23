<template lang="">
    <div>
        <editor
            api-key="sycm4scmp8pngqkbaofnjb8ujisrq4trrvperlja1ml7d63c"
            :init="{
                height: 600,
                menubar: false,
                plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
                ],
                toolbar:
                'undo redo | formatselect | bold italic backcolor | \
                alignleft aligncenter alignright alignjustify | \
                bullist numlist outdent indent | removeformat | help'
            }"
            :id="editorId"
            v-model="editorContent.content"
        />

        <div class="btn-container">
            <button class="c-btn-primary" @click="saveContent">Save</button>
        </div>
    </div>
</template>
<script>
import Editor from '@tinymce/tinymce-vue'
import { mapGetters } from 'vuex'
import api from '@/api/freeCanvasApi'
export default {
    name: 'MCEEditor',

    components: {
        'editor': Editor,
    },

    computed: {
        ...mapGetters([
            'FreeCanvasContent'
        ])
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

    data() {
        return {
            editorId: String(this.$route.params.canvasId),
            editorContent: {
                content: ''
            }
        }
    },

    methods: {
        async saveContent() {
            // console.log(this.editorContent.content + this.editorId)
            try {
                let {data} = await api.updateFreeContent(this.editorId, this.editorContent)
                if(data.success) {
                    await this.$store.dispatch('getFreeCanvasContent', this.$route.params.canvasId)
                }
            } catch (error) {
                console.log(error)
            }
        }
    }

}
</script>
<style lang="scss">
    .btn-container {
        margin-top: 1rem;
        text-align: right;
    }
</style>