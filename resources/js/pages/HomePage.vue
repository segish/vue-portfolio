<script setup>
import { onMounted } from 'vue';
import { RouterLink } from 'vue-router';
import Terminal from '../components/Terminal.vue';
import RevealOnScroll from '../components/RevealOnScroll.vue';
import ProjectCard from '../components/ProjectCard.vue';
import { useProjects } from '../composables/useProjects';

const { projects, loading, error, fetchProjects } = useProjects();

const terminalLines = [
    { prompt: '$', text: 'whoami', out: false },
    { prompt: '>', text: 'Tsega Tigneh — backend developer, Addis Ababa', out: true },
    { prompt: '$', text: 'stack --primary', out: false },
    { prompt: '>', text: 'Laravel · Node.js · MySQL · MongoDB', out: true },
    { prompt: '$', text: 'status', out: false },
    { prompt: '>', text: 'open to new projects', out: true },
];

onMounted(() => fetchProjects(true));
</script>

<template>
    <header>
        <div class="wrap hero-split">
            <div>
                <p class="eyebrow">Backend-leaning full-stack developer · Addis Ababa</p>
                <h1 class="mb-[22px] text-[clamp(2.3rem,5vw,3.4rem)] leading-[1.12]">
                    I build the parts of the product nobody sees, and make sure they hold up.
                </h1>
                <p class="lede mb-8">
                    Most of my work happens below the interface: Laravel and Node APIs, database design,
                    the integration that connects one system to another, and the server it all runs on.
                    I like projects where something real depends on the backend being right.
                </p>
                <div class="btn-row">
                    <RouterLink to="/projects" class="btn btn-primary">View Projects →</RouterLink>
                    <RouterLink to="/contact" class="btn btn-outline">Get in Touch</RouterLink>
                </div>
            </div>
            <Terminal :lines="terminalLines" />
        </div>
    </header>

    <section class="section-tight">
        <div class="wrap">
            <p class="eyebrow">What I actually do</p>
            <RevealOnScroll>
                <div class="grid-portfolio grid-3">
                    <div class="panel">
                        <span class="tag">SYS</span>
                        <h3 class="mb-2.5 text-[1.2rem]">Backend Systems</h3>
                        <p class="m-0 text-[0.95rem] text-muted">
                            Laravel and Node APIs, MySQL and MongoDB schema design. Built to handle real
                            transaction volume, not just a demo.
                        </p>
                    </div>
                    <div class="panel">
                        <span class="tag">INTEGRATE</span>
                        <h3 class="mb-2.5 text-[1.2rem]">Integrations</h3>
                        <p class="m-0 text-[0.95rem] text-muted">
                            Wiring internal systems to external ones, like connecting a pharmacy POS to a
                            government e-invoicing platform and keeping it reliable.
                        </p>
                    </div>
                    <div class="panel">
                        <span class="tag">OPS</span>
                        <h3 class="mb-2.5 text-[1.2rem]">Infrastructure</h3>
                        <p class="m-0 text-[0.95rem] text-muted">
                            VPS deployment, Nginx, CI/CD with Jenkins and GitHub Actions. The unglamorous
                            part that decides whether things stay up.
                        </p>
                    </div>
                </div>
            </RevealOnScroll>
        </div>
    </section>

    <section class="section">
        <div class="wrap">
            <div class="mb-7 flex flex-wrap items-end justify-between gap-3.5">
                <div>
                    <p class="eyebrow">Featured work</p>
                    <h2 class="text-[1.7rem]">A few systems I've built recently</h2>
                </div>
                <RouterLink to="/projects" class="btn btn-outline">All Projects →</RouterLink>
            </div>

            <p v-if="loading" class="text-muted">Loading projects…</p>
            <p v-else-if="error" class="text-red-400">{{ error }}</p>
            <RevealOnScroll v-else>
                <div class="grid-portfolio grid-3">
                    <ProjectCard v-for="project in projects" :key="project.id" :project="project" />
                </div>
            </RevealOnScroll>
        </div>
    </section>

    <section class="section-tight">
        <div class="wrap">
            <RevealOnScroll>
                <div class="panel flex flex-wrap items-center justify-between gap-5 p-[38px]">
                    <div>
                        <p class="eyebrow mb-2"><span class="status-dot"></span>&nbsp; Available</p>
                        <h2 class="text-2xl">Have a system that needs building, or fixing?</h2>
                    </div>
                    <RouterLink to="/contact" class="btn btn-primary">Start a Conversation →</RouterLink>
                </div>
            </RevealOnScroll>
        </div>
    </section>
</template>
