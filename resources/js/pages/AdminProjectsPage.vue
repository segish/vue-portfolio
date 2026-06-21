<script setup>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import ProjectForm from '../components/ProjectForm.vue';
import { useProjects } from '../composables/useProjects';
import { useAuth } from '../composables/useAuth';
import { apiFetch } from '../composables/useApi';
import { projectThumbnail } from '../composables/useProjectThumbnail';

const router = useRouter();
const { user, logout } = useAuth();
const { projects, loading, error, fetchProjects } = useProjects();
const editing = ref(null);
const showForm = ref(false);

onMounted(() => fetchProjects());

function startCreate() {
    editing.value = null;
    showForm.value = true;
}

function startEdit(project) {
    editing.value = project;
    showForm.value = true;
}

function cancelForm() {
    showForm.value = false;
    editing.value = null;
}

async function onSaved() {
    showForm.value = false;
    editing.value = null;
    await fetchProjects();
}

async function removeProject(project) {
    if (!confirm(`Delete "${project.title}"?`)) return;

    const res = await apiFetch(`/api/projects/${project.slug}`, { method: 'DELETE' });

    if (res.status === 401) {
        router.push({ name: 'login', query: { redirect: '/admin/projects' } });
        return;
    }

    await fetchProjects();
}

async function signOut() {
    await logout();
    router.push({ name: 'home' });
}
</script>

<template>
    <header class="page-head">
        <div class="wrap">
            <div class="flex flex-wrap items-end justify-between gap-4">
                <div>
                    <p class="eyebrow">Admin</p>
                    <h1>Manage Projects</h1>
                    <p class="lede">
                        Add, edit, or remove portfolio projects. Changes appear instantly on the home and projects pages.
                    </p>
                </div>
                <div class="flex flex-col items-end gap-2">
                    <span v-if="user" class="font-mono text-[0.78rem] text-faint">{{ user.email }}</span>
                    <button type="button" class="btn btn-outline" @click="signOut">Sign out</button>
                </div>
            </div>
        </div>
    </header>

    <section class="section-tight">
        <div class="wrap">
            <div class="mb-6">
                <button class="btn btn-primary" @click="startCreate">+ Add Project</button>
            </div>

            <ProjectForm
                v-if="showForm"
                :project="editing"
                @saved="onSaved"
                @cancel="cancelForm"
            />

            <p v-if="loading" class="text-muted">Loading…</p>
            <p v-else-if="error" class="text-red-400">{{ error }}</p>

            <div v-else class="mt-6 grid gap-4">
                <div
                    v-for="project in projects"
                    :key="project.id"
                    class="panel flex flex-wrap items-start justify-between gap-5"
                >
                    <div class="flex min-w-0 flex-1 gap-4">
                        <div class="project-thumb project-thumb--form w-28 shrink-0" :class="{ 'project-thumb--empty': !projectThumbnail(project) }">
                            <img v-if="projectThumbnail(project)" :src="projectThumbnail(project)" :alt="project.title" />
                            <span v-else class="project-thumb-fallback mono text-[0.6rem]">{{ project.tag }}</span>
                        </div>
                        <div class="min-w-0">
                        <span class="tag">{{ project.tag }}</span>
                        <h3 class="mb-1.5 text-[1.1rem]">{{ project.title }}</h3>
                        <p class="mono mb-2 text-[0.78rem] text-faint">/{{ project.slug }}</p>
                        <p class="m-0 text-[0.92rem] text-muted">{{ project.excerpt }}</p>
                        <span
                            v-if="project.featured"
                            class="mt-2.5 inline-block rounded-[3px] border border-signal/40 px-2 py-0.5 font-mono text-[0.72rem] text-signal"
                        >
                            Featured
                        </span>
                        </div>
                    </div>
                    <div class="flex shrink-0 gap-2.5">
                        <button class="btn btn-outline" @click="startEdit(project)">Edit</button>
                        <button class="btn btn-outline hover:border-red-400 hover:text-red-400" @click="removeProject(project)">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
