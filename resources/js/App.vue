<script setup>
import SiteNav from './components/SiteNav.vue';
import SiteFooter from './components/SiteFooter.vue';
</script>

<template>
    <SiteNav />
    <main>
        <RouterView />
    </main>
    <SiteFooter />
</template>
