<template>
    <div class="result-page">
        <h1>{{ takerName }}</h1>
        <h2>Depression Type: {{ depressionType }}</h2>

        <!-- Other result page content -->

  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const takerName = ref('');
const depressionType = ref('');

onMounted(fetchResult);

async function fetchResult() {
  try {
    // Replace 'YOUR_API_ENDPOINT' with the actual endpoint for fetching result
    const response = await fetch('YOUR_API_ENDPOINT');
    const data = await response.json();

    // Update taker's name and depression type based on the API response
    takerName.value = data.takerName;
    depressionType.value = data.depressionType;

  } catch (error) {
    console.error('Error fetching result:', error);
    // Handle error if needed
  }
}
</script>

<style lang="scss" scoped>

</style>