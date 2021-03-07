<template>
  
    <div class="columns is-marginless is-centered">
      <div class="column is-6">
        <nav class="card">
          <header class="card-header">
            <p class="card-header-title">
              Register
            </p>
          </header>
          <div class="card-content">
            <div class="field">
              <label class="label">Name</label>
              <div class="control">
                <input class="input" type="text" placeholder="name" v-model="form.name" :class="{ 'is-danger' : errors('name') }">
              </div>
              <div class="help is-danger" v-text="messages('name')"></div>
            </div>
            <div class="field">
              <label class="label">Email</label>
              <div class="control">
                <input class="input" type="text" placeholder="email" v-model="form.email" :class="{ 'is-danger' : errors('email') }">
              </div>
              <div class="help is-danger" v-text="messages('email')"></div>
            </div>
            <div class="field">
              <label class="label">Password</label>
              <div class="control">
                <input class="input" type="password" placeholder="password" v-model="form.password" :class="{ 'is-danger' : errors('password') }">
              </div>
              <div class="help is-danger" v-text="messages('password')"></div>
            </div>
            <div class="field">
              <label class="label">Password Validate</label>
              <div class="control">
                <input class="input" type="password" placeholder="password validate" v-model="form.password_r" :class="{ 'is-danger' : errors('password_r') }">
              </div>
              <div class="help is-danger" v-text="messages('password_r')"></div>
            </div>
            <div class="field is-grouped">
              <div class="control">
                <button class="button is-link" @click="register">Register</button>
              </div>
              <div class="control">
                <button class="button is-text">Cancel</button>
              </div>
            </div>
          </div>
        </nav>
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
      form: {
        name: '',
        email: '',
        password: '',
        password_r: ''
      }
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
    async register() {
      let d = await this.$axios.$post('/auth/register', this.form).catch(e => {
        this.Errors = e.response.data.errors;
      });
      if (d) {
        this.$auth.loginWith('local', {
          data: {
            email: this.form.email,
            password: this.form.password
          }
        })
      }
    }
  },

  computed: {
    ...mapState([])
  }
}

</script>
