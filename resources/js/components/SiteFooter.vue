<template>
    <footer class="site-footer">
        <div class="wrap">
            <span>Addis Ababa, Ethiopia // © {{ year }} Tsega Tigneh</span>
            <span>
                <a href="mailto:your-email@example.com">Email</a>
                <a href="https://github.com/your-username" target="_blank" rel="noopener">GitHub</a>
                <a href="https://linkedin.com/in/your-profile" target="_blank" rel="noopener">LinkedIn</a>
            </span>
        </div>
    </footer>
</template>

<script setup>
const year = new Date().getFullYear();
</script>
