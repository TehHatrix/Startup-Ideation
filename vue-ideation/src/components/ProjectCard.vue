<template lang="">
    <div>
        <div class="">
            <div v-for="project in projects" :key="project.id" class="">
                <section class="c-card bg-white shadow-lg" @click="pushId(project.id)">
                    <div  >
                      <p class="c-card-title">{{ project.project_name }}</p>
                    </div>
                    <div>
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
        margin-top: 1rem;
        margin-bottom: 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .c-card-title {
        text-transform: uppercase;
        font-weight: bold;
        font-size: 1.5rem;
        letter-spacing: 0.25rem;
        padding-right: 1.5rem;
    }

    .c-card-body {
        padding-left: 1.5rem;
    }

    .c-card:hover {
        cursor: pointer;
    }
</style>