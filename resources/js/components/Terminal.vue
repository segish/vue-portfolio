<script setup>
import { ref, onMounted } from 'vue';

const props = defineProps({
    lines: {
        type: Array,
        required: true,
    },
});

const container = ref(null);

onMounted(() => {
    const term = container.value;
    if (!term) return;

    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (reduceMotion) {
        term.innerHTML = props.lines.map((l) =>
            `<div class="line"><span class="prompt">${l.prompt} </span><span class="${l.out ? 'out' : ''}">${l.text}</span></div>`
        ).join('');
        return;
    }

    let li = 0;

    function typeLine() {
        if (li >= props.lines.length) return;
        const { prompt, text, out } = props.lines[li];
        const row = document.createElement('div');
        row.className = 'line';
        const promptSpan = document.createElement('span');
        promptSpan.className = 'prompt';
        promptSpan.textContent = prompt + ' ';
        const textSpan = document.createElement('span');
        textSpan.className = out ? 'out' : '';
        row.appendChild(promptSpan);
        row.appendChild(textSpan);
        term.appendChild(row);

        let ci = 0;
        const speed = out ? 14 : 38;
        const interval = setInterval(() => {
            textSpan.textContent += text[ci];
            ci++;
            if (ci >= text.length) {
                clearInterval(interval);
                li++;
                setTimeout(typeLine, out ? 480 : 260);
            }
        }, speed);
    }

    typeLine();
});
</script>

<template>
    <div class="term reveal">
        <div class="term-bar"><span></span><span></span><span></span></div>
        <div ref="container" class="term-body"></div>
    </div>
</template>
