<template lang="">
    <transition name="fade">
        <div
        v-if="showModal"
        class="fixed inset-0 w-full h-screen flex items-center justify-center bg-semi-75 bg-gray-100  "
        style="background: rgba(0, 0, 0, 0.75); "
         >
            <div class="w-full max-w-2xl p-8 relative ">
                <div class="center-div">
                    
                    <div class="boxes">
                        <div class="box">   
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                        <div class="box">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                        <div class="box">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                        <div class="box">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>
<script>
export default {
    name: 'ProjectModal',
    props: {
        showModal: {
            required: true,
            type: Boolean
        },

    },
    watch: {
        showing(value) {
            if (value) {
                return document.querySelector('body').classList.add('overflow-hidden');
            }

            document.querySelector('body').classList.remove('overflow-hidden');
        }
    }
    
}
</script>
<style scoped>
    .fade-enter-active,
    .fade-leave-active {
    transition: all 0.4s;
    }
    .fade-enter,
    .fade-leave-to {
    opacity: 0;
    }


    .w-full {
        width: 100%;
    }

    .fixed {
        position: fixed;
    }

    .items-center  {
        align-items:  center; 
    }

    .inset-0 {
        top: 0px;
        right: 0px;
        left: 0px;
        bottom: 0px;
    }

    .h-screen {
        height: 100vh;
    }

    .flex {
        display: flex;
    }

    .justify-center {
        justify-content: center;
    }

    .bg-gray-100 {
        background: rgba(0, 0, 0, 0.75);
    }

    .max-w-2xl {
        max-width: 43rem;
    }

    .bg-white {
        background-color: #fff;
    }

    .shadow-lg {
        background-color: rgba(255, 255, 255, 1);
    }

    .relative {
        position: relative;
    }

    .p-8 {
        padding: 2rem;
    }

    .rounded-lg {
        border-radius: 0.5rem;
    }

    .absolute {
        position: absolute;
    }

    .top-0 {
        top: 0px;
    }

    .right-0 {
        right: 0px;
    }

    .text-gray-500 {
        color: rgba(107, 114, 128, 1);
    }

    .my-2 {
        margin-top: 0.5rem;        
        margin-bottom: 0.5rem;
    }


    .close {
        color: gray;
    }

    .close:hover {
        color: black;
    }

    .center-div {
    display: flex;
    justify-content: center;
    height: 90vh;
    align-items: center;
}

.boxes {
    height: 32px;
    width: 32px;
    position: relative;
    -webkit-transform-style: preserve-3d;
    transform-style: preserve-3d;
    -webkit-transform-origin: 50% 50%;
    transform-origin: 50% 50%;
    margin-top: 32px;
    -webkit-transform: rotateX(60deg) rotateZ(45deg) rotateY(0deg) translateZ(0px);
    transform: rotateX(60deg) rotateZ(45deg) rotateY(0deg) translateZ(0px);
}
.boxes .box {
    width: 32px;
    height: 32px;
    top: 0px;
    left: 0;
    position: absolute;
    -webkit-transform-style: preserve-3d;
    transform-style: preserve-3d;
}



.boxes .box:nth-child(1) {
    -webkit-transform: translate(100%, 0);
    transform: translate(100%, 0);
    -webkit-animation: box1 1s linear infinite;
    animation: box1 1s linear infinite;
}
.boxes .box:nth-child(2) {
    -webkit-transform: translate(0, 100%);
    transform: translate(0, 100%);
    -webkit-animation: box2 1s linear infinite;
    animation: box2 1s linear infinite;
}
.boxes .box:nth-child(3) {
    -webkit-transform: translate(100%, 100%);
    transform: translate(100%, 100%);
    -webkit-animation: box3 1s linear infinite;
    animation: box3 1s linear infinite;
}
.boxes .box:nth-child(4) {
    -webkit-transform: translate(200%, 0);
    transform: translate(200%, 0);
    -webkit-animation: box4 1s linear infinite;
    animation: box4 1s linear infinite;
}



.boxes .box > div {
    background: #8743FF;
    --translateZ: 15.5px;
    --rotateY: 0deg;
    --rotateX: 0deg;
    position: absolute;
    width: 100%;
    height: 100%;
    background: #8743FF;
    top: auto;
    right: auto;
    bottom: auto;
    left: auto;
    -webkit-transform: rotateY(var(--rotateY)) rotateX(var(--rotateX)) translateZ(var(--translateZ));
    transform: rotateY(var(--rotateY)) rotateX(var(--rotateX)) translateZ(var(--translateZ));
}

.boxes .box > div:nth-child(1) {
    top: 0;
    left: 0;
    background: #8743FF;
}
.boxes .box > div:nth-child(2) {
    background: #4136F1;
    right: 0;
    --rotateY: 90deg;
}
.boxes .box > div:nth-child(3) {
    background: #8743FF;
    --rotateX: -90deg;
}
.boxes .box > div:nth-child(4) {
    background: #DBE3F4;
    top: 0;
    left: 0;
    --translateZ: -90px;
}





@keyframes box1 {
    0%,
    50% {
        transform: translate(100%, 0);
    }
    100% {
        transform: translate(200%, 0);
    }
}

@keyframes box2 {
    0%{
        transform: translate(0, 100%);
    }
    50% {
        transform: translate(0, 0);
    }
    100% {
        transform: translate(100%, 0);
    }
}

@keyframes box3 {
    0%,
    50% {
        transform: translate(100%, 100%);
    }
    100% {
        transform: translate(0, 100%);
    }
}

@keyframes box4 {
    0%{
        transform: translate(200%, 0);
    }
    50% {
        transform: translate(200%, 100%);
    }
    100% {
        transform: translate(100%, 100%);
    }
}
    
    
</style>