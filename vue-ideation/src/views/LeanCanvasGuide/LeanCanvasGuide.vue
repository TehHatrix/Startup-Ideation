<template lang="">
    <div>
        <main class="c-container">
            <!-- header card section -->
            <section>
                <div class="c-header-div">
                    <span class="title">Lean Canvas</span>
                    <div class="c-header-btn-container grid grid-cols-2 gap-4">
                        <button class="general-button" @click="currentProgress -= 1" :disabled="currentProgress <= 0 ">
                            <font-awesome-icon icon="fa-arrow-left" size="lg"></font-awesome-icon>
                        </button>
                        <button class="general-button" @click="currentProgress += 1" :disabled="currentProgress >= 8 ">
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
                    <transition name="slide-fade">
                        <customer-segment 
                            v-if="currentProgress === 0"
                            :user="user" >
                        </customer-segment>
                        <problem 
                            v-if="currentProgress === 1"
                            :user="user">

                        </problem>
                    
                    </transition>

                </div>

                <!-- information card -->
                <div class="c-info-card">

                </div>
            </section>
        </main>
    </div>
</template>
<script>
import { mapGetters } from 'vuex'
import CustomerSegmentVue from '../../components/leanCanvas/CustomerSegment.vue'
import ProblemVue from '../../components/leanCanvas/Problem.vue'
export default {
    name: 'LeanCanvasGuide',
    components: {
        'customer-segment': CustomerSegmentVue,
        'problem': ProblemVue
    },

    computed: {
        ...mapGetters([
            'user',
        ])
    },

    data() {
        return {
            test: true,
            currentProgress: 0,
        }
    },

    
}
</script>
<style lang="scss" scoped>
.slide-fade-enter-active {
  transition: all .3s ease;
  opacity: 0;
}
.slide-fade-leave-active, .slide-fade-leave-to {
  transition: all .3s ease;
  transform: translateX(-10px);
  opacity: 0;
}
.slide-fade-enter
/* .slide-fade-leave-active below version 2.1.8 */ {
  transform: translateX(10px);
  opacity: 0;
}


</style>