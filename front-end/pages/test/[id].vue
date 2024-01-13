<template>
  <div>
    <p>Question {{ id }}</p>
    <p v-if="question" :key="question.id">
      {{ question.question }}
      <ul>
          <p v-for="option in question.options" :key="option.id">
            <label>
              <input type="radio" :name="'question_' + question.id" :value="option.id" v-model="selectedOptions[question.id]">
              {{ option.option }}
            </label>
          </p>
        </ul>
    </p>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
const { id } = useRoute().params;

const question = ref(null);

onMounted(async () => {
  await fetchQuestion();
});

async function fetchQuestion() {
  const response = await fetch(`http://127.0.0.1:8000/api/questions/${id}`);
  const data = await response.json();

  question.value = data.question;
}
</script>

<style scoped>
</style>