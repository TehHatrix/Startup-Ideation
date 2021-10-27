<template>
<div id = "modal-comp">
<button class="button" @click="showModal = true">
    Show Modal
</button>
<transition name="fade" appear>
    <div class="modal-overlay" v-if="showModal" @click="showModal = false"></div>
</transition>
<transition name="slide" appear>
    <div class="modal" v-if="showModal">
        <h1>Modal Form</h1>
        <p>Choose Learning Objectives</p>
        <p>Choose Learning Objectives</p>
        <button class="button" @click="showModal= false"> Close</button>
    </div>
</transition>
</div>
</template>

<script>
export default {
    data(){
        return{
            showModal: false
        }
    }
}
</script>

<style lang = 'scss' scoped>
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body{
    font-family: 'Poppins', sans-serif;
}

/* #modal-comp{

} */

.button{
    appearance: none;
    outline: none;
    border: none;
    background: none;
    cursor: pointer;

    display: inline-block;
    padding: 13px 19px;
    margin-top: 7px;
    background: linear-gradient(180deg, #8743FF 0%, #4136F1 100%);
    /* background-image: linear-gradient(to right, #CC2E5D, #FF5858); */
    border-radius: 8px;

    color: #FFF;
    font-size: 15px;
    font-weight: 700;
    
    box-shadow: 3px 3px rgba(0,0,0,0.4);
    transition: 0.4s ease-out;
    &:hover {
        box-shadow: 6px 6px rgba(0,0,0,0.6);
    }
}

.modal{
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    z-index: 99;

    width: 100%;
    max-width: 500px;
    background-color: #FFF;
    border-radius: 16px;

    padding: 25px;

    p{
        padding-top: 2px;
        padding-bottom: 3px;
    }
}

.modal-overlay{
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
    bottom: 0;
    z-index: 98;
    background-color: rgba(0,0,0,0.3);
}

.fade-enter-active,.fade-leave-active{
    transition: opacity 0.5s;
}

.fade-enter,.fade-leave-to{
    opacity: 0;
}

.slide-enter-active,
.slide-leave-active {
 transition: transform .5s;
}

.slide-enter,
.slide-leave-to {
 transform: translateY(-50%) translateX(100vw);
}




</style>