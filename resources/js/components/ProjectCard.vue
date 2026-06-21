<script setup>
import { computed } from 'vue';
import { RouterLink } from 'vue-router';
import { projectThumbnail } from '../composables/useProjectThumbnail';

const props = defineProps({
    project: {
        type: Object,
        required: true,
    },
    linkable: {
        type: Boolean,
        default: true,
    },
});

const thumb = computed(() => projectThumbnail(props.project));
</script>

<template>
    <component
        :is="linkable ? RouterLink : 'div'"
        :to="linkable ? { name: 'projects', hash: `#${project.slug}` } : undefined"
        class="panel project-card"
        :class="[
            linkable ? 'block' : '',
            thumb ? 'project-card--has-media' : 'project-card--empty',
        ]"
        :id="linkable ? undefined : project.slug"
    >
        <div class="project-card-media" aria-hidden="true">
            <img
                v-if="thumb"
                :src="thumb"
                :alt="`${project.title} preview`"
                loading="lazy"
            />
            <div v-else class="project-card-placeholder">
                <span class="mono">{{ project.tag }}</span>
            </div>
            <div class="project-card-grid"></div>
            <div class="project-card-scan"></div>
        </div>

        <div class="project-card-body">
            <div class="project-card-meta">
                <span class="tag">{{ project.tag }}</span>
                <span v-if="thumb" class="project-card-signal mono">IMG</span>
            </div>
            <h3
                class="project-card-title"
                :class="linkable ? 'text-[1.1rem]' : 'text-[1.25rem]'"
            >
                {{ project.title }}
            </h3>
            <p v-if="project.tech_stack" class="mono project-card-tech">
                {{ project.tech_stack }}
            </p>
            <p class="project-card-text">
                {{ project.excerpt || project.description }}
            </p>
        </div>
    </component>
</template>
