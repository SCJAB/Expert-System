<template>
    <div>
        <header>
            <nav>
                <div><nuxt-link to="/"><img src="" alt=""></nuxt-link></div>
                <ul>
                    <li><nuxt-link to="/">Home</nuxt-link></li>
                    <li><nuxt-link to="/about">About</nuxt-link></li>
                </ul>
            </nav>
        </header>

        <div>
            <slot />
        </div>

        <footer>
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