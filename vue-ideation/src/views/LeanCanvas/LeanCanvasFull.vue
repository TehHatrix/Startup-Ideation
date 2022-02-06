<template lang="">
    <div class="c-container">
        <div class="text-left mb-1">
            <button class="general-button w-5" @click="$router.go(-1)">Back</button>
        </div>
        <div class="l-page-title">
            <span>
                Lean Canvas
            </span>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <customer-segment :user="user" class="limit-height"></customer-segment>
            <problem :user="user" :guide="false"></problem>
            <revenue :user="user" :guide="false"></revenue>
            <solution :user="user" :guide="false"></solution>
            <unique-value-proposition :user="user" :guide="false"></unique-value-proposition>
            <channel :user="user" :guide="false"></channel>
            <key-metric :user="user" :guide="false"></key-metric>
            <cost-structure :user="user" :guide="false"></cost-structure>
            <unfair-advantage :user="user" :guide="false"></unfair-advantage>
        </div>
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
export default {
    name: 'LeanCanvasFull',
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
    },
    computed: {
        ...mapGetters([
            'user'
        ])
    },
    data() {
        return {
            guide: false,
        }
    }
}
</script>
<style lang="scss" scoped>
    .l-page-title {
        background: #fff;
        
        border-radius: 1rem;
        box-shadow: 0 0 40px rgb(0 0 0 / 5%);
        margin-bottom: 2rem;
        min-height: 2rem;
        padding: 1rem 1rem;

        display: flex;
        align-items: center;
        justify-content: space-between;

        span {
            letter-spacing: 0.2rem;
            font-weight: bold;
            font-size: 2rem;
        }
    }

    .c-body-content {
        height: 20rem  !important;
    }



</style>