// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2026-11-26',
  runtimeConfig: {
    public: {
      // Overridden by NUXT_PUBLIC_API_BASE.
      apiBase: 'http://localhost:8000',
    },
  },
})
