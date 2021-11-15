<template lang="">
    <div>
        <div class="">
            <div v-for="project in projects" :key="project.id" class="">
                <section class="c-card bg-white shadow-lg" @click="pushId(project.id)">
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
<style  scoped>
    .bg-white {
        background-color: #fff;
        margin: 1px 2px;
    }

    .c-card {
        border-radius: 0.5rem;
        padding: 0.5rem 1rem;
        margin-top: 0.5rem;
        margin-bottom: 0.rem;
    }
</style>