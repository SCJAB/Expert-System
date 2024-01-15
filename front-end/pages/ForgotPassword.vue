<template>
  <div class="flex justify-center items-center h-screen">
    <div class="text-center p-6 border rounded shadow bg-white">
      <h2 class="text-2xl font-bold mb-4">Forgot Password</h2>
      <form @submit.prevent="submitForgotPassword">
        <input v-model="email" type="email" placeholder="Enter your email" class="p-2 border rounded mb-2">
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Submit</button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const email = ref('');

async function submitForgotPassword() {
  try {
    const response = await $fetch(`http://127.0.0.1:8000/api/forgot-password`, {
      method: 'POST',
      body: { email: email.value }
    });

    console.log(response);
    // Handle the response, show a success message or error to the user
  } catch (error) {
    console.error(error);
    // Handle the error, show an error message to the user
  }
}
</script>
