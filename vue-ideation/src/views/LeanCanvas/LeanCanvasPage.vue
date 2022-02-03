<template lang="">
    <div class="c-container" >
        <div class="l-page-title">
            <span>Lean Canvas</span>
        </div>

        <div class="grid grid-cols-2 gap-4">

            <router-link :to="{name: 'LeanCanvasGuide', params: this.$route.params.id}" class="l-option-card guide">
                <h2>Lean Canvas Guide</h2>

            </router-link>

            <router-link :to="{name: 'LeanCanvasFull', params: this.$route.params.id}" class="l-option-card view">
                <h2>View Full Lean Canvas</h2>
            </router-link>

        </div>
    </div>
</template>
<script>
import api from '@/api/leanCanvasApi'
export default {
    name: 'LeanCanvasPage',
    components: {
    },
    created() {
        this.connect()
    },
    mounted() {
        this.getAllSegment()

    },
    data() {
        return {

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



    }
}
</script>
<style lang="scss" scoped>
    .l-page-title {
        background: #fff;
        
        border-radius: 1rem;
        box-shadow: 0 0 40px rgb(0 0 0 / 5%);
        margin-bottom: 7rem;
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
</style>