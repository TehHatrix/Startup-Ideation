<template>
<div class = "container">
    <div class ="heading">
        <progressBar/>
        <hypothesismeow/>
    </div>


</div>
</template>

<script>
import hypothesis from "./listHypothesis";
import progressBar from "./progressBar";

export default {
    components:{
        progressBar,
        hypothesis,
    },
};
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,300&display=swap');

</style>