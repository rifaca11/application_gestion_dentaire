<template>
<div>

  <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <!-- Container wrapper -->
  <div class="container">
    <!-- Navbar brand -->
    <a class="navbar-brand me-2">
      <img
        src="/assets/logo_dent.png"
        loading="lazy"
        style="margin-top: -1px;"
      />
    </a>

    <!-- Toggle button -->
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarButtonsExample"
      aria-controls="navbarButtonsExample"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
     
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarButtonsExample">
      <!-- Left links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="#"><router-link :to="{ name: 'HomeView' }">Home</router-link> </a>
        </li>
         <li class="nav-item">
           <a class="nav-link" href="#">
            <router-link :to="{ name: 'AboutView' }">About</router-link> 
          </a>
           </li>
           <li class="nav-item">
           <a class="nav-link" href="#">
            <router-link :to="{ name: 'SignAccount' }">Sign</router-link>
            </a>
           </li>
           <li class="nav-item">
           <a class="nav-link" href="#">
           <router-link :to="{ name: 'RendezVous' }">Rendez vous</router-link>
            </a>
           </li>
           <li class="nav-item">
           <a class="nav-link" href="#">
            <router-link :to="{ name: 'ListRDV' }">List of RDV</router-link> 
            </a>
           </li>

      </ul>

      </div>
    </div>

  <!-- Container wrapper -->
</nav>
<!-- Navbar -->
  <router-view />
</div>
</template>
<script>

export default {
  name: 'App',
};
</script>
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
  font-weight:300;
  color: #2c3e50;
  text-decoration: none;
}

nav a.router-link-exact-active {
  color:rgb(0, 140, 255);
}
div button{
  text-decoration: none;
  color:white;
}
</style>
