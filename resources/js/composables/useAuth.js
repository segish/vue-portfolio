import { ref } from 'vue';
import { apiFetch } from './useApi';

const user = ref(null);
const checked = ref(false);
let checkPromise = null;

export function useAuth() {
    async function fetchUser() {
        checkPromise = apiFetch('/api/user');

        try {
            const res = await checkPromise;

            if (res.ok) {
                user.value = await res.json();
            } else {
                user.value = null;
            }
        } catch {
            user.value = null;
        } finally {
            checked.value = true;
            checkPromise = null;
        }

        return user.value;
    }

    async function ensureChecked() {
        if (checked.value) {
            return user.value;
        }

        if (checkPromise) {
            await checkPromise;
            return user.value;
        }

        return fetchUser();
    }

    async function login(email, password, remember = false) {
        const res = await apiFetch('/api/login', {
            method: 'POST',
            body: JSON.stringify({ email, password, remember }),
        });

        if (!res.ok) {
            const data = await res.json();
            const message = data.errors?.email?.[0] ?? data.message ?? 'Login failed.';
            throw new Error(message);
        }

        user.value = await res.json();
        checked.value = true;

        return user.value;
    }

    async function logout() {
        await apiFetch('/api/logout', { method: 'POST' });
        user.value = null;
        checked.value = true;
    }

    function resetAuthCheck() {
        checked.value = false;
        user.value = null;
    }

    return {
        user,
        checked,
        fetchUser,
        ensureChecked,
        login,
        logout,
        resetAuthCheck,
    };
}
