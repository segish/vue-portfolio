<script setup>
import { ref } from 'vue';
import { useRoute, RouterLink } from 'vue-router';

const route = useRoute();
const menuOpen = ref(false);

const links = [
    { name: 'home', label: 'Home', to: '/' },
    { name: 'projects', label: 'Projects', to: '/projects' },
    { name: 'skills', label: 'Skills', to: '/skills' },
    { name: 'about', label: 'About', to: '/about' },
    { name: 'contact', label: 'Contact', to: '/contact' },
];

function closeMenu() {
    menuOpen.value = false;
}
</script>

<template>
    <nav class="site-nav">
        <div class="wrap">
            <RouterLink to="/" class="brand" @click="closeMenu">
                <span class="mark">TT</span> Tsega Tigneh
            </RouterLink>
            <button class="nav-toggle" aria-label="Toggle menu" @click="menuOpen = !menuOpen">
                <span></span><span></span><span></span>
            </button>
            <div class="nav-links" :class="{ open: menuOpen }">
                <RouterLink
                    v-for="link in links"
                    :key="link.name"
                    :to="link.to"
                    :class="{ active: route.name === link.name }"
                    @click="closeMenu"
                >
                    {{ link.label }}
                </RouterLink>
            </div>
        </div>
    </nav>
</template>
