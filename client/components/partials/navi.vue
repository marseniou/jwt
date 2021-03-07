<template>
  <section class="has-background-primary">
    <nav class="navbar is-primary container" role="navigation" aria-label="main navigation">
      <div class="navbar-brand">
        <div class="navbar-item">Logo</div>
        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" @click="isOpen = !isOpen" v-bind:class="{'is-active': isOpen}">
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
        </a>
      </div>
      <div class="navbar-menu" v-bind:class="{'is-active': isOpen}">
        <div class="navbar-end" v-if="$auth.loggedIn">
          <nuxt-link v-for="item in logged" :key="item.href" :to="item.href" class="navbar-item is-tab" :class="{'is-active':$route.path == item.href}">{{item.text}}</nuxt-link>
        </div>
        <div class="navbar-end" v-else>
          <nuxt-link v-for="item in notlogged" :key="item.href" :to="item.href" class="navbar-item is-tab" :class="{'is-active':$route.path == item.href}">{{item.text}}</nuxt-link>
        </div>
      </div>
    </nav>
  </section>
</template>
<script>
export default {
  data: function() {
    return {
      isOpen: false,
      logged: [
      	
        { href: '/home', text: 'Dashboard' },
        { href: '/logout', text: 'Logout' }
      ],

      notlogged: [
        { href: '/login', text: 'Login' },
        { href: '/register', text: 'Register' }
      ]
    }
  }
}

</script>
