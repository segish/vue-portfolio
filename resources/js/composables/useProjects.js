import { ref } from 'vue';

export function useProjects() {
    const projects = ref([]);
    const loading = ref(false);
    const error = ref('');

    async function fetchProjects(featured = false) {
        loading.value = true;
        error.value = '';

        try {
            const query = featured ? '?featured=1' : '';
            const res = await fetch(`/api/projects${query}`, {
                headers: { Accept: 'application/json' },
            });

            if (!res.ok) throw new Error('Failed to load projects');

            projects.value = await res.json();
        } catch (e) {
            error.value = e.message;
        } finally {
            loading.value = false;
        }
    }

    return { projects, loading, error, fetchProjects };
}
