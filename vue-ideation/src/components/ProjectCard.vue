<template lang="">
    <div>
        <div class="grid-cols-3 gap-4 grid mx-3">
            <div v-for="project in projects" :key="project.id" class="">
                <section class="c-card my-3" @click="pushId(project.id)">
                    <div class="mt-4">
                        <p class="c-card-title">{{ project.project_name }}</p>
                        <p class="c-card-body">{{ project.project_description }}</p>

                    </div>
                </section>
            </div>
        </div>

    </div>
</template>
<script>
export default {
    name: 'ProjectCard',
    props: ['projects'],
    methods: {
        pushId(projectId) {
            this.$router.push({name: 'Project', params: {id: projectId}})
        }
    }
}
</script>
<style lang="">
    
</style>