<template>
  <nav>
    <router-link to="/">Home</router-link> |
    <router-link to="/AboutView">About</router-link> |
   <router-link to="/SignAccount">Sign</router-link> |
    <router-link to="/RendezV">Rendez vous</router-link> |
  </nav>
  <router-view/>
</template>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
}

nav {
  padding: 30px;
}

nav a {
  font-weight: bold;
  color: #2c3e50;
}

nav a.router-link-exact-active {
  color:rgb(0, 140, 255);
}
</style>
