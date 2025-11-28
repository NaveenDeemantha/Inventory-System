<script setup>
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale,
  ArcElement,
} from 'chart.js'
import { Bar, Pie } from 'vue-chartjs'

ChartJS.register(CategoryScale, LinearScale, BarElement, Title, Tooltip, Legend, ArcElement)

const props = defineProps({
    type: {
        type: String,
        required: true, // 'bar' or 'pie'
    },
    data: {
        type: Object,
        required: true,
    },
    options: {
        type: Object,
        default: () => ({
            responsive: true,
            maintainAspectRatio: false,
        }),
    },
});
</script>

<template>
    <div class="relative h-64 w-full">
        <Bar v-if="type === 'bar'" :data="data" :options="options" />
        <Pie v-if="type === 'pie'" :data="data" :options="options" />
    </div>
</template>
