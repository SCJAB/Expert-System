<template>
  <div class="flex justify-center items-center h-[89vh] text-3xl">
    <div>
      <div class="carousel-container">
        <div v-for="(question, index) in questions" :key="question.id" :class="{ 'hidden': currentQuestionIndex !== index }" class="carousel-slide">
          {{ question.question }}
          <ul>
            <p v-for="option in question.options" :key="option.id">
              <label>
                <input type="radio" :name="'question_' + question.id" :value="option.id" v-model="selectedOptions[question.id]">
                {{ option.option }}
              </label>
            </p>
          </ul>
        </div>
      </div>

      <div class="mt-4">
        <button @click="prevQuestion" :disabled="currentQuestionIndex === 0" class="bg-blue-500 text-white rounded-md">Previous</button>
        <button @click="nextQuestion" :disabled="currentQuestionIndex === questions.length - 1" class="bg-blue-500 text-white rounded-md">Next</button>
        <button @click="submitAnswers" class="bg-green-500 text-white rounded-md">Submit Answers</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const questions = ref([]);
const selectedOptions = ref({});
const currentQuestionIndex = ref(0);

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

function nextQuestion() {
  if (currentQuestionIndex.value < questions.value.length - 1) {
    currentQuestionIndex.value++;
  }
}

function prevQuestion() {
  if (currentQuestionIndex.value > 0) {
    currentQuestionIndex.value--;
  }
}

async function submitAnswers() {
  try {
    const response = await fetch('http://127.0.0.1:8000/api/diagnoses/1', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(selectedOptions.value),
    });

    const data = await response.json();
    console.log(data);
  } catch (error) {
    console.error('Error submitting answers:', error);
  }
}
</script>

<style scoped>

</style>
