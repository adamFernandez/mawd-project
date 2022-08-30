import path from "path";
export default {
  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    title: "nuxt",
    htmlAttrs: {
      lang: "en",
    },
    meta: [
      { charset: "utf-8" },
      { name: "viewport", content: "width=device-width, initial-scale=1" },
      { hid: "description", name: "description", content: "" },
      { name: "format-detection", content: "telephone=no" },
    ],
    link: [{ rel: "icon", type: "image/x-icon", href: "/favicon.ico" }],
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: ["@assets/css/main.css"],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: ["~/plugins/craft.js"],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
    // https://go.nuxtjs.dev/eslint
    "@nuxtjs/eslint-module",
    "@nuxtjs/style-resources",
  ],

  styleResources: {
    scss: ["@assets/scss/mixins.scss", "@assets/scss/variables.scss"],
  },
  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    // https://go.nuxtjs.dev/content
    "@nuxtjs/axios",
  ],
  axios: {
    baseURL: "http://nuxt.localhost:8888/api",
    debug: false,
  },

  // Content module configuration: https://go.nuxtjs.dev/config-content
  content: {},

  privateRuntimeConfig: {
    crafApiBaseUrl: process.env.CRAFT_API_BASE_URL,
    craftApiUrl: process.env.CRAFT_API_URL,
    craftAuthToken: process.env.CRAFT_AUTH_TOKEN,
    craftAssetsPath: process.env.CRAFT_ASSETS_PATH,
  },
  publicRuntimeConfig: {
    crafApiBaseUrl: process.env.CRAFT_API_BASE_URL,
    craftApiUrl: process.env.CRAFT_API_URL,
    craftAuthToken: process.env.CRAFT_AUTH_TOKEN,
    craftAssetsPath: process.env.CRAFT_ASSETS_PATH,
  },

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
    transpile: ["gsap", "MorphSVGPlugin", "SplitText", /^gmap-vue($|\/)/],
    extend(config, ctx) {
      // config.resolve.alias["@root"] = path.resolve(__dirname, "./");
      // config.resolve.alias["@pages"] = path.resolve(__dirname, "pages");
      config.resolve.alias["@c"] = path.resolve(__dirname, "components");
      config.resolve.alias["@assets"] = path.resolve(__dirname, "assets");
      // config.resolve.alias["@utils"] = path.resolve(__dirname, "utils");
      // config.resolve.alias["@store"] = path.resolve(__dirname, "store");
      // config.resolve.alias["@mixins"] = path.resolve(__dirname, "mixins");
      // config.resolve.alias["@constants"] = path.resolve(__dirname, "constants");
      config.resolve.alias["@gql"] = path.resolve(__dirname, "gql");
      // Run ESLint on save
      if (ctx.isDev && ctx.isClient) {
        config.module.rules.push({
          enforce: "pre",
          test: /\.(js|vue)$/,
          loader: "eslint-loader",
          exclude: /(node_modules)/,
        });
      }
    },
  },
};
