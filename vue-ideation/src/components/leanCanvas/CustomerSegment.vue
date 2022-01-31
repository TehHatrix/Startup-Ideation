<template lang="">
    <div>
        <div class="c-body-card">
            <div class="c-body-title " >
                Customer Segment
            </div>
            <div class="c-body-content">
                <div class="general-button">
                    NEW
                </div>
            </div>
        </div>

        <modal
            :showModal="showAddModal"
            @close="closeAddModal" >

            <h2>Add Customer Segment</h2>

        </modal>
    </div>
</template>
<script>
import ProjectModalVue from '../ProjectModal.vue'
// import api from '../../api/leanCanvasApi'

export default {
    name: "CustomerSegment",
    components: {
        'modal': ProjectModalVue
    },

    data() {
        return {
            showAddModal: false
        }
    },

    methods: {
        closeAddModal() {

        }
    }


    
}
</script>
<style lang="">
    
</style>