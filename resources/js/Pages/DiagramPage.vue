<script setup>
import {ref} from "vue";
import Button from "../components/Button.vue";
import ChartDiagram from "../components/ChartDiagram.vue"
import HorizontalChartDiagram from "../components/HorizontalChartDiagram.vue";
import Loading from "@/components/Loading.vue";

let data = ref();
let loading = ref(false);

const fetchData = async () => {
    loading.value = true;
    const response = await fetch('http://127.0.0.1/api/generate');

    if (response.ok) {
        data.value = await response.json();
        loading.value = false;
    }
}

</script>

<template>
    <div class="diagram_wrapper">
        <div v-if="loading" class="loading_wrapper">
           <Loading />
         </div>
        <div v-if="!loading && data" class="chart_wrapper">
            <div v-for="item in data">
                <ChartDiagram v-if="item.label !== 'Лучшие показатели'" :dataset="item"/>
                <HorizontalChartDiagram v-else-if="item.label === 'Лучшие показатели'" :dataset="item"/>
            </div>
        </div>
        <div class="button_wrapper">
            <Button v-if="!loading" :handler="fetchData" :title="data ? 'Обновить' : 'Сгенерировать статистику'"/>
        </div>
    </div>
</template>

<style scoped>

.diagram_wrapper {
    margin: 0;
    display: flex;
    flex-direction: column;
    row-gap: 25px;
    align-items: center;
    justify-content: center;
}

.chart_wrapper {
    display: flex;
    width: 1000px;
    row-gap: 40px;
    flex-wrap: wrap;
    justify-content: space-between;
}

.button_wrapper, .loading_wrapper {
    text-align: center;
}

@media (max-width: 1000px) {
    .chart_wrapper {
        width: 300px;
        flex-direction: column;
    }
}

</style>
