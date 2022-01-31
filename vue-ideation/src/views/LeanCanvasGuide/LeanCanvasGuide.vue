<template lang="">
    <div>
        <main class="c-container">
            <!-- header card section -->
            <section>
                <div class="c-header-div">
                    <span class="title">Lean Canvas</span>
                    <div class="c-header-btn-container grid grid-cols-2 gap-4">
                        <button class="general-button">
                            <font-awesome-icon icon="fa-arrow-left" size="lg"></font-awesome-icon>
                        </button>
                        <button class="general-button">
                            <font-awesome-icon icon="fa-arrow-right" size="lg" ></font-awesome-icon>
                        </button>
                    </div>

                </div>
            </section>
            <!-- progress section -->
            <section>

            </section>
            <!-- body section -->
            <section class="grid grid-cols-3 gap-3">

                <div class="col-span-2">
                    <customer-segment></customer-segment>

                </div>

                <!-- information card -->
                <div class="c-info-card">

                </div>
            </section>
        </main>
    </div>
</template>
<script>
import CustomerSegmentVue from '../../components/leanCanvas/CustomerSegment.vue'
export default {
    name: 'LeanCanvasGuide',
    components: {
        'customer-segment': CustomerSegmentVue
    },

    
}
</script>
<style lang="scss" scoped>


</style>