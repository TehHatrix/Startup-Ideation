<template lang="">
    <div class="container">
        <main>
            <!-- main header -->
            <section class="page-title">
                <span>Project Chat</span>
            </section>

            <section class="page-body">
                <chat-container></chat-container>
            </section>



        </main>
    </div>
</template>
<script>
import ChatContainerVue from '../../components/chat/ChatContainer.vue'
export default {
    name: 'ChatPage',
    components: {
        'chat-container': ChatContainerVue
    },
    data() {
        return {

        }
    }, 


}
</script>
<style lang="scss" scoped>
    .page-title {
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 0 40px rgb(0 0 0 / 5%);
        margin-bottom: 2rem;
        min-height: 2rem;
        padding: 1rem 1rem;

        display: flex;
        align-items: center;
        justify-content: space-between;

        span {
            letter-spacing: 0.2rem;
            font-weight: 600;
            font-size: 1.2rem;
        }

        button {
            border: none;
            border-radius: .4rem;
            background: #14213d;
            color: white;
            border: 1px solid #14213d;
            padding: .5rem .5rem;
            cursor: pointer;
            transition: all 0.5s ease-in 0.3s;
            width: 7rem;
            letter-spacing: .1rem;
            font-weight: 800;
        }
    }

    .page-body {
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 0 40px rgb(0 0 0 / 5%);
        height: 80vh;
        max-height: 45rem;
        padding: 2rem 1rem;
    }

</style>