<script setup>
import { Head, Link } from "@inertiajs/vue3";
import FrontendLayout from "@/Layouts/Frontend.vue";
import Hero from "@/Components/Frontend/Hero.vue";
// import Promote from "@/Components/Frontend/Promote.vue";
// import About from "@/Components/Frontend/About.vue";
import Services from "@/Components/Frontend/Services.vue";
import ContactMe from "@/Components/Frontend/ContactMe.vue";

defineProps({
  posts: Object,
});
</script>

<template>
  <Head title="Veggie SaiGon" />
  <FrontendLayout>
    <Hero/>
    <Services :posts="posts"/>
    <ContactMe/>
  </FrontendLayout>
</template>

<style></style>
