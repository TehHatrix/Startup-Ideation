<template lang="">
    <div>
        <section class="container">
            <div>
                <h1 class="capitalized project-title-h1">{{project.project_name}}</h1>
                <h2 class="text-3xl lean-canvas-title" >Lean Canvas</h2>
            </div>

            <div class="grid grid-cols-3 lean-section ">
                <div v-for="type in contentArray" :key="type" >
                    <lean-content 
                    :type="type"
                    :user="user"
                    :content="leanContent" >

                    </lean-content>
                </div>

            </div>
        </section>
    </div>
</template>
<script>
import {mapGetters} from 'vuex'
import LeanContent from '@/components/leanCanvas/LeanContent.vue'

export default {
    name: 'LeanCanvas',
    components: {
        'lean-content': LeanContent,
    },

    props: {

    },

    data() {
        return {
            contentArray: [1, 2, 3, 4, 5, 6, 7, 8, 9],
        }
    },  

    computed: {
        ...mapGetters([
            'project',
            'user',
            'leanContent'
        ])
    },

    async created() {
        try {
            await this.$store.dispatch('getContents', this.project.id)
        } catch (error) {
            console.log(error)
        }

    }
    
}
</script>
<style scoped>
    .project-title-h1 {
        font-size: 2rem;
        letter-spacing: 0.25rem;
    }

    .lean-canvas-title {
        background: linear-gradient(180deg, #4136f1 0%, #8743ff 100%);

        color: #fff;
        text-align: center;
        padding: 0.75rem 0px;
        letter-spacing: 0.25rem;
        text-transform: uppercase;
        font-weight: bold;
    }

    .capitalized {
        text-transform: uppercase;
    }


</style>