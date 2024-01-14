<template>
  <div class="flex justify-center items-center h-[89vh]">
    <div>
      <ul :key="currentQuestionIndex">
        <li v-for="(question, index) in questions" :key="question.id" v-show="index === currentQuestionIndex">
          <h1>Question: {{ question.id }}</h1>
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

      <div class="controls">
        <button @click="prevQuestion" :disabled="currentQuestionIndex === 0">Previous</button>
        <button @click="nextQuestion" :disabled="currentQuestionIndex === questions.length - 1">Next</button>
        <button @click="submitAnswers">Submit Answers</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';

const questions = ref([]);
const selectedOptions = ref({});
const currentQuestionIndex = ref(0);
const transitionName = ref('slide-fade');

onMounted(async () => {
  await fetchQuestions();
});

watch(currentQuestionIndex, (newIndex, oldIndex) => {
  transitionName.value = newIndex > oldIndex ? 'slide-fade-left' : 'slide-fade-right';
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

function submitAnswers() {
  console.log(selectedOptions.value);
}
</script>

<style scoped>

</style>