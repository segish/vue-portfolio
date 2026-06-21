<script setup>
import { ref, watch } from 'vue';
import { apiFetch } from '../composables/useApi';

const props = defineProps({
    project: {
        type: Object,
        default: null,
    },
});

const emit = defineEmits(['saved', 'cancel']);

const form = ref(emptyForm());

watch(() => props.project, (p) => {
    form.value = p
        ? { ...p, featured: !!p.featured }
        : emptyForm();
}, { immediate: true });

function emptyForm() {
    return {
        title: '',
        slug: '',
        tag: '',
        tech_stack: '',
        excerpt: '',
        description: '',
        featured: false,
        sort_order: 0,
    };
}

const saving = ref(false);
const error = ref('');

async function submit() {
    saving.value = true;
    error.value = '';

    const isEdit = !!props.project?.slug;
    const url = isEdit ? `/api/projects/${props.project.slug}` : '/api/projects';
    const method = isEdit ? 'PUT' : 'POST';

    try {
        const res = await apiFetch(url, {
            method,
            body: JSON.stringify(form.value),
        });

        if (res.status === 401) {
            throw new Error('Session expired. Please sign in again.');
        }

        if (!res.ok) {
            const data = await res.json();
            throw new Error(data.message || 'Failed to save project');
        }

        emit('saved');
    } catch (e) {
        error.value = e.message;
    } finally {
        saving.value = false;
    }
}
</script>

<template>
    <form class="panel" @submit.prevent="submit">
        <h3 class="mb-5 text-[1.2rem]">{{ project ? 'Edit Project' : 'Add Project' }}</h3>
        <p v-if="error" class="mb-3.5 text-sm text-red-400">{{ error }}</p>

        <label class="mb-3.5 block">
            <span class="form-label">Title</span>
            <input v-model="form.title" class="form-input" required />
        </label>
        <label class="mb-3.5 block">
            <span class="form-label">Slug (optional)</span>
            <input v-model="form.slug" class="form-input" placeholder="auto-generated from title" />
        </label>
        <label class="mb-3.5 block">
            <span class="form-label">Tag</span>
            <input v-model="form.tag" class="form-input" required placeholder="INTEGRATION" />
        </label>
        <label class="mb-3.5 block">
            <span class="form-label">Tech stack</span>
            <input v-model="form.tech_stack" class="form-input" placeholder="Laravel · MySQL" />
        </label>
        <label class="mb-3.5 block">
            <span class="form-label">Excerpt</span>
            <textarea v-model="form.excerpt" class="form-input resize-y" rows="2"></textarea>
        </label>
        <label class="mb-3.5 block">
            <span class="form-label">Description</span>
            <textarea v-model="form.description" class="form-input resize-y" rows="5" required></textarea>
        </label>
        <div class="flex flex-wrap items-end gap-6">
            <label class="flex items-center gap-2.5">
                <input v-model="form.featured" type="checkbox" class="size-4" />
                <span class="font-mono text-sm text-muted">Featured on home page</span>
            </label>
            <label class="block">
                <span class="form-label">Sort order</span>
                <input v-model.number="form.sort_order" class="form-input w-24" type="number" min="0" />
            </label>
        </div>

        <div class="btn-row mt-5">
            <button type="submit" class="btn btn-primary" :disabled="saving">
                {{ saving ? 'Saving…' : (project ? 'Update' : 'Create') }}
            </button>
            <button type="button" class="btn btn-outline" @click="emit('cancel')">Cancel</button>
        </div>
    </form>
</template>
