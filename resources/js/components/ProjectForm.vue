<script setup>
import { ref, watch, computed } from 'vue';
import { apiFetch } from '../composables/useApi';
import { projectThumbnail } from '../composables/useProjectThumbnail';

const props = defineProps({
    project: {
        type: Object,
        default: null,
    },
});

const emit = defineEmits(['saved', 'cancel']);

const form = ref(emptyForm());
const thumbnailFile = ref(null);
const removeThumbnail = ref(false);
const previewUrl = ref(null);

watch(() => props.project, (p) => {
    form.value = p
        ? { ...p, featured: !!p.featured, thumbnail_url: isExternalUrl(p.thumbnail) ? p.thumbnail : '' }
        : emptyForm();
    thumbnailFile.value = null;
    removeThumbnail.value = false;
    previewUrl.value = null;
}, { immediate: true });

const currentPreview = computed(() => {
    if (previewUrl.value) return previewUrl.value;
    if (removeThumbnail.value) return null;
    return projectThumbnail(props.project);
});

function emptyForm() {
    return {
        title: '',
        slug: '',
        tag: '',
        tech_stack: '',
        excerpt: '',
        description: '',
        thumbnail_url: '',
        featured: false,
        sort_order: 0,
    };
}

function isExternalUrl(value) {
    return typeof value === 'string' && value.startsWith('http');
}

function onFileChange(event) {
    const file = event.target.files?.[0] ?? null;
    thumbnailFile.value = file;
    removeThumbnail.value = false;

    if (previewUrl.value) {
        URL.revokeObjectURL(previewUrl.value);
    }

    previewUrl.value = file ? URL.createObjectURL(file) : null;
}

const saving = ref(false);
const error = ref('');

async function submit() {
    saving.value = true;
    error.value = '';

    const isEdit = !!props.project?.slug;
    const url = isEdit ? `/api/projects/${props.project.slug}` : '/api/projects';

    const body = new FormData();
    body.append('title', form.value.title);
    body.append('tag', form.value.tag);
    body.append('description', form.value.description);
    body.append('featured', form.value.featured ? '1' : '0');
    body.append('sort_order', String(form.value.sort_order ?? 0));

    if (form.value.slug) body.append('slug', form.value.slug);
    if (form.value.tech_stack) body.append('tech_stack', form.value.tech_stack);
    if (form.value.excerpt) body.append('excerpt', form.value.excerpt);
    if (form.value.thumbnail_url) body.append('thumbnail_url', form.value.thumbnail_url);
    if (thumbnailFile.value) body.append('thumbnail', thumbnailFile.value);
    if (removeThumbnail.value) body.append('remove_thumbnail', '1');

    if (isEdit) {
        body.append('_method', 'PUT');
    }

    try {
        const res = await apiFetch(url, {
            method: 'POST',
            body,
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

        <div class="mb-5">
            <span class="form-label">Thumbnail preview</span>
            <div class="project-thumb project-thumb--form" :class="{ 'project-thumb--empty': !currentPreview }">
                <img v-if="currentPreview" :src="currentPreview" alt="Thumbnail preview" />
                <span v-else class="project-thumb-fallback mono">No image</span>
            </div>
        </div>

        <label class="mb-3.5 block">
            <span class="form-label">Upload image</span>
            <input type="file" accept="image/*" class="form-input" @change="onFileChange" />
        </label>

        <label class="mb-3.5 block">
            <span class="form-label">Or image URL</span>
            <input v-model="form.thumbnail_url" class="form-input" type="url" placeholder="https://..." />
        </label>

        <label v-if="project?.thumbnail" class="mb-3.5 flex items-center gap-2.5">
            <input v-model="removeThumbnail" type="checkbox" class="size-4" />
            <span class="font-mono text-sm text-muted">Remove current thumbnail</span>
        </label>

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
