<template>
    <div v-if="state.result" class="bg-gradient-to-b from-white to-ffc599">
      <div class="flex justify-center items-center text-xl fade-in">
        <div class="bg-black bg-opacity-45 p-8 rounded-lg shadow-md mt-44 mb-44">
          <h2 class="text-3xl font-semibold mb-4 text-[#ffc599]">Recent Diagnosis:</h2>
          <div class="text-white">
            <p class="mb-2">ID: {{ state.result.id }}</p>
            <p class="mb-2">Taker: {{ state.result.taker }}</p>
            <p class="mb-2">Taken At: {{ state.result.taken_at }}</p>
            <p class="mb-2">Total Score: {{ state.result.total_score }}</p>
            <p class="mb-2">Depression Type: {{ state.result.depression_type?.type }}</p>
          </div>
  
          <h3 class="text-xl font-semibold mt-6 mb-2 text-[#ffc599]">Responses:</h3>
          <ul class="text-white">
            <li v-for="(response, index) in state.result.responses" :key="index" class="mb-4">
              <p class="mb-2"><span class="font-semibold">Question:</span> {{ response.question }}</p>
              <p class="mb-2"><span class="font-semibold text-green-200">Answer:</span> {{ response.answer }}</p>
              <p class="mb-2"><span class="font-semibold">Score:</span> {{ response.score }}</p>
            </li>
          </ul>
        </div>
      </div>
      <div class="flex justify-center items-center pb-44">
          <p>Would you like a copy of your result?</p>
          <button class="ml-10 p-3 bg-yellow-900 text-white rounded-lg hover:scale-110" @click="sendResultEmail(state.result)">Send Copy</button>
        </div>
    </div>
  </template>
  
  <script setup>
  
  const state = reactive({
        user: null,
      result: null
  })
      onMounted(()=>{
          checkLogged();
          fetchUser();
          getResult();
      })
  
      function checkLogged(){
        if(!localStorage.getItem('_token')){
          navigateTo('/login');
        }
      }

      async function fetchUser(){
    try{
        const response = await $fetch(`http://127.0.0.1:8000/api/taker`, {
        method: 'GET',
        headers:{
            'Authorization': 'Bearer ' + localStorage.getItem('_token')
        }
        })
        if(response.data){
            state.user = response.data
        }
        }
    catch(error){
        state.errors = error.response
        console.log('error', error)
    }
    }
  
  
    async function getResult() {
    try {
        const response = await $fetch(`http://127.0.0.1:8000/api/recent-diagnosis`, {
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('_token')
            }
        });

        if (response && response.diagnosis) {
            console.log(response.diagnosis);
            state.result = response.diagnosis;

            // Add a new function to send the result email
        }
    } catch (error) {
        state.errors = error.response;
        console.error('Error fetching recent diagnosis:', error);
    }
}

async function sendResultEmail(result) {
    try {
      console.log('test');
        const response = await $fetch('http://127.0.0.1:8000/api/send-result-email', {
            method: 'POST',
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('_token'),
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ result }),
        });

        console.log(response);
    } catch (error) {
    console.error('Error in send-result-email endpoint:', error);
    // Additional logging or error handling
    res.status(500).json({ error: 'Internal Server Error' });
}
}

  
  </script>
  
  <style scoped>
  
  </style>
  