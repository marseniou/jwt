export default {
  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    title: 'client',
    htmlAttrs: {
      lang: 'en'
    },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [
    { src: '@assets/main.scss', lang: 'sass' }
  ],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [

  ],

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    // https://go.nuxtjs.dev/axios


    '@nuxtjs/auth-next',
    '@nuxtjs/laravel-echo',
    '@nuxtjs/axios',
    '@nuxtjs/toast'
  ],

  echo: {
    /* module options */
    broadcaster: 'pusher',
    plugins: ['@/plugins/echo.js'],
    authModule: true,
    /********* change that as well ***********/
    authEndpoint: 'http://authandsockets.test/api/v1/broadcasting/auth',
    connectOnLogin: true,
    key: 'aSiAo5KaLau6uX07OF5UptkHHQyBkD8R',
    wsHost: '127.0.0.1',
    wsPort: 6001,
    disableStats: true,
    forceTLS: false,
  },
  // Axios module configuration: https://go.nuxtjs.dev/config-axios
  axios: {
    baseURL: 'http://authandsockets.test/api'
  },
  auth: {
    redirects: {
      login: '/login',
      home: '/home',
      logout: '/'
    },
    strategies: {
      local: {
        token: {
          property: 'access_token',
          // required: true,
          // type: 'Bearer'
        },
        user: {
          property: 'user',
          //autoFetch: true
        },
        endpoints: {
          login: { url: '/auth/login', method: 'post' },
          logout: { url: '/auth/logout', method: 'post' },
          user: { url: '/auth/me', method: 'get' }
        }
      }
    }
  },
  toast: {
    position: 'bottom-right',
    duration: 3000
  },
  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {}
}
