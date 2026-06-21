import { createRouter, createWebHistory } from 'vue-router';
import HomePage from '../pages/HomePage.vue';
import ProjectsPage from '../pages/ProjectsPage.vue';
import SkillsPage from '../pages/SkillsPage.vue';
import AboutPage from '../pages/AboutPage.vue';
import ContactPage from '../pages/ContactPage.vue';
import LoginPage from '../pages/LoginPage.vue';
import AdminProjectsPage from '../pages/AdminProjectsPage.vue';
import { useAuth } from '../composables/useAuth';

const routes = [
    { path: '/', name: 'home', component: HomePage, meta: { title: 'Home' } },
    { path: '/projects', name: 'projects', component: ProjectsPage, meta: { title: 'Projects' } },
    { path: '/skills', name: 'skills', component: SkillsPage, meta: { title: 'Skills' } },
    { path: '/about', name: 'about', component: AboutPage, meta: { title: 'About' } },
    { path: '/contact', name: 'contact', component: ContactPage, meta: { title: 'Contact' } },
    { path: '/login', name: 'login', component: LoginPage, meta: { title: 'Login', guest: true } },
    {
        path: '/admin/projects',
        name: 'admin-projects',
        component: AdminProjectsPage,
        meta: { title: 'Manage Projects', requiresAuth: true },
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to) {
        if (to.hash) {
            return { el: to.hash, behavior: 'smooth' };
        }
        return { top: 0 };
    },
});

router.beforeEach(async (to) => {
    const { ensureChecked, user } = useAuth();

    if (to.meta.requiresAuth) {
        await ensureChecked();

        if (!user.value) {
            return { name: 'login', query: { redirect: to.fullPath } };
        }
    }

    if (to.meta.guest && to.name === 'login') {
        await ensureChecked();

        if (user.value) {
            return { name: 'admin-projects' };
        }
    }
});

router.afterEach((to) => {
    const base = 'Tsega Tigneh';
    document.title = to.meta.title ? `${to.meta.title} — ${base}` : `${base} — Backend-Leaning Full-Stack Developer`;
});

export default router;
