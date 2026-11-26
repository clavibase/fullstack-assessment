<script setup lang="ts">
const apiBase = useRuntimeConfig().public.apiBase
</script>

<template>
  <main>
    <p>Clavibase assessment</p>
    <h1>Property listings</h1>
    <p>
      This page is a placeholder. Build the listing view here, with filters for
      area, price range, and bedrooms, plus pagination.
    </p>
    <p>
      API base URL: <code>{{ apiBase }}</code>
    </p>
  </main>
</template>

<style scoped>
main {
  max-width: 40rem;
  margin: 4rem auto;
  padding: 0 1.5rem;
  color: #1c1917;
  font-family: Georgia, "Times New Roman", serif;
  line-height: 1.5;
}

p:first-child {
  margin: 0;
  font-family: system-ui, sans-serif;
  font-size: 0.8rem;
  letter-spacing: 0.04em;
  text-transform: uppercase;
}

h1 {
  margin: 0.4rem 0 1rem;
  font-size: 2rem;
  font-weight: 500;
}

code {
  font-family: ui-monospace, SFMono-Regular, Menlo, monospace;
  font-size: 0.95em;
}
</style>
