<script setup>
import {Chart} from "chart.js/auto";
import {onMounted, ref} from "vue";

const props = defineProps(['dataset', 'type']);

let set = props.dataset;

let dataset = [];

for (let [key, value] of Object.entries(set.data)) {

    let numbers = Object.values(value[0]);

    dataset.push({
        label: key,
        data: numbers,
    });
}

let ctx = ref();

onMounted(() => {

    new Chart(ctx.value, {
        type: 'bar',
        data: {
            labels: ['<85', '85-95', '95-105', '105-115', '>115'],
            datasets: dataset
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>

<template>
    <div class="chart">
        <h2>{{ set.label }}</h2>
        <canvas class="chart" ref="ctx"></canvas>
    </div>
</template>

<style scoped>
.chart {
    width: 400px;
}

@media (max-width: 1000px) {
    .chart {
        width: 300px;
    }
}
</style>
