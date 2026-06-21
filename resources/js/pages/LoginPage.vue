<script setup>
import { ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { useAuth } from '../composables/useAuth';

const route = useRoute();
const router = useRouter();
const { login } = useAuth();

const email = ref('');
const password = ref('');
const remember = ref(false);
const error = ref('');
const loading = ref(false);

async function submit() {
    loading.value = true;
    error.value = '';

    try {
        await login(email.value, password.value, remember.value);
        const redirect = typeof route.query.redirect === 'string' ? route.query.redirect : '/admin/projects';
        router.replace(redirect);
    } catch (e) {
        error.value = e.message;
    } finally {
        loading.value = false;
    }
}
</script>

<template>
    <header class="page-head">
        <div class="wrap">
            <p class="eyebrow">Admin</p>
            <h1>Sign in</h1>
            <p class="lede">Use your admin credentials to manage portfolio projects.</p>
        </div>
    </header>

    <section class="section-tight">
        <div class="wrap">
            <form class="panel mx-auto max-w-md" @submit.prevent="submit">
                <p v-if="error" class="mb-4 text-sm text-red-400">{{ error }}</p>

                <label class="mb-3.5 block">
                    <span class="form-label">Email</span>
                    <input v-model="email" class="form-input" type="email" required autocomplete="username" />
                </label>

                <label class="mb-3.5 block">
                    <span class="form-label">Password</span>
                    <input v-model="password" class="form-input" type="password" required autocomplete="current-password" />
                </label>

                <label class="mb-5 flex items-center gap-2.5">
                    <input v-model="remember" type="checkbox" class="size-4" />
                    <span class="font-mono text-sm text-muted">Remember me</span>
                </label>

                <button type="submit" class="btn btn-primary w-full justify-center" :disabled="loading">
                    {{ loading ? 'Signing in…' : 'Sign in' }}
                </button>
            </form>
        </div>
    </section>
</template>
