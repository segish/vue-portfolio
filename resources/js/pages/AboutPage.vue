<script setup>
import { RouterLink } from "vue-router";
import RevealOnScroll from "../components/RevealOnScroll.vue";
</script>

<template>
    <header class="page-head">
        <div class="wrap">
            <p class="eyebrow">About</p>
            <h1>Tsega Tigneh</h1>
            <p class="lede">
                Backend-leaning full-stack developer, based in Addis Ababa,
                Ethiopia.
            </p>
        </div>
    </header>

    <section class="section">
        <div class="wrap split">
            <RevealOnScroll>
                <div>
                    <p class="mb-[18px] text-muted">
                        I’m a developer who naturally gravitated toward backend
                        work. I enjoy shaping how systems behave under the hood
                        more than focusing on visual layers. Most of my
                        experience is with Laravel and Node.js, backed by MySQL
                        or MongoDB, usually deployed on VPS environments I
                        configure and manage myself.
                    </p>
                    <p class="mb-[18px] text-muted">
                        I’ve worked on a mix of real-world systems, including
                        e-commerce platforms, inventory tools, and internal
                        business applications. My focus is usually on building
                        stable APIs, clean data flow, and making sure different
                        parts of a system actually talk to each other without
                        friction.
                    </p>
                    <p class="mb-[18px] text-muted">
                        Outside of client and team work, I’ve also built
                        personal and academic projects that pushed me into areas
                        like machine learning, real-time systems, and hardware
                        integration. My final year project combined AI-based
                        vehicle detection with Arduino-based traffic control,
                        which gave me experience working across software and
                        hardware together.
                    </p>
                    <p class="mb-[18px] text-muted">
                        I’m always looking for new challenges and opportunities
                        to grow as a developer. I’m open to full-time positions,
                        freelance work, or remote opportunities.
                    </p>
                </div>
            </RevealOnScroll>

            <div>
                <p class="eyebrow">Path so far</p>
                <RevealOnScroll>
                    <div class="timeline">
                        <div class="tl-item">
                            <div class="tl-label">Foundations</div>
                            <h3 class="mb-1.5 text-[1.05rem]">
                                Internships & training
                            </h3>
                            <p class="m-0 text-[0.95rem] text-muted">
                                Started with two internships in full-stack web
                                development, gaining hands-on experience
                                building and deploying real applications.
                            </p>
                        </div>

                        <div class="tl-item">
                            <div class="tl-label">Final year project</div>
                            <h3 class="mb-1.5 text-[1.05rem]">
                                AI-based traffic control system
                            </h3>
                            <p class="m-0 text-[0.95rem] text-muted">
                                Built a real-time traffic light control system
                                that used AI and computer vision to measure
                                traffic density and dynamically control signals.
                            </p>
                        </div>

                        <div class="tl-item">
                            <div class="tl-label">Software Developer</div>
                            <h3 class="mb-1.5 text-[1.05rem]">
                                YAT Business Group
                            </h3>
                            <p class="m-0 text-[0.95rem] text-muted">
                                Developed and maintained the company's digital
                                presence, delivering business websites and
                                supporting features that showcased the
                                organization's services and products.
                            </p>
                        </div>

                        <div class="tl-item">
                            <div class="tl-label">Current role</div>
                            <h3 class="mb-1.5 text-[1.05rem]">
                                Keradion Technology
                            </h3>
                            <p class="m-0 text-[0.95rem] text-muted">
                                Developing business systems and integrations
                                across inventory, clinical, production, ERP, HR,
                                project management and other business systems, while supporting
                                large-scale data migration initiatives.
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
                <div
                    class="panel flex flex-wrap items-center justify-between gap-5 p-[34px]"
                >
                    <h2 class="text-[1.4rem]">
                        Want the longer version, or a résumé?
                    </h2>
                    <RouterLink to="/contact" class="btn btn-primary"
                        >Reach Out →</RouterLink
                    >
                </div>
            </RevealOnScroll>
        </div>
    </section>
</template>
