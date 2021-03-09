<template>
  <div>
    <navi />
    <div class="container" v-if="$auth.loggedIn">
    	<p class="is-size-7 has-text-right" style="padding-top:.5rem;padding-right: 1em">
    		{{$auth.user.email}}
    	</p>
    </div>
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
