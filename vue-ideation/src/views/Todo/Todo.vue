<template lang="">
    <div class="flex justify-center">
        <section class="container bg-gray-100 px-4 py-4 ">
            <div>

            </div>
        </section>
    </div>
</template>
<script>
export default {
    name: 'Todo',
    async mounted() {
        try {
            await this.$store.dispatch('getTodos', this.$route.params.projectId)
        } catch (error) {
            console.log(error)
        }
    }
}
</script>
<style lang="">
    
</style>