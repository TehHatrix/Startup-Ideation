<template lang="">
    <transition name="fade">
        <div
        v-if="showModal"
        class="fixed inset-0 w-full h-screen flex items-center justify-center bg-semi-75 bg-gray-100  "
        style="background: rgba(0, 0, 0, 0.75); "
        @click.self="close" >
            <div class="w-full max-w-2xl bg-white shadow-lg rounded-lg p-8 relative ">
                <button
                    id="projectModalClose"
                    aria-label="close"
                    class="absolute top-0 right-0 text-xl text-gray-500 my-2 mx-4" 
                    @click.prevent="close"
                >
                    <span class="close">Close</span>
                </button>
                <slot />
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
    methods: {
        close() {
            this.$emit('close');
        }
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

    #projectModalClose {
        background: none;
        border: none;
        cursor: pointer;
        outline: inherit;
    }

    .close {
        color: gray;
    }

    .close:hover {
        color: black;
    }
    
    
</style>