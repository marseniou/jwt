<template>
  <div class="container">
    <div class="columns is-marginless">
      <div class="column">
        <h1 class="title">Home</h1>
      </div>
    </div>
  </div>
</template>
<script>
//import { mapState } from 'vuex'
export default {
  middleware: 'auth',
  components: {},
  data() {
    return {
      Errors: {}
    }

  },
  methods: {

  },

  computed: {
    //...mapState([])
  }
}

</script>
