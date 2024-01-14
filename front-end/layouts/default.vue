<template>
    <div class="bg-[#b9b9b8]">
        <header class="shadow-2xl fade-in">
            <nav class="flex justify-between p-5 px-10">
                <div class="h-16 w-16"><nuxt-link to="/"><img src="~/assets/img/untangled1.png" alt="Untangled"></nuxt-link></div>
                <ul class="flex justify-evenly items-center w-56 border border-red">
                    <li><nuxt-link to="/">Home</nuxt-link></li>
                    <li><nuxt-link to="/about">About</nuxt-link></li>
                    <li><nuxt-link to="/login">Login</nuxt-link></li>
                </ul>
            </nav>
        </header>

        <div class="fade-in">
            <slot />
        </div>

        <footer class="bg-[#b9b9b8] h-32 border-2 flex items-center justify-center fade-in">
            <div class="grid gap-3">
                <div>
                    &copy; {{ new Date().getFullYear() }} Untangled. All rights reserved.
                </div>
                <div class="flex justify-evenly">
                    <a href="https://www.facebook.com/klyne15">Facebook</a>
                    <a href="https://www.facebook.com/Skylir01">Twitter</a>
                    <a href="https://www.facebook.com/luis.suizo.1">Instagram</a>
                </div>
            </div>
        </footer>
    </div>
  </template>