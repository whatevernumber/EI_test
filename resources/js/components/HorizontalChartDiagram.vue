<script setup>
import {Chart} from "chart.js/auto";
import {onMounted, ref} from "vue";

const props = defineProps(['dataset']);

let set = props.dataset;

let dataset = [];

set.data.forEach((item) => {
    dataset.push(
        {
            label: item.name,
            data: [item.ei],
        });
});

let ctx = ref();

onMounted(() => {

    new Chart(ctx.value, {
        type: 'bar',
        data: {
            labels: ['EI'],
            datasets: dataset
        },
        options: {
            indexAxis: 'y',
            scales: {
                y: {
                    beginAtZero: true
                }
            },
        }
    });
})

</script>

<template>
    <div class="chart">
        <h2>{{ set.label }}</h2>
        <canvas class="h-chart" ref="ctx"></canvas>
    </div>
</template>

<style scoped>
    .h-chart {
        width: 400px;
    }

    @media (max-width: 1000px) {
        .chart {
            width: 300px;
        }
    }
</style>
