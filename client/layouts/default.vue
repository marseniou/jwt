<template>
  <div>
    <navi />
    <section class="section">
      <Nuxt />
    </section>
  </div>
</template>
<script>
import navi from '@/components/partials/navi'
export default {
  components: { navi },
}

</script>
