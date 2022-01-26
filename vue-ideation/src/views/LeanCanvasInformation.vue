<template lang="">
    <div class="main-wrapper">
        <section class="hero-area-bg " id="hero-area">
            <div class="contents">
                <h1 class="head-title">Lean Canvas</h1>
                <p class="head-paragraph" >Lean Canvas is a 1-page business plan template created by Ash Maurya that will help you in deconstructing your idea into its key assumptions. It is adapted from Alesx Osterwalder's Business Model Canvas and is optimized for lean startup. It also can replaces elaborate business plans with a single page business model</p>
            </div>



        </section>    

        <article class="body-area">
            <h2>What is in lean canvas</h2>
            <p>The canvas is made up of nine boxes, with each describing one aspect of your business idea </p>
            <div class="grid grid-cols-3 gap-4">
                <div class="card-white" >
                    <h3>Customer Segment</h3>
                    <p>This part where you will enter the generalize type of your target audience </p>
                </div>

                <div class="card-white" >
                    <h3>Problem</h3>
                    <p>This part is for each customer segment, they will have a set of problem that they need solving.</p>
                </div>

                <div class="card-white" >
                    <h3>Revenue</h3>
                    <p>This is the part where you will find and determine the way you will want to monetize your product.</p>
                </div>

                <div class="card-white" >
                    <h3>Solution</h3>
                    <p>This is where for each problem of each customer segment, you will determine how you will solve that problem</p>
                </div>

                <div class="card-white" >
                    <h3>Unique Value Proposition</h3>
                    <p>Do you think that your system has a unique feature or value? This is the part where you will put the unique value porposition of your product</p>
                </div>

                <div class="card-white" >
                    <h3>Channel</h3>
                    <p>This section is for your product to reach your target audience in customer segment. </p>
                </div>

                <div class="card-white" >
                    <h3>Key Metric</h3>
                    <p>Want to know the performance of your business? this section is where you determine the key metric that will be used to determine the progress of your business</p>
                </div>

                <div class="card-white" >
                    <h3>Cost Structure</h3>
                    <p>Every business need to have an operational cost. This section is where you will list all the operational cost for taking this business to market.</p>
                </div>

                <div class="card-white" >
                    <h3>Unfair Advantage</h3>
                    <p>This may be the hardest section to complete. It should be the special thing about your idea that your competitor are not able to copy or obtain in any possible way </p>
                </div>

            </div>

            <div class="example-body ">
                <div>
                    <h2>Want to watch an example</h2>
                </div>
                <div>
                    <iframe width="700" height="350"
                        src="https://www.youtube.com/embed/pvIN9STpzCQ">
                    </iframe> 
                </div>
            </div>
        </article>
    </div>
</template>
<script>
export default {
    name: 'LeanCanvasInformation',

}
</script>
<style lang="scss">

    .main-wrapper {
        // width: 80%;
        // margin: auto;
        background: #fff;

    }

    #hero-area{
        padding: 5rem 0;
        .contents{ 
            .head-title {
                text-align: center;
                font-size: 2.25rem;
                font-weight: 800;
                line-height: 60px;
            }
            .head-paragraph {
                margin: 0 5rem;
            }
        }
    }

    .card-white {
        padding: .5rem .5rem;
    }

    .body-area {
        padding: 0 10rem;
        background: #f9f9f9;
    }

    .example-body {
        padding: 2rem 0;
        text-align: center;
    }

</style>