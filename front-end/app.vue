<template>
  <div id="app">
    <form @submit.prevent="submitForm">
      <div v-for="question in questions" :key="question.id">
        <p>{{ question.question }}</p>
        <div v-for="option in question.options" :key="option.id">
          <label>
            <input type="radio" :name="'selectedAnswers[' + question.id + ']'" :value="option.id" v-model="selectedAnswers[question.id]">
            {{ option.option }}
          </label><br>
        </div>
      </div>
      <button type="submit">Submit</button>
    </form>
  </div>
</template>
