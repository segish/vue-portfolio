<script setup>
import { RouterLink } from 'vue-router';
import RevealOnScroll from '../components/RevealOnScroll.vue';
import Terminal from '../components/Terminal.vue';

const terminalLines = [
    { prompt: '$', text: 'curl /this-page', out: false },
    { prompt: '>', text: 'HTTP/1.1 404 Not Found', out: true },
    { prompt: '$', text: 'ls /', out: false },
    { prompt: '>', text: 'home · projects · skills · about · contact', out: true },
    { prompt: '$', text: 'hint', out: false },
    { prompt: '>', text: 'the route exists in spirit, not on this server', out: true },
];
</script>

<template>
    <header class="page-head">
        <div class="wrap">
            <p class="eyebrow">Error 404</p>
            <h1>This route isn't in the deployment map.</h1>
            <p class="lede">
                The URL you followed doesn't match anything in this app. No drama — pick a
                destination below or head back to the home page.
            </p>
        </div>
    </header>

    <section class="section-tight">
        <div class="wrap split">
            <RevealOnScroll>
                <div class="panel">
                    <span class="tag">NAV</span>
                    <h2 class="mb-4 text-[1.3rem]">Try one of these instead</h2>
                    <div class="flex flex-col gap-3 font-mono text-[0.9rem]">
                        <RouterLink to="/" class="text-muted transition-colors hover:text-accent">/ — Home</RouterLink>
                        <RouterLink to="/projects" class="text-muted transition-colors hover:text-accent">/projects — Work</RouterLink>
                        <RouterLink to="/skills" class="text-muted transition-colors hover:text-accent">/skills — Stack</RouterLink>
                        <RouterLink to="/about" class="text-muted transition-colors hover:text-accent">/about — Background</RouterLink>
                        <RouterLink to="/contact" class="text-muted transition-colors hover:text-accent">/contact — Get in touch</RouterLink>
                    </div>
                    <div class="btn-row mt-8">
                        <RouterLink to="/" class="btn btn-primary">Back to Home →</RouterLink>
                    </div>
                </div>
            </RevealOnScroll>

            <RevealOnScroll>
                <Terminal :lines="terminalLines" />
            </RevealOnScroll>
        </div>
    </section>
</template>
