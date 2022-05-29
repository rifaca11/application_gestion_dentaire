<template>
<div>

<nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm mt-3 px-5 py-3 py-lg-0">
            <h1 class="m-0 text-primary"><FIcon :icon="['fas','tooth']" />DentCare</h1>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
            <a href="#" class="nav-item nav-link active"><router-link :to="{ name: 'HomeView' }">Home</router-link></a>
            <a href="#" class="nav-item nav-link active"><router-link :to="{ name: 'AboutView' }">About</router-link></a>
             
            <a href="#" class="nav-item nav-link active" v-if="sessionid"><router-link :to="{ name: 'RendezVous' }">Book now</router-link></a>

            <a href="#" class="nav-item nav-link active" v-if="sessionid"><router-link :to="{ name: 'ListRDV' }">List of appointement</router-link></a>
          
            </div>            
            <a href="#" class="btn btn-primary py-2 px-4 ms-3" v-if = "!sessionid"><router-link class="text-light" :to="{ name: 'SignAccount' }">Sign</router-link></a>

             <button class="btn btn-primary py-2 px-4 ms-3" @click="logout()" v-else>Logout</button>


        </div>
    </nav>
    <!-- Navbar End -->
  <router-view />
</div>
</template>
<script>
export default {
  name: 'App',
   data() {
    return {
      sessionid: sessionStorage.getItem('patientId'),
    }
   },
   methods:{
      logout() {
        sessionStorage.clear();
        this.$router.push("/SignAccount");
      }
   }
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
h1{
   font-family: "Jost",sans-serif;
}
</style>
