<script setup>
const props = defineProps(['text']);
</script>

<template>
    <div class="loading">
        <span class="loading_text">{{ props.text ?? '' }}</span>
        <div class="circle">
        </div>
    </div>
</template>

<style scoped>

.loading_text {
    text-transform: uppercase;
    color: #fc7237;
    letter-spacing: 5px;
}

.circle {
    width: 50px;
    height: 50px;
    background-image: url("/resources/img/circle.png");
    background-size: cover;
    animation: 1s infinite loading;
}

@keyframes loading {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
</style>
