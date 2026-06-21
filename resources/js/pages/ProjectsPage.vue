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
            <h1>Systems I've designed, built, or pulled back from the edge.</h1>
            <p class="lede">
                A mix of production integrations, data work, infrastructure, and one
                project that runs on hardware instead of a server. Most of it is backend-first,
                even when there's a frontend attached.
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
                    <h3 class="mb-3 text-[1.2rem]">When a deploy goes wrong</h3>
                    <p class="m-0 text-muted">
                        A `git reset --hard` on a production cPanel server once overwrote a multi-vendor
                        e-commerce project with the wrong repository entirely. No backup, just a server that
                        suddenly looked like a different project. Recovery meant digging through the reflog
                        to find the lost commits and re-cloning the correct history from the team's GitHub
                        organization. Nothing was lost in the end, but it's the kind of incident that changes
                        how carefully you treat a production server afterward.
                    </p>
                </div>
            </RevealOnScroll>
        </div>
    </section>
</template>
