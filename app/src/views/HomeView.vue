<template>
  <div class="home">
    <HomeComp />
  </div>
</template>

<script>
// @ is an alias to /src
import HomeComp from '@/components/HomeView.vue'

export default {
  name: 'HomeView',
  components: {
    HomeComp
  }
}
</script>
