<template lang="">
    <div>
        <main class="c-container">
            <!-- header card section -->
            <section>
                <div class="c-header-div">
                    <span class="title">Lean Canvas</span>
                    <div class="c-header-btn-container grid grid-cols-2 gap-4">
                        <button class="c-btn-primary">
                            <font-awesome-icon icon="fa-arrow-left" size="lg"></font-awesome-icon>
                        </button>
                        <button class="c-btn-primary">
                            <font-awesome-icon icon="fa-arrow-right" size="lg" ></font-awesome-icon>
                        </button>
                    </div>

                </div>
            </section>
            <!-- body section -->
            <section class="grid grid-cols-3 gap-3">
                <!-- input form card -->
                <div class="c-body-card col-span-2">
                    <div class="c-body-title " >
                        Customer Segment
                        <button class="c-body-card-btn">new</button>
                    </div>
                    <div class="c-body-content">

                    </div>
                </div>
                <!-- information card -->
                <div class="c-info-card">

                </div>
            </section>
        </main>
    </div>
</template>
<script>
export default {
    name: 'LeanCanvasGuide',
    components: {

    },

    
}
</script>
<style lang="scss" scoped>
    
</style>