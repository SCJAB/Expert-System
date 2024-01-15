<template>
    <div v-if="state.result">
        <h2>Recent Diagnosis:</h2>
        <p>ID: {{ state.result.id }}</p>
        <p>Taker: {{ state.result.taker }}</p>
        <p>Taken At: {{ state.result.taken_at }}</p>
        <p>Total Score: {{ state.result.total_score }}</p>
        <p>Depression Type: {{ state.result.depression_type?.type }}</p>

        <h3>Responses:</h3>
        <ul>
          <li v-for="(response, index) in state.result.responses" :key="index">
            <p>Question: {{ response.question }}</p>
            <p>Answer: {{ response.answer }}</p>
            <p>Score: {{ response.score }}</p>
          </li>
        </ul>
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
    }
  } catch (error) {
    state.errors = error.response;
    console.error('Error fetching recent diagnosis:', error);
  }
}
  
  </script>
  
  <style scoped>
  
  </style>
  