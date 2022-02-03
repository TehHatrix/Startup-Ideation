<template lang="">
    <div>
        <div class="info-card">
            <div class="info-title">
                {{ infoContent[currentProgress].title }}
            </div>
            <div class="info-body">
                <div v-if="currentProgress == 0">
                    <h1>Customer Segment</h1>
                    <p>It is your target audience in which you want to market your product to </p>
                    <h1>What you need to remember</h1>
                    <p>Do not define your customer segment too broadly <br>  </p>
                    It is also good to seperate user and customer
                    <h1>For example, with a project of Uber, we will have the following customer segment</h1>
                    <ul>
                        <li>College Student</li>
                        <li>Taxi Driver</li>
                    </ul>
                </div>
                <div v-if="currentProgress == 1">
                    <h1>Define your problem for the customer segment</h1>
                    <p>This is where you will define the problem for each customer problem as each customer segment have distinct pains and problems</p>
                    <h1>For example, with a project of Uber, we will have the following problem with each customer segment</h1>
                    <p>College Student</p>
                    <ul>
                        <li>Expensive taxi service</li>
                        <li>availability of cars</li>
                        <li>Lack of driver Profile</li>
                    </ul>
                    <p>Taxi Driver</p>
                    <ul>
                        <li>lacking passenger information</li>
                        <li>need to do full time only</li>
                    </ul>
                </div>
                <div v-if="currentProgress == 2">
                    <h1>Revenue Stream </h1>
                    <p>revenue stream is how your project will be monetize and how you can profit for it</p>
                    <p>You need to decide the pricing model for you product</p>
                    <h1>For example, with a project of Uber, we will have the following revenue stream</h1>
                    <p>College Student</p>
                    <ul>
                        <li>Subscription model: 25% of the pay for each ride</li>
                    </ul>
                </div>
                <div v-if="currentProgress == 3">
                    <h1>Provide your solution </h1>
                    <p>For each of your customer segment, you want to give the solution to their problem </p>
       
                </div>


            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'InfoCard',
    props: ['currentProgress'],

    data() {
        return {
            infoContent: [
                {
                    title: 'What is Customer Segment?',
                    content: '<h1>adsf</h1>'
                },
                {
                    title: 'What is a Problem?'
                },
                {
                    title: 'What is Revenue?'
                },
                {
                    title: 'What is Solution?'
                },
                {
                    title: 'What is Unique Value Proposition?'
                },
                {
                    title: 'What is Channel?'
                },
                {
                    title: 'What is Key Metric?'
                },
                {
                    title: 'What is Cost Structure?'
                },
                {
                    title: 'What is Unfair Advantage?'
                }

            ]
        }
    }
}
</script>
<style lang="scss" scoped>
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
        }

        .info-body {
            padding: 1rem;
            max-height: 70vh;
            overflow: scroll;
            -webkit-scrollbar: none;
        }
    }
</style>