<script setup>
import Terminal from '../components/Terminal.vue';
import RevealOnScroll from '../components/RevealOnScroll.vue';

const terminalLines = [
    { prompt: '$', text: 'available_for', out: false },
    { prompt: '>', text: 'backend & full-stack projects, integrations, consulting', out: true },
    { prompt: '$', text: 'response_time', out: false },
    { prompt: '>', text: 'usually within a day', out: true },
];
</script>

<template>
    <header class="page-head">
        <div class="wrap">
            <p class="eyebrow"><span class="status-dot"></span>&nbsp; Open to new projects</p>
            <h1>Let's talk.</h1>
            <p class="lede">
                Email is the most reliable way to reach me. I'm in Addis Ababa
                (East Africa Time, UTC+3) and work fine across time zones.
            </p>
        </div>
    </header>

    <section class="section">
        <div class="wrap split">
            <RevealOnScroll>
                <div class="panel">
                    <div class="contact-row">
                        <span class="contact-label">Email</span>
                        <span class="contact-value">your-email@example.com</span>
                        <a href="mailto:your-email@example.com" class="contact-go">Send →</a>
                    </div>
                    <div class="contact-row">
                        <span class="contact-label">GitHub</span>
                        <span class="contact-value">github.com/your-username</span>
                        <a href="https://github.com/your-username" class="contact-go" target="_blank" rel="noopener">Visit →</a>
                    </div>
                    <div class="contact-row">
                        <span class="contact-label">LinkedIn</span>
                        <span class="contact-value">linkedin.com/in/your-profile</span>
                        <a href="https://linkedin.com/in/your-profile" class="contact-go" target="_blank" rel="noopener">Visit →</a>
                    </div>
                    <div class="contact-row">
                        <span class="contact-label">Location</span>
                        <span class="contact-value">Addis Ababa, Ethiopia</span>
                        <span></span>
                    </div>
                </div>
            </RevealOnScroll>

            <RevealOnScroll>
                <Terminal :lines="terminalLines" />
            </RevealOnScroll>
        </div>
    </section>
</template>
