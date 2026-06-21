<script setup>
import Terminal from '../components/Terminal.vue';
import RevealOnScroll from '../components/RevealOnScroll.vue';
import { useContact } from '../composables/useContact';

const contact = useContact();

const terminalLines = [
    { prompt: '$', text: 'available_for', out: false },
    { prompt: '>', text: 'remote · onsite · contractual · hybrid', out: true },
    { prompt: '$', text: 'focus', out: false },
    { prompt: '>', text: 'backend & full-stack projects, integrations, consulting', out: true },
    { prompt: '$', text: 'response_time', out: false },
    { prompt: '>', text: 'usually within an hour', out: true },
];
</script>

<template>
    <header class="page-head">
        <div class="wrap">
            <p class="eyebrow"><span class="status-dot"></span>&nbsp; Open to new projects</p>
            <h1>Let's talk.</h1>
            <p class="lede">
                Email or Telegram is the fastest way to reach me. I'm in Addis Ababa
                (East Africa Time, UTC+3) and work fine across time zones.
            </p>
        </div>
    </header>

    <section class="section">
        <div class="wrap split">
            <RevealOnScroll>
                <div class="panel">
                    <div class="contact-row">
                        <span class="contact-label">Phone</span>
                        <span class="contact-value">{{ contact.phone }}</span>
                        <a :href="`tel:${contact.phoneTel}`" class="contact-go">Call →</a>
                    </div>
                    <div class="contact-row">
                        <span class="contact-label">Email</span>
                        <span class="contact-value">{{ contact.email }}</span>
                        <a :href="`mailto:${contact.email}`" class="contact-go">Send →</a>
                    </div>
                    <div class="contact-row">
                        <span class="contact-label">GitHub</span>
                        <span class="contact-value">{{ contact.github.label }}</span>
                        <a :href="contact.github.url" class="contact-go" target="_blank" rel="noopener">Visit →</a>
                    </div>
                    <div class="contact-row">
                        <span class="contact-label">LinkedIn</span>
                        <span class="contact-value">{{ contact.linkedin.label }}</span>
                        <a :href="contact.linkedin.url" class="contact-go" target="_blank" rel="noopener">Visit →</a>
                    </div>
                    <div class="contact-row">
                        <span class="contact-label">Telegram</span>
                        <span class="contact-value">{{ contact.telegram.label }}</span>
                        <a :href="contact.telegram.url" class="contact-go" target="_blank" rel="noopener">Message →</a>
                    </div>
                    <div class="contact-row">
                        <span class="contact-label">Location</span>
                        <span class="contact-value">{{ contact.location }}</span>
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
