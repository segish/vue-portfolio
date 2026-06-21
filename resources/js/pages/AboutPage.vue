<script setup>
import { RouterLink } from 'vue-router';
import RevealOnScroll from '../components/RevealOnScroll.vue';
</script>

<template>
    <header class="page-head">
        <div class="wrap">
            <p class="eyebrow">About</p>
            <h1>Tsega Tigneh</h1>
            <p class="lede">Backend-leaning full-stack developer, based in Addis Ababa, Ethiopia.</p>
        </div>
    </header>

    <section class="section">
        <div class="wrap split">
            <RevealOnScroll>
                <div>
                    <p class="mb-[18px] text-muted">
                        I'm a developer who ended up on the backend by preference, not by accident. I like
                        the part of a project where you're deciding how data should actually be shaped,
                        not just how it should look on a screen. Most of my work is in Laravel and Node,
                        with MySQL or MongoDB underneath, deployed to a VPS I've usually set up myself.
                    </p>
                    <p class="mb-[18px] text-muted">
                        Right now a lot of that work is integration-heavy: connecting a Laravel pharmacy
                        system to a government e-invoicing platform, cleaning and migrating thousands of
                        real patient records, that kind of thing. I'm also involved in interviewing
                        developers for a team building Laravel and Blade systems across inventory,
                        clinical, hospital, and project-management software, which has been a useful way
                        to see how other people approach the same kinds of problems.
                    </p>
                    <p class="mb-[18px] text-muted">
                        Outside of code, I've spent time volunteering in rural Ethiopia, doing actual
                        farm work alongside farmers, digging and plowing rather than just showing up to
                        observe. It's a different kind of problem-solving, but the same instinct applies:
                        understand how the thing actually works before you try to improve it.
                    </p>
                    <p class="m-0 text-muted">
                        Looking ahead, I'm working toward a master's in Computer Science or Software
                        Engineering in the US. The plan is to keep building in the meantime, not pause
                        and wait for it.
                    </p>
                </div>
            </RevealOnScroll>

            <div>
                <p class="eyebrow">Path so far</p>
                <RevealOnScroll>
                    <div class="timeline">
                        <div class="tl-item">
                            <div class="tl-label">Foundations</div>
                            <h3 class="mb-1.5 text-[1.05rem]">Internships &amp; training</h3>
                            <p class="m-0 text-[0.95rem] text-muted">
                                Two internships in full-stack and general web development, alongside
                                job-readiness training certified by Dereja.
                            </p>
                        </div>
                        <div class="tl-item">
                            <div class="tl-label">Graduation project</div>
                            <h3 class="mb-1.5 text-[1.05rem]">Adaptive traffic light control</h3>
                            <p class="m-0 text-[0.95rem] text-muted">
                                Real-time, density-based signal timing using OpenCV and Arduino. My first real
                                taste of software that has to work against a physical, moving problem.
                            </p>
                        </div>
                        <div class="tl-item">
                            <div class="tl-label">Into production</div>
                            <h3 class="mb-1.5 text-[1.05rem]">VPS deployment &amp; CI/CD</h3>
                            <p class="m-0 text-[0.95rem] text-muted">
                                Shipped an e-learning platform with a proper Jenkins pipeline, automated
                                deploys included. The work was recognized with an NVIDIA Jetson Nano.
                            </p>
                        </div>
                        <div class="tl-item">
                            <div class="tl-label">Now</div>
                            <h3 class="mb-1.5 text-[1.05rem]">Integrations &amp; bigger systems</h3>
                            <p class="m-0 text-[0.95rem] text-muted">
                                Government e-invoicing integration, large-scale data migration, and helping
                                hire the next people to work on this kind of thing.
                            </p>
                        </div>
                    </div>
                </RevealOnScroll>
            </div>
        </div>
    </section>

    <section class="section-tight">
        <div class="wrap">
            <RevealOnScroll>
                <div class="panel flex flex-wrap items-center justify-between gap-5 p-[34px]">
                    <h2 class="text-[1.4rem]">Want the longer version, or a résumé?</h2>
                    <RouterLink to="/contact" class="btn btn-primary">Reach Out →</RouterLink>
                </div>
            </RevealOnScroll>
        </div>
    </section>
</template>
