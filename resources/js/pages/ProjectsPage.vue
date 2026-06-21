<script setup>
import { onMounted } from 'vue';
import RevealOnScroll from '../components/RevealOnScroll.vue';
import ProjectCard from '../components/ProjectCard.vue';
import { useProjects } from '../composables/useProjects';

const { projects, loading, error, fetchProjects } = useProjects();

onMounted(() => fetchProjects());
</script>

<template>
    <header class="page-head">
        <div class="wrap">
            <p class="eyebrow">Selected work</p>
            <h1>Systems I’ve built and contributed to.</h1>
            <p class="lede">
                Backend systems, integrations, data pipelines, and infrastructure work. 
                Most projects are backend-focused with supporting frontend layers where needed.
            </p>
        </div>
    </header>

    <section class="section">
        <div class="wrap">
            <p v-if="loading" class="text-muted">Loading projects…</p>
            <p v-else-if="error" class="text-red-400">{{ error }}</p>
            <RevealOnScroll v-else>
                <div class="grid-portfolio grid-2">
                    <ProjectCard
                        v-for="project in projects"
                        :key="project.id"
                        :project="project"
                        :linkable="false"
                    />
                </div>
            </RevealOnScroll>
        </div>
    </section>

    <section class="section-tight">
        <div class="wrap">
            <RevealOnScroll>
                <div class="panel">
                    <p class="eyebrow mb-3.5">Field notes</p>
                    <h3 class="mb-3 text-[1.2rem]">What ties it all together</h3>
                    <p class="m-0 text-muted">
                        Across these projects, I focus on building backend-heavy 
                        systems that are reliable, maintainable, and production-ready. 
                        Most work includes APIs, integrations, and deployment setups that 
                        connect real systems together.
                    </p>
                </div>
            </RevealOnScroll>
        </div>
    </section>
</template>
