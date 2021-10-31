<template lang="">
    <div class="auth-page">
        <auth-card > </auth-card>
    </div>
</template>
<script>
import AuthCard from '@/components/authentication/AuthCard.vue'

export default {
    name: 'Authentication',
    components: {
        'auth-card': AuthCard
    }
}
</script>
<style lang="">
    
</style>