<template>
  
    <div class="container">
      <div class="columns is-marginless is-centered">
        <div class="column is-6">
          <nav class="card">
            <header class="card-header">
              <p class="card-header-title">
                Login
              </p>
            </header>
            <div class="card-content">
              <div class="field">
                <label class="label">Email</label>
                <div class="control">
                  <input class="input" type="text" placeholder="email" v-model="email" :class="{ 'is-danger' : errors('email') }">
                </div>
                <div class="help is-danger" v-text="messages('email')"></div>
              </div>
              <div class="field">
                <label class="label">Password</label>
                <div class="control">
                  <input class="input" type="password" placeholder="password" v-model="password" :class="{ 'is-danger' : errors('password') }">
                </div>
                <div class="help is-danger" v-text="messages('password')"></div>
              </div>
              <div class="field is-grouped">
                <div class="control">
                  <button class="button is-link" @click="login">Login</button>
                </div>
                <div class="control">
                  <button class="button is-text">Cancel</button>
                </div>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </div>
  
</template>
<script>
import { mapState } from 'vuex'
export default {
  layout: '',
  components: {},
  data() {
    return {
      Errors: {},

      email: '',
      password: ''

    }

  },
  methods: {
    errors(w) {
      return this.Errors[w] ? true : false;
    },
    messages(w) {
      if (this.Errors && this.Errors[w]) {
        return this.Errors[w][0]
      }
    },
    async login() {
      await this.$auth.loginWith('local', {
          data: {
            email: this.email,
            password: this.password
          }
        })
      /*let d = await this.$axios.$post('/auth/login', { email: this.email, password: this.password }).catch(e => {
        this.Errors = e.response.data.errors;
      });
      if (d) {
        //this.$store.commit('set_d', d);
        this.$auth.loginWith('local', {
          data: {
            email: this.email,
            password: this.password
          }
        })
      }*/
    }
  },

  computed: {
    //...mapState([])
  }
}

</script>
