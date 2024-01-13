<template>
    <div class="bg-[#b9b9b8]">
        <header>
            <nav class="flex justify-between p-5">
                <div class="h-20 w-20"><nuxt-link to="/"><img src="~/assets/img/untangled1.png" alt="Untangled"></nuxt-link></div>
                <ul class="flex justify-evenly items-center w-2/5 border border-red">
                    <li><nuxt-link to="/">Home</nuxt-link></li>
                    <li><nuxt-link to="/about">About</nuxt-link></li>
                    <li><nuxt-link to="/login">Login</nuxt-link></li>
                </ul>
            </nav>
        </header>

        <div>
            <slot />
        </div>

        <footer class="bg-[#b9b9b8]">
            <div>
                <div>
                    &copy; Untangled. All rights reserved.
                </div>
                <div>
                    <a href="https://www.facebook.com/klyne15">Facebook</a>
                    <a href="https://www.facebook.com/Skylir01">Twitter</a>
                    <a href="https://www.facebook.com/luis.suizo.1">Instagram</a>
                </div>
            </div>
        </footer>
    </div>
  </template>