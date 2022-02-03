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
                        <button class="general-button" @click="nextProgress" :disabled="currentProgress >= 8 ">
                            <font-awesome-icon icon="fa-arrow-right" size="lg" ></font-awesome-icon>
                        </button>
                    </div>


                </div>
            </section>
            <!-- progress section -->
            <section>
                <div class="lean-progress">
                    <div class="progress-wrap">
                        <div class="progress" id="progress" :style="{width: currentProgress/8*100 + '%'  }" ></div>

                        <div v-for="(progress, index) in 9" :key="index" class="step" :class="index <= currentProgress  ? 'active' : ''"  >
                            {{ progress  }}
                        </div>

                    </div>
                </div>
            </section>
            <!-- body section -->
            <section class="grid grid-cols-3 gap-4">

                <div class="col-span-2">
                    <transition name="slide-fade">
                        <customer-segment 
                            v-if="currentProgress === 0"
                            :user="user"
                            :guide="true" >
                        </customer-segment>
                        <problem 
                            v-if="currentProgress === 1"
                            :user="user"
                            :guide="true">

                        </problem>
                        <revenue 
                            v-if="currentProgress === 2"
                            :user="user"
                            :guide="true">
                        </revenue>
                        <solution 
                            v-if="currentProgress === 3"
                            :user="user"
                            :guide="true">
                        </solution>
                        <unique-value-proposition 
                            v-if="currentProgress === 4"
                            :user="user"
                            :guide="true">
                        </unique-value-proposition>
                        <channel 
                            v-if="currentProgress === 5"
                            :user="user"
                            :guide="true">
                        </channel>
                        <key-metric 
                            v-if="currentProgress === 6"
                            :user="user"
                            :guide="true">
                        </key-metric>
                        <cost-structure 
                            v-if="currentProgress === 7"
                            :user="user"
                            :guide="true">
                        </cost-structure>
                        <unfair-advantage 
                            v-if="currentProgress === 8"
                            :user="user"
                            :guide="true">
                        </unfair-advantage>

                    
                    </transition>

                </div>

                <!-- information card -->
                <div class="col-span-1">
                    <transition name="slide-fade">
                        <info-card :currentProgress="currentProgress"></info-card>
                    </transition>
                </div>

            </section>
        </main>
    </div>
</template>
<script>
import { mapGetters } from 'vuex'
import CustomerSegmentVue from '../../components/leanCanvas/CustomerSegment.vue'
import ProblemVue from '../../components/leanCanvas/Problem.vue'
import RevenueVue from '../../components/leanCanvas/Revenue.vue'
import SolutionVue from '../../components/leanCanvas/Solution.vue'
import UniqueValueProposition from '../../components/leanCanvas/UniqueValueProposition.vue'
import Channel from '../../components/leanCanvas/Channel.vue'
import KeyMetric from '../../components/leanCanvas/KeyMetric.vue'
import CostStructure from '../../components/leanCanvas/CostStructure.vue'
import UnfairAdvantage from '../../components/leanCanvas/UnfairAdvantage.vue'
import InfoCardVue from '../../components/leanCanvas/InfoCard.vue'
export default {
    name: 'LeanCanvasGuide',
    components: {
        'customer-segment': CustomerSegmentVue,
        'problem': ProblemVue,
        'revenue': RevenueVue,
        'solution': SolutionVue,
        'unique-value-proposition': UniqueValueProposition,
        'channel': Channel,
        'key-metric': KeyMetric,
        'cost-structure': CostStructure,
        'unfair-advantage': UnfairAdvantage,
        'info-card': InfoCardVue
    },

    computed: {
        ...mapGetters([
            'user',
            'customerSegment'
        ])
    },

    created() {

    },

    destroyed() {
        this.$store.commit('closeToast')
    },

    data() {
        return {
            test: true,
            currentProgress: 0,
            guide: true
        }
    },

    methods: {
        nextProgress() {
            if(this.customerSegment.length === 0) {
                this.$store.commit('setTypeToast', 'Error')
                this.$store.commit('setMessage', 'Please Fill Customer Segment First')
                this.$store.commit('showToast')
                this.currentProgress = 0
            } else {
                this.currentProgress += 1
            }
        },

        async initialized() {
            
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

.progress-wrap {
  position: relative;

  display: flex;
  justify-content: space-between;
}

.progress-wrap::before {
  content: "";
  width: 100%;
  height: 4px;

  position: absolute;
  top: 50%;
  left: 0;
  transform: translateY(-50%);
  z-index: 2;
  transition: 0.3s ease-in-out;
  background-color: #e6e6e6;
  

}
// change width here
.progress {
  width: 0;
  height: 4px;

  position: absolute;
  top: 50%;
  left: 0;
  transform: translateY(-50%);
  z-index: 2;
  transition: 0.3s ease-in-out;
  background-color: #4717a7;
}

.step {
  width: 40px;
  height: 40px;
  font-weight: bold;
  z-index: 5;

  display: flex;
  align-items: center;
  justify-content: center;
  color: #333;
  background-color: #fff;
  border: 3px solid #e6e6e6;
  border-radius: 50%;
  transition: 0.3s ease-in-out;
}

.step.active {
  border-color: #4717a7;
}

.lean-progress {
    border-radius: 0.5rem;
    background: #fff;
    box-shadow: 0 0 40px rgb(0 0 0 / 5%);
    padding: 1rem 1.3rem;
    margin-bottom: 1.5rem;
}

</style>