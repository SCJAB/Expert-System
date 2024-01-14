<template>
  <div class="registration-container">
    <h2>Register</h2>
    <form @submit.prevent="handleRegister">
      <div class="form-group">
        <label for="name">First Name:</label>
        <input type="text" id="first_name" v-model="state.user.first_name">
        <!-- <p>{{ state.errors && state.errors._data && state.errors._data.errors && state.errors._data.errors.first_name && state.errors._data.errors.first_name[0]}}</p> -->
      </div>
      <div class="form-group">
        <label for="name">Last Name:</label>
        <input type="text" id="last_name" v-model="state.user.last_name">
        <!-- <p>{{ state.errors && state.errors._data && state.errors._data.errors && state.errors._data.errors.last_name && state.errors._data.errors.last_name[0]}}</p> -->
      </div>
      <div class="form-group">
        <label for="name">Age:</label>
        <input type="text" id="age" v-model="state.user.age">
        <!-- <p>{{ state.errors && state.errors._data && state.errors._data.errors && state.errors._data.errors.age && state.errors._data.errors.age[0]}}</p> -->
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" v-model="state.user.email">
        <!-- <p>{{ state.errors && state.errors._data && state.errors._data.errors && state.errors._data.errors.email && state.errors._data.errors.email[0]}}</p> -->
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" v-model="state.user.password">
        <!-- <p>{{ state.errors && state.errors._data && state.errors._data.errors && state.errors._data.errors.password && state.errors._data.errors.password[0]}}</p> -->
      </div>
      <button type="submit">Register</button>
    </form>
  </div>
</template>

<script setup>
const state = reactive({
  errors: [],
  user:{
    first_name: null,
    last_name: null,
    age: null,
    email: null,
    password: null
  }
})
async function handleRegister(){
  const params = {
      first_name: state.user.first_name,
      last_name: state.user.last_name,
      age: state.user.age,
      email: state.user.email,
      password: state.user.password
  }
  try{
    const response = await $fetch(`http://127.0.0.1:8000/api/takers`, {
    method: 'POST',
    body: params
  })

  if(response.data){
    navigateTo('/login');
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

.error{
  color: red;
  font-weight: lighter;
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