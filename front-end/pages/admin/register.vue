<template>
<<<<<<< HEAD
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
=======
  <body class="bg-image">
    <section class="min-h-screen flex items-center justify-center fade-in">
      <div class="bg-orange-300 bg-opacity-20 flex rounded-2xl shadow-lg max-w-3xl p-5 items-center">
        <div class="sm:w-1/2 px-8">
          <h2 class="font-bold text-2xl text-[#1F0805]">Register</h2>
          <p class="text-sm mt-4 text-[#1F0805]">If you're already an Admin, easily log in</p>
          <form class="flex flex-col gap-4" @submit.prevent="handleRegister">
            <div class="form-group">
              <h1 class="text-red-600"></h1>
              <input class="p-2 mt-8 rounded-2xl border w-full" type="text" v-model="state.user.first_name" placeholder="First name">
              <p>{{ getErrorMessage('first_name') }}</p>
            </div>
            <div class="form-group">
              <h1 class="text-red-600"></h1>
              <input class="p-2 rounded-2xl border w-full" type="text" v-model="state.user.last_name" placeholder="Last name">
              <p>{{ getErrorMessage('last_name') }}</p>
            </div>
            <div class="form-group">
              <h1 class="text-red-600"></h1>
              <input class="p-2 rounded-2xl border w-full" type="text" v-model="state.user.age" placeholder="Age">
              <p>{{ getErrorMessage('age') }}</p>
            </div>
            <div class="form-group">
              <h1 class="text-red-600"></h1>
              <input class="p-2 rounded-2xl border w-full" type="email" v-model="state.user.email" placeholder="Email">
              <p>{{ getErrorMessage('email') }}</p>
            </div>
            <div class="form-group">
              <h1 class="text-red-600"></h1>
              <div class="relative">
                <input class="p-2 rounded-2xl border w-full" type="password" v-model="state.user.password" placeholder="Password">
                <p>{{ getErrorMessage('password') }}</p>
                <ion-icon class="absolute top-1/2 right-5 -translate-y-1/2 text-lg" name="eye-outline"></ion-icon>
              </div>
            </div>
            <button class="bg-[#1F0805] rounded-full text-white py-2 hover:scale-105 duration-400" type="submit" name="register">Register</button>
            <div class="bg-[#1F0805] rounded-full text-white py-2 hover:scale-105 duration-400">
              <a class="flex justify-center items-center" href="admin/login"><ion-icon name="arrow-back-outline"></ion-icon>Go back</a>
            </div>
          </form>
        </div>
        <div class="hidden md:block w-1/2">
          <a href="admin/registration"><img class="hover:scale-110 duration-150 rounded-2xl" src="../../img/areu_ok1.jpg" alt=""></a>
        </div>
      </div>
    </section>
  </body>
</template>

<script setup>
import { reactive, onMounted } from 'vue';

const state = reactive({
  errors: [],
  user: {
    first_name: null,
    last_name: null,
    age: null,
    email: null,
    password: null,
  },
});

const getErrorMessage = (field) => {
  const errorData = state.errors?._data?.errors;
  return errorData && errorData[field] ? errorData[field][0] : '';
};

async function handleRegister() {
  const params = {
    first_name: state.user.first_name,
    last_name: state.user.last_name,
    age: state.user.age,
    email: state.user.email,
    password: state.user.password,
  };

  try {
    const response = await $fetch(`http://127.0.0.1:8000/api/admins`, {
      method: 'POST',
      body: params,
    });

    if (response.data) {
      navigateTo('/admin/login');
    }
  } catch (error) {
    state.errors = error.response;
    console.error(error.response);
    console.error('error', error);
  }
}

// Set a timeout to change the color
onMounted(() => {
  const validator = document.getElementById('validator');

  // Set a timeout to change the color
  setTimeout(() => {
    validator.classList.add('hidden');
  }, 1500);
});
</script>

<style scoped>
/* Add your CSS styles here */
.bg-image {
  background-image: url('../../img/help1.jpg');
  background-size: cover;
  background-position: center;
  background-attachment: fixed;
  background-repeat: no-repeat;
}
.fade-in {
  opacity: 0;
  animation: fadeIn 2s ease forwards;
}

@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}
</style>
>>>>>>> origin/master
