<template lang="">
    <div class="c-container" v-if="!loading">
        <div class="l-page-title">
            <span>Lean Canvas</span>
        </div>

        <div class="grid grid-cols-2 gap-4">

            <div>
                <div class="info-card">
                    <div class="info-title" @click="expandMore = !expandMore">
                        Click to learn more about Lean Canvas
                    </div>
                    <div class="info-body" :class="expandMore ? 'show' : 'hide'">
                        <h3>Lean Canvas</h3>
                        <p>Lean canvas is a 1-page business model template which is created by Ash Maurya that help you deconstruct your idea into its key key assumption. It will help you eloborate on your business plans with a single page business model</p>
                        <h3>Block in Lean Canvas </h3>
                        <ul>
                            <li>Problem</li>
                            <li>Customer Segment</li>
                            <li>Revenue</li>
                            <li>Solution</li>
                            <li>Unique Value Proposition</li>
                            <li>Channels</li>
                            <li>Cost Structure</li>
                            <li>Key Metric</li>
                            <li>Unfair Advantage</li>
                        </ul>
                    </div>
                </div>

                <div class="c-body-card">
                    <div class="c-body-title">
                        Problem Validated Status
                    </div>

                    <div class="c-body-content">
                        <div class="nothing-canvas" v-if="problemStatusArray.length == 0">
                            Please Fill Lean Canvas First
                        </div>

                        <div class="card-problem-status grid grid-cols-5 gap-2" v-for="(prob, index) in problemStatusArray" :key="index" v-else>
                            <div class="problem-info col-span-4">
                                <p >{{ getProblemName(prob.problem_id) }}</p>
                                <p class="cs-segment">For Customer Segment: {{ getCS(prob.problem_id) }}</p>
                            </div>
                            <div class="problem-status col-span-1" :class="prob.validated ? 'validated-true' : 'validated-false'">
                                {{prob.validated ? 'Validated' : 'Unvalidated'}}
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <div>
                <router-link :to="{name: 'LeanCanvasGuide', params: this.$route.params.id}" class="l-option-card guide">
                    <h2>Lean Canvas Guide</h2>
    
                </router-link>
    
                <router-link :to="{name: 'LeanCanvasFull', params: this.$route.params.id}" class="l-option-card view">
                    <h2>View Full Lean Canvas</h2>
                </router-link>
            </div>

        </div>
    </div>
    <div v-else>
        <loading-screen></loading-screen>
    </div>
</template>
<script>
import api from '@/api/leanCanvasApi'
import { mapGetters } from 'vuex'
import LoadingScreenVue from '../../components/general/LoadingScreen.vue'
export default {
    name: 'LeanCanvasPage',
    components: {
        'loading-screen': LoadingScreenVue,
    },
    created() {
        this.connect()
    },
    mounted() {
        this.getAllSegment()
        this.getProblemStatusArr()

    },
    computed: {
        ...mapGetters([
            'problemStatusArray',
            'leanProblem',
            'customerSegment'
        ]),
    },
    data() {
        return {
            expandMore: false,
            loading: true
        }
    },

    methods: {

        connect() {
            window.Echo.private(`Project.${this.$route.params.id}`)
                        .listen('LeanCanvasUpdated', (e) => {
                            if(e.type == 1) {
                                this.getCustomerSegment()
                                this.getLeanProblem()
                                this.getLeanSolution()
                                this.getUniqueValueProposition()
                            } else if (e.type == 2) {
                                this.getLeanProblem()
                            } else if (e.type == 3) {
                                this.getRevenue()
                            } else if (e.type == 4) {
                                this.getLeanSolution()
                            } else if (e.type == 5) {
                                this.getUniqueValueProposition()
                            } else if (e.type == 6) {
                                this.getChannel()
                            } else if (e.type == 7) {
                                this.getKeymetric()
                            } else if (e.type == 8) {
                                this.getCostStructure()
                            } else if (e.type == 9) {
                                this.getUnfairAdvantage()
                            }
                        }) 
        },

        async getAllSegment() {
            try {
                let {data} = await api.getAllSegment(this.$route.params.id)
                if(data.success) {
                    this.$store.commit('SET_CUSTOMER_SEGMENT', data.customerSegment)
                    this.$store.commit('SET_LEAN_PROBLEM', data.problem)
                    this.$store.commit('SET_LEAN_REVENUE', data.revenue)
                    this.$store.commit('SET_LEAN_SOLUTION', data.solution)
                    this.$store.commit('SET_UNIQUE_VALUE_PROPOSITION', data.uniqueValueProposition)
                    this.$store.commit('SET_LEAN_CHANNEL', data.channel)
                    this.$store.commit('SET_KEY_METRIC', data.keyMetric)
                    this.$store.commit('SET_COST_STRUCTURE', data.costStructure)
                    this.$store.commit('SET_UNFAIR_ADVANTAGE', data.unfairAdvantage)
                }
                return data
            } catch (error) {
                console.log(error)
            }
        },

        async getProblemStatusArr() {
            try {
                let {data} = await api.getStatusValidate(this.$route.params.id)
                // console.log(data.problemStatusArray)
                if(data.success) {
                    this.$store.commit('SET_PROBLEM_STATUS_ARRAY', data.problemStatusArray)
                    this.loading = false
                }
            } catch (error) {
                console.log(error)
            }
        },
        
        async getCustomerSegment() {
            try {
                let {data} = await api.getSegment(this.$route.params.id, 1)
                if(data.success) {
                    this.$store.commit('SET_CUSTOMER_SEGMENT', data.content)
                }
            } catch (error) {
                console.log(error)
            }
        },

        async getLeanProblem() {
            try {
                let {data} = await api.getSegment(this.$route.params.id, 2)
                if(data.success) {
                    this.$store.commit('SET_LEAN_PROBLEM', data.content)
                }
            } catch (error) {
                console.log(error)
            }
        },
        
        async getRevenue() {
            try {
                let {data} = await api.getSegment(this.$route.params.id, 3)
                if(data.success) {
                    this.$store.commit('SET_LEAN_REVENUE', data.content)
                }
            } catch (error) {
                console.log(error)
            }
        },

        async getLeanSolution() {
            try {
                let {data} = await api.getSegment(this.$route.params.id, 4)
                if(data.success) {
                    this.$store.commit('SET_LEAN_SOLUTION', data.content)
                }
            } catch (error) {
                console.log(error)
            }
        },

        async getUniqueValueProposition() {
            try {
                let {data} = await api.getSegment(this.$route.params.id, 5)
                if(data.success) {
                    this.$store.commit('SET_UNIQUE_VALUE_PROPOSITION', data.content)
                }
            } catch (error) {
                console.log(error)
            }
        },

       async getChannel() {
            try {
                let {data} = await api.getSegment(this.$route.params.id, 6)
                if(data.success) {
                    this.$store.commit('SET_LEAN_CHANNEL', data.content)
                }
            } catch (error) {
                console.log(error)
            }
        },

       async getKeymetric() {
            try {
                let {data} = await api.getSegment(this.$route.params.id, 7)
                if(data.success) {
                    this.$store.commit('SET_KEY_METRIC', data.content)
                }
            } catch (error) {
                console.log(error)
            }
        },

       async getCostStructure() {
            try {
                let {data} = await api.getSegment(this.$route.params.id, 8)
                if(data.success) {
                    this.$store.commit('SET_COST_STRUCTURE', data.content)
                }
            } catch (error) {
                console.log(error)
            }
        },

       async getUnfairAdvantage() {
            try {
                let {data} = await api.getSegment(this.$route.params.id, 9)
                if(data.success) {
                    this.$store.commit('SET_UNFAIR_ADVANTAGE', data.content)
                }
            } catch (error) {
                console.log(error)
            }
        },

        getProblemName(id){
            let cust = this.leanProblem.find( (prob) => {
                return prob.id === id
            } )

            return cust.topic
        },

        getCS(id) {
            let prob = this.leanProblem.find( (prob) => prob.id ===id)
            let cust = this.customerSegment.find( (cs) => cs.id === prob.customer_segment_id)
            return cust.topic
        }

    }
}
</script>
<style lang="scss" scoped>
    .l-page-title {
        background: #fff;
        
        border-radius: 1rem;
        box-shadow: 0 0 40px rgb(0 0 0 / 5%);
        margin-bottom: 3rem;
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

    .l-option-card {
        border-radius: 1rem;
        color: #fff;
        box-shadow: 0 0 40px rgb(0 0 0 / 5%);
        min-height: 10rem;
        max-height: 10rem;

        min-width: 25rem;
        max-width: 25rem;
        text-decoration: none;
        margin: auto;
        margin-bottom: 3rem;
        margin-top: 3rem;

        cursor: pointer;
        outline: none;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.4s ease;
        &:hover {
            transform: rotate(10deg);
            box-shadow: 0px 15px 20px rgba(136, 67, 255, 0.425);

            h2 {
                transform: rotate(-10deg);
            }
        }

        h2 {
            font-size: 2rem;
            transition: all 0.4s ease;
        }
    }

    .guide {
        background: hsla(279, 95%, 49%, 1);

        background: linear-gradient(90deg, hsla(279, 95%, 49%, 1) 0%, hsla(295, 96%, 50%, 1) 100%);

        background: -moz-linear-gradient(90deg, hsla(279, 95%, 49%, 1) 0%, hsla(295, 96%, 50%, 1) 100%);

        background: -webkit-linear-gradient(90deg, hsla(279, 95%, 49%, 1) 0%, hsla(295, 96%, 50%, 1) 100%);

    }

    .view {
        background: hsla(323, 91%, 51%, 1);

        background: linear-gradient(90deg, hsla(323, 91%, 51%, 1) 0%, hsla(329, 20%, 24%, 1) 100%);

        background: -moz-linear-gradient(90deg, hsla(323, 91%, 51%, 1) 0%, hsla(329, 20%, 24%, 1) 100%);

        background: -webkit-linear-gradient(90deg, hsla(323, 91%, 51%, 1) 0%, hsla(329, 20%, 24%, 1) 100%);

    }

    .info-card {
        border-radius: 0.5rem;
        background: #fff;
        box-shadow: 0 0 40px rgb(0 0 0 / 5%);

        .info-title {
            background: linear-gradient(180deg, #43b692 0%, #099773 100%);
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
            color: white;
            padding: .7rem .7rem;
            font-weight: 600;
            letter-spacing: .15rem;
            font-size: 1.3rem;
            cursor: pointer;
        }

        .info-body {
            padding: 0 1rem;
            max-height: 70vh;
            overflow: scroll;
            -webkit-scrollbar: none;
            margin-bottom: 1.5rem;
        }
    }

    .info-body {
        padding: 0;
        
    }

    .hide {
        transition: opacity 1s ease-out;
        opacity: 0;
        height: 0;
        overflow: hidden;

    }

    .show {
        opacity: 1;
        height: auto;
        transition: opacity 1s ease-out;
    }

    .nothing-canvas {
        font-size: 2.5rem ;
        color: gray;
        text-align: center;
    }

    .c-body-content {
        height: 30rem;
        max-height: 30rem;
        padding: 1rem 2rem;
        
    }

    .card-problem-status {
        border: 2px solid black;
        background: #fff;
        margin-bottom: 1rem;
        border-radius: 1rem;
        transition: all .3s ease;
        &:hover {
            transform: scale(1.05);
        }

        .problem-info {
            font-size: 1rem;
            letter-spacing: .1rem;
            font-family: 'Poppins', sans-serif;

            padding: 0 .5rem;

            .cs-segment {
                display: block;
                color: #212121;
                font-size: .8rem;
            }

        }

        .problem-status {
            color: #fff;
            font-size: 1rem;
            letter-spacing: .1rem;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 1rem;

        }

        .validated-true {
            background: linear-gradient(180deg, #43b692 0%, #099773 100%);
        }
        .validated-false {
            background: linear-gradient(180deg, #f83d5c 0%, #fd4b2f 100%);

        }
    }
</style>