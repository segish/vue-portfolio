<script setup>
import { RouterLink } from 'vue-router';

defineProps({
    project: {
        type: Object,
        required: true,
    },
    linkable: {
        type: Boolean,
        default: true,
    },
});
</script>

<template>
    <component
        :is="linkable ? RouterLink : 'div'"
        :to="linkable ? { name: 'projects', hash: `#${project.slug}` } : undefined"
        class="panel"
        :class="linkable ? 'block' : ''"
        :id="linkable ? undefined : project.slug"
    >
        <span class="tag">{{ project.tag }}</span>
        <h3
            class="mb-2 font-display font-semibold"
            :class="linkable ? 'text-[1.1rem]' : 'text-[1.25rem]'"
        >
            {{ project.title }}
        </h3>
        <p v-if="project.tech_stack" class="mono mb-3.5 text-[0.78rem] text-faint">
            {{ project.tech_stack }}
        </p>
        <p class="m-0 text-muted" :class="linkable ? 'text-[0.92rem]' : 'text-[0.95rem]'">
            {{ project.excerpt || project.description }}
        </p>
    </component>
</template>
