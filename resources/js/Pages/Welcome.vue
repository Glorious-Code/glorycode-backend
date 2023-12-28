<script setup>
import FrontLayout from "@/Layouts/FrontLayout.vue";
import {Link} from "@inertiajs/vue3";

defineProps({
    services: Array
});


</script>

<template>
    <FrontLayout title="Welcome">
        <section class="hero min-h-screen bg-base-200">
            <div class="hero-content text-center">
                <div class="max-w-xl">
                    <h1 class="text-5xl font-bold">Empower Students, Shaping The Future.</h1>
                    <p class="py-6">
                        Are you an aspiring tech enthusiast looking to gain real-world experience while still pursuing your studies? Or are you a forward-thinking company seeking to discover and test the brightest talent of tomorrow? Look no further - Glorious Code is your gateway to excellence in the tech industry.
                    </p>
                    <Link class="btn btn-primary">Coming Soon!</Link>
                </div>
            </div>
        </section>
        <section class="pt-20 pb-12 lg:pt-[120px] lg:pb-[90px]" id="services">
            <div class="container mx-auto">
                <div class="flex flex-wrap -mx-4">
                    <div class="w-full px-4">
                        <div class="mx-auto mb-12 text-center lg:mb-20">
                            <span class="text-primary mb-2 block text-lg font-semibold">
                                Our Platform
                            </span>
                            <h2
                                class="mb-3 text-3xl leading-[1.2] font-bold sm:text-4xl md:text-[40px]"
                            >
                                What We Offer
                            </h2>
                            <p class="text-body-color text-base">
                                A dynamic suite of tech-powered platforms tailored to empower students, talent, and industry professionals, where innovation meets opportunity, and brilliance knows no bounds.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="-mx-4 flex flex-wrap">
                    <div v-for="service in services" class="w-full px-4 pb-4 md:w-1/2 lg:w-1/3">
                        <div class="card w-96 bg-base-200 shadow-xl hover:bg-primary hover:text-white transition ease-in-out delay-100 duration-200">
                            <div class="card-body">
                                <div
                                    class="bg-primary mb-8 flex h-[70px] w-[70px] items-center justify-center rounded-2xl"
                                >
                                    <svg v-html="service['icon']" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-white text-center"></svg>
                                </div>
                                <h2 class="card-title">{{  service["title"] }}</h2>
                                <p>
                                    {{ service["description"] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </FrontLayout>
</template>
