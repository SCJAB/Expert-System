<template>
    <div>
      <h1>Hello, {{ state.user && state.user.first_name }}!</h1>
    </div>
  </template>
  
  <script setup>
const state = reactive({
    user: null,
    result: null
})
    onMounted(()=>{
        checkLogged();
        fetchUser()
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
  </script>
  
  <style scoped>
  /* Add your styling here if needed */
  </style>
  