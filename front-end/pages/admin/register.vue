<template>
    <div class="registration-container">
      <h2>Register</h2>
      <form @submit.prevent="handleRegister">
        <div class="form-group">
          <label for="name">First Name:</label>
          <input type="text" id="first_name" v-model="taker.first_name" required>
        </div>
        <div class="form-group">
          <label for="name">Last Name:</label>
          <input type="text" id="last_name" v-model="taker.last_name" required>
        </div>
        <div class="form-group">
          <label for="name">Age:</label>
          <input type="text" id="age" v-model="taker.age" required>
          <span class="error" v-if="this.errorList && this.errorList.age">{{ this.errorList.age[0] }}</span>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" id="email" v-model="taker.email" required>
          <span class="error" v-if="this.errorList && this.errorList.email">{{ this.errorList.email[0] }}</span>
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" id="password" v-model="taker.password" required>
          <span class="error" v-if="this.errorList && this.errorList.password">{{ this.errorList.password[0] }}</span>
        </div>
        <button type="submit">Register</button>
      </form>
    </div>
  </template>
  
  <script setup>
  async function handleRegister(){
    const params = {
        first_name: '',
        last_name: '',
        age: '',
        email: '',
        password: ''
    }
    try{
      const response = await $fetch(`http://127.0.0.1:8000/api/takers`, {
      method: 'POST',
      body: params
    })
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