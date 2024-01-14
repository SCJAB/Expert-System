<template>
    <div class="registration-container">
      <h2>Login</h2>
      <form @submit.prevent="handleLogin()">
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" id="email" v-model="state.user.email">
          <p>{{ state.errors && state.errors._data && state.errors._data.errors && state.errors._data.errors.email && state.errors._data.errors.email[0]}}</p>

        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" id="password" v-model="state.user.password">
          <p>{{ state.errors && state.errors._data && state.errors._data.errors && state.errors._data.errors.password && state.errors._data.errors.password[0]}}</p>
        </div>
        <button type="submit">Login</button>
      </form>
    </div>
  </template>

<script setup>
const state = reactive({
  errors: [],
  user:{
    email: null,
    password: null
  }
})

async function handleLogin(){
  const params = {
    email: state.user.email,
    password: state.user.password
  }
  try{
    const response = await $fetch(`http://127.0.0.1:8000/api/login`, {
    method: 'POST',
    body: params
  })

  if(response.data){
    localStorage.setItem('_token', response.data.token)
    navigateTo('/dashboard'); //kung asa siya mo adto pag mag login na siya like /questionnaires?
  }

  }
  catch(error){
    state.errors = error.response
    console.log(error.response)
    console.log('error', error)
  }
}
</script>

<style scoped>
.registration-container {
  max-width: 400px;
  margin: auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.form-group {
  margin-bottom: 15px;
}

label {
  display: block;
  margin-bottom: 5px;
}

input {
  width: 100%;
  padding: 8px;
  box-sizing: border-box;
  border: 1px solid #ccc;
  border-radius: 3px;
}

button {
  background-color: #4caf50;
  color: white;
  padding: 10px 15px;
  border: none;
  border-radius: 3px;
  cursor: pointer;
}

button:hover {
  background-color: #45a049;
}
</style>