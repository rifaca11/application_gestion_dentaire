<template>
  <div class="about">
    <AboutDental />
  </div>
</template>

<script>
// @ is an alias to /src
import AboutDental from '@/components/AboutDental.vue'

export default {
  name: 'AboutView',
  components: {
    AboutDental
  }
}
</script>
