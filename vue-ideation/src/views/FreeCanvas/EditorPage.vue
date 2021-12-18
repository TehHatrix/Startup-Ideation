<template lang="">
    <div>
        <div class="container">
            <section class="page-title">
                <span v-if="canvas !== null">
                    {{ canvas.name }}
                </span>
                <span v-else>
                    Loading
                </span>
            </section>
            <section class="page-body">
                <tiptap/>
            </section>
        </div>

    </div>
</template>
<script>
import { mapGetters } from 'vuex'
import Tiptap from './NoteEditor.vue'

export default {
    name: 'EditorPage',
    components: {
        Tiptap
    },

    async created() {
        try {
            await this.$store.dispatch('showCanvas', {id: this.$route.params.id, canvasId: this.$route.params.canvasId})
        } catch (error) {
            console.log(error)
        }
    },
    computed: {
        ...mapGetters([
            'canvas'
        ]),
    },

    data() {
        return {
            currentCanvas: null,
        }
    },

    methods: {

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
            font-weight: 600;
            font-size: 1.2rem;
        }

        button {
            border: none;
            border-radius: .4rem;
            background: #14213d;
            color: white;
            border: 1px solid #14213d;
            padding: .5rem .5rem;
            cursor: pointer;
            transition: all 0.5s ease-in 0.3s;
            width: 7rem;
            letter-spacing: .1rem;
            font-weight: 800;
        }
    }

    .page-body {
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 0 40px rgb(0 0 0 / 5%);
        padding: 2rem 1rem;
        max-height: 45rem;
        overflow: scroll;
        
    }


</style>