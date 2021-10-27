<template>
<div class="container">
    <ul class = "progressbar">
        <li class ="active">Define Lean Canvas</li>
        <li>Define Customer Hypothesis</li>
        <li>Customer Interview</li>
    </ul>
</div>
</template>

<script>
export default {
        
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,300&display=swap');
.container{
    width: 100%;
}
.progressbar{
    counter-reset: step;
}

.progressbar li {
    list-style-type: none;
    float: left;
    width: 33.33%;
    position: relative;
    text-align: center;
}

.progressbar li:before{
    content: counter(step);
    counter-increment: step;
    width: 30px;
    height: 30px;
    line-height: 30px;
    border: 1px solid #ddd;
    display: block;
    text-align: center;
    margin: 0 auto 10px auto;
    border-radius: 50%;
    background-color: white;
}

.progressbar li:after{
    content: '';
    position: absoulute;
    width: 100%;
    height: 1px;
    background-color: #ddd;
    top: 15px;
    left: -50%;
    z-index: -1;
}

.progressbar li:first-child:after{
    content:none;
}

.progressbar li.active{
    color:green;
}

.progressbar li.active:before{
    border-color:green;
}

/* .progressbar li */




</style>

