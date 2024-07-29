<script setup>
const props = defineProps(['handler', 'title']);
</script>

<template>
    <button v-on:click="props.handler" class="button">{{ props.title }}</button>
</template>

<style scoped>
.button {
    padding: 15px 25px;
    background-color: #9fa86b;
    border: none;
    border-radius: 5px;
    color: #f2f2f2;
    font-weight: bold;
    text-transform: uppercase;
    cursor: pointer;
    animation: 3s infinite color_change;
}

button:hover {
    background-color: #e0ad47;
}

@keyframes color_change {
    0% {
        background-color: #9fa86b;
    }
    50% {
        background-color: #ffde67;
    }

    70% {
        background-color: #fc7237;
    }
    100% {
        background-color: #9fa86b;
    }
}
</style>
