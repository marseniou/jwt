<template>
  <div class="container">
    <div class="columns is-marginless">
      <div class="column is-4">
        <nav class="card">
          <header class="card-header">
            <p class="card-header-title">
              Home
            </p>
          </header>
          <div class="card-content">
            <div class="field">
              <label class="label">Text</label>
              <div class="control">
                <input class="input" type="text" placeholder="text" v-model="text">
              </div>
            </div>
            <button class="button is-primary" @click="broadcast">Broadcast</button>
          </div>
        </nav>
      </div>
    </div>
  </div>
</template>
<script>
//import { mapState } from 'vuex'
export default {
  mounted() {
/*    console.log(this.$auth.strategy.token.get('local'))
    const authData = {

      headers: {
        Authorization: this.$auth.strategy.token.get('local'),
        Accept: 'application/json'
      },
      
    }
    this.$echo.connector.options.auth = authData
    this.$echo.options.authEndpoint = 'http://authandsockets.test/api/v1/broadcasting/auth',
    this.$echo.options.auth = authData*/
    this.$echo.private('App.User.' + this.$auth.user.id)
    //this.$echo.channel('channel')
      .listen('BrEvent', (e) => {
        /*let video = this.videos.find(r=>{
          return r.id.videoId === e.vid*/
        //console.log(e)
        this.$toast.success(e.text)
      })

    //this.$toast.success('"'+video.snippet.title + '" Downloaded',{duration:5000})

  },
  middleware: 'auth',
  components: {},
  data() {
    return {
      Errors: {},
      text: 'text'
    }

  },
  methods: {
    async broadcast() {
      let d = await this.$axios.$post('v1/broadcast', { text: this.text }).catch(e => {
        //this.Errors = e.response.data.errors;
      });
      if (d) {
        //this.$store.commit('set_d', d);
      }
    }
  },

  computed: {
    //...mapState([])
  }
}

</script>
