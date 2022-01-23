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
            v-model="canvas"
        />

        <div class="btn-container">
            <button class="c-btn-primary">Save</button>
        </div>
    </div>
</template>
<script>
import Editor from '@tinymce/tinymce-vue'
export default {
    name: 'MCEEditor',

    components: {
        'editor': Editor,
    },

    props: ['content'],

    data() {
        return {
            canvas: this.content ? this.content : '',
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