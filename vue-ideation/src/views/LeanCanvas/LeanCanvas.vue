<template lang="">
    <div>
        <section class="container">
            <div>
                <h1 class="capitalized">{{project.project_name}}</h1>
                <h2>Lean Canvas</h2>
            </div>

            <div class="grid grid-cols-3 lean-section ">
                <div v-for="type in contentArray" :key="type" >
                    <lean-content 
                    :type="type"
                    :user="user" >

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

    data() {
        return {
            contentArray: [1, 2, 3, 4, 5, 6, 7, 8, 9],
        }
    },  

    computed: {
        ...mapGetters([
            'project',
            'user'
        ])
    }
    
}
</script>
<style scoped>



    .capitalized {
        text-transform: uppercase;
    }
</style>