<template>
    <footer class="site-footer">
        <div class="wrap">
            <span>{{ contact.location }} // © {{ year }} Tsega Tigneh</span>
            <span>
                <a :href="`tel:${contact.phoneTel}`">Phone</a>
                <a :href="`mailto:${contact.email}`">Email</a>
                <a :href="contact.github.url" target="_blank" rel="noopener">GitHub</a>
                <a :href="contact.linkedin.url" target="_blank" rel="noopener">LinkedIn</a>
                <a :href="contact.telegram.url" target="_blank" rel="noopener">Telegram</a>
            </span>
        </div>
    </footer>
</template>

<script setup>
import { useContact } from '../composables/useContact';

const contact = useContact();
const year = new Date().getFullYear();
</script>
