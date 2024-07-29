<script setup>
import DiagramPage from "./Pages/DiagramPage.vue";
</script>

<template>
    <main class="main_wrapper">
        <DiagramPage/>
    </main>
</template>

<style scoped>
    .main_wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: calc(100vh - 10vh);
        padding: 5vh 0;
    }
</style>
