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
                    <p>This is what you think the solution that you will provide and solve your customer segment based on the problem</p>
                    <h1>For example, with a project of Uber, we will have the following Solution</h1>
                    <ul>
                        <li>Cheaper ride</li>
                        <li>Flexible Work Schedule</li>
                    </ul>
                </div>
                <div v-if="currentProgress == 4">
                    <h1>Unique Value Proposition</h1>
                    <p>A value proposition is a promise of value to be delivered</p>
                    <p>Describe the uniqueness of your product and show its key difference from the existing alternative</p>
                    <p>It is better to make a single, clear, compelling message that turns an unaware visitor into an interested prospect </p>
                    <h1>For example, with a project of Uber, we will have the following Unique value Proposition</h1>
                    <ul>
                        <li>All services in one app, which allows you to find a safe ride 24/7</li>
                        <li>Work on your own schedule and revenue, navigate route through the app</li>
                    </ul>
                </div>
                <div v-if="currentProgress == 5">
                    <h1>Channel</h1>
                    <p>This is a way to which you will reach to your customer</p>
                    <p>It can be said that this is where you wiil list how you will market your product to the potential customer</p>
                    <h1>For Example, with a project of Uber, we will have the following Channel</h1>
                    <ul>
                        <li>User Referral</li>
                        <li>Social Media</li>
                    </ul>
                </div>
                <div v-if="currentProgress == 6">
                    <h1>Key Metric</h1>
                    <p>Define the key tracking metrics to measure the progress of your business</p>
                    <h1>For Example, with a project of Uber, we will have the following Key Metric</h1>
                    <ul>
                        <li>Number of User</li>
                        <li>Income</li>
                        <li>Number of ride</li>
                    </ul>
                </div>
                <div v-if="currentProgress == 7">
                    <h1>Cost Structure</h1>
                    <p>List the fixed and variable cost for your product </p>
                    <p>This is where you will list the cost that you need to take to run your business</p>
                    <h1>For Example, with a project of Uber, we will have the following Cost Structure</h1>
                    <ul>
                        <li>Product Development</li>
                        <li>Marketing Expense</li>
                        <li>Salaries</li>
                    </ul>
                </div>
                <div v-if="currentProgress == 8">
                    <h1>Unfair Advantage</h1>
                    <p>A special thing about your idea that your competitors are not able to copy or obtain in any possible way </p>
                    <h1>For Example, with a project of Uber, we will have the following Unfair Advantage</h1>
                    <ul>
                        <li>Low priced rides at the push of a button</li>
                    </ul>

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