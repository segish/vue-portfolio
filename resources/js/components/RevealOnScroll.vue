<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

const el = ref(null);
let io = null;

onMounted(() => {
    const node = el.value;
    if (!node) return;

    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (reduceMotion || !('IntersectionObserver' in window)) {
        node.classList.add('in');
        return;
    }

    io = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('in');
                io.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12 });

    io.observe(node);
});

onUnmounted(() => io?.disconnect());
</script>

<template>
    <div ref="el" class="reveal">
        <slot />
    </div>
</template>
