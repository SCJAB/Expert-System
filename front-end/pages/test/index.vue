<template>
  <div>
    <h1>Questions</h1>
    <ul>
      <li v-for="question in questions" :key="question.id">
        {{ question.question }}
        <ul>
          <p v-for="option in question.options" :key="option.id">
            <label>
              <input type="radio" :name="'question_' + question.id" :value="option.id" v-model="selectedOptions[question.id]">
              {{ option.option }}
            </label>
          </p>
        </ul>
      </li>
    </ul>

    <button @click="submitAnswers">Submit Answers</button>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const questions = ref([]);
const selectedOptions = ref({});

onMounted(async () => {
  await fetchQuestions();
});

async function fetchQuestions() {
  const response = await fetch('http://127.0.0.1:8000/api/questions-options');
  const data = await response.json();

  data.questions.forEach(question => {
    selectedOptions.value[question.id] = null;
  });

  questions.value = data.questions;
}

function submitAnswers() {
  console.log(selectedOptions.value);
}
</script>

<!-- <template>
  <div>
    <p>Questions</p>
  </div>
</template>

<script setup>

</script>

<style lang="scss" scoped>

</style> -->