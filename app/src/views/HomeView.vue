<template>
  <div class="home">
    <img alt="Vue logo" src="../assets/logo.png">
    <RendezVous />
  </div>
</template>

<script>
// @ is an alias to /src
import RendezVous from '@/components/RendezVous.vue'

export default {
  name: 'HomeView',
  components: {
    RendezVous
  }
}
</script>
