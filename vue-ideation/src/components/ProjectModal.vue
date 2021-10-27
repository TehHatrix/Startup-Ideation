<template lang="">
    <transition name="fade">
        <div
        v-if="showModal"
        class="fixed inset-0 w-full h-screen flex items-center justify-center bg-semi-75 bg-gray-100  "
        style="background: rgba(0, 0, 0, 0.75); "
        @click.self="close" >
            <div class="w-full max-w-2xl bg-white shadow-lg rounded-lg p-8 relative ">
                <button
                    aria-label="close"
                    class="absolute top-0 right-0 text-xl text-gray-500 my-2 mx-4" 
                    @click.prevent="close"
                >
                    ×
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
        }
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
</style>