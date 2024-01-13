<template>
    <div>
        <header>
            <nav>
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
            <div></div>
        </footer>
    </div>
  </template>