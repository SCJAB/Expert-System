<template>
    <div class="bg-[#b9b9b8]">
        <header class="shadow-2xl fade-in">
            <nav class="flex justify-between p-3 px-16">
                <nuxt-link to="/" class="h-16 w-16"><img src="~/assets/img/untangled1.png" alt="Untangled"></nuxt-link>
                <div class="flex items-center">
                    <ul class="flex justify-evenly w-56">
                        <li><nuxt-link to="/" class="font-bold text-lg hover:text-[#B8764B] duration-500 button">Home</nuxt-link></li>
                        <li><nuxt-link to="/about" class="font-bold text-lg hover:text-[#B8764B] duration-500 button">About</nuxt-link></li>
                    </ul>
                    <nuxt-link to="/login" class="p-2 font-bold text-lg text-white rounded bg-yellow-700 hover:bg-transparent hover:text-yellow-950 hover:scale-110 duration-500 button">Login</nuxt-link>
                </div>
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