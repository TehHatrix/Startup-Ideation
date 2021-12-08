<template lang="">
    <div>
        <slot />
    </div>
</template>
<script>
export default {
    
}
</script>
<style lang="scss" scoped>
        .notification {

        .notification-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            min-height: 85px;
            margin-bottom: 1rem;
            padding: .5rem 1.5rem;
            overflow: auto;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 15px 20px 0px rgb( 0, 0, 0, .2 );

            transition: all .3s ease-in;

            &:hover {
                background-color: #f7f7f7;
                transform: scale( 0.95 );
                box-shadow: 0px 5px 10px 0px rgb( 0, 0, 0, .2 );
            }
        }


        .notification-item-title, .notification-item-message {
            display: block;
        }

        .notification-item-title {
            font-size: 1.1rem;
        }
        .notification-item-message {
            font-size: 14px;
            color: #929292;
        }
    }

</style>