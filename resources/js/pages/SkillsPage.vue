<script setup>
import RevealOnScroll from '../components/RevealOnScroll.vue';
</script>

<template>
    <header class="page-head">
        <div class="wrap">
            <p class="eyebrow">How it's wired</p>
            <h1>I tend to draw my own stack the same way I'd draw a client's architecture.</h1>
            <p class="lede">
                Backend-first, with everything else built to support it. This is roughly
                how the pieces connect.
            </p>
        </div>
    </header>

    <section class="section">
        <div class="wrap">
            <RevealOnScroll>
                <div class="panel px-7 pt-8 pb-3">
                    <svg class="block h-auto w-full" viewBox="0 0 1000 420" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Diagram showing backend core connected to languages, data, infrastructure, and client layer">
                        <path class="arch-line" d="M230,210 C 420,210 460,52 670,52" />
                        <path class="arch-line" d="M230,210 C 420,210 460,160 670,160" />
                        <path class="arch-line" d="M230,210 C 420,210 460,268 670,268" />
                        <path class="arch-line" d="M230,210 C 420,210 460,376 670,376" />

                        <g class="arch-node core">
                            <rect x="30" y="170" width="200" height="80" rx="5"></rect>
                            <text x="130" y="205" text-anchor="middle" font-size="13" font-weight="600">BACKEND CORE</text>
                            <text x="130" y="226" text-anchor="middle" class="sub">Laravel · Node.js</text>
                        </g>

                        <g class="arch-node">
                            <rect x="670" y="20" width="270" height="64" rx="5"></rect>
                            <text x="805" y="48" text-anchor="middle" font-size="13" font-weight="600">LANGUAGES &amp; FRAMEWORKS</text>
                            <text x="805" y="68" text-anchor="middle" class="sub">PHP · JS/TS · Python · React</text>
                        </g>

                        <g class="arch-node">
                            <rect x="670" y="128" width="270" height="64" rx="5"></rect>
                            <text x="805" y="156" text-anchor="middle" font-size="13" font-weight="600">DATA LAYER</text>
                            <text x="805" y="176" text-anchor="middle" class="sub">MySQL · MongoDB</text>
                        </g>

                        <g class="arch-node">
                            <rect x="670" y="236" width="270" height="64" rx="5"></rect>
                            <text x="805" y="264" text-anchor="middle" font-size="13" font-weight="600">INFRA &amp; DELIVERY</text>
                            <text x="805" y="284" text-anchor="middle" class="sub">VPS · Nginx · Jenkins</text>
                        </g>

                        <g class="arch-node">
                            <rect x="670" y="344" width="270" height="64" rx="5"></rect>
                            <text x="805" y="372" text-anchor="middle" font-size="13" font-weight="600">CLIENT LAYER</text>
                            <text x="805" y="392" text-anchor="middle" class="sub">Blade · React · Next.js</text>
                        </g>
                    </svg>
                </div>
            </RevealOnScroll>
        </div>
    </section>

    <section class="section-tight">
        <div class="wrap">
            <RevealOnScroll>
                <div class="grid-portfolio grid-2 gap-y-8">
                    <div class="panel">
                        <span class="tag">LANGUAGES &amp; FRAMEWORKS</span>
                        <p class="m-0 text-muted">What I write code in day to day.</p>
                        <div class="mt-3.5 flex flex-wrap gap-2">
                            <span class="chip">PHP / Laravel</span>
                            <span class="chip">JavaScript</span>
                            <span class="chip">Node.js</span>
                            <span class="chip">Python</span>
                            <span class="chip">React</span>
                            <span class="chip">Next.js</span>
                            <span class="chip">Vue.js</span>
                        </div>
                    </div>

                    <div class="panel">
                        <span class="tag">DATA LAYER</span>
                        <p class="m-0 text-muted">Where the actual state of a system lives.</p>
                        <div class="mt-3.5 flex flex-wrap gap-2">
                            <span class="chip">MySQL</span>
                            <span class="chip">MongoDB</span>
                            <span class="chip">Schema design</span>
                            <span class="chip">Data migration &amp; cleaning</span>
                        </div>
                    </div>

                    <div class="panel">
                        <span class="tag">INFRA &amp; DELIVERY</span>
                        <p class="m-0 text-muted">Getting code from a laptop to something that stays running.</p>
                        <div class="mt-3.5 flex flex-wrap gap-2">
                            <span class="chip">VPS deployment</span>
                            <span class="chip">Nginx</span>
                            <span class="chip">Jenkins</span>
                            <span class="chip">GitHub Actions</span>
                            <span class="chip">CI/CD pipelines</span>
                        </div>
                    </div>

                    <div class="panel">
                        <span class="tag">CLIENT LAYER</span>
                        <p class="m-0 text-muted">The part people actually see, kept simple on purpose.</p>
                        <div class="mt-3.5 flex flex-wrap gap-2">
                            <span class="chip">Blade</span>
                            <span class="chip">React</span>
                            <span class="chip">Next.js</span>
                            <span class="chip">Vue.js</span>
                            <span class="chip">Tailwind CSS</span>
                        </div>
                    </div>
                </div>
            </RevealOnScroll>
        </div>
    </section>
</template>
