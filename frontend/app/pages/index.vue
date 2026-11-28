
<script setup lang="ts">
interface Property {
  id: number
  title: string
  area: string
  price_per_night: number
  bedrooms: number
  is_available: boolean
  description: string | null
}

interface PropertyResponse {
  success: boolean
  data: Property[]
  meta: {
    current_page: number
    last_page: number
    per_page: number
    total: number
  }
}

const config = useRuntimeConfig()
const apiBase = config.public.apiBase

const properties = ref<Property[]>([])
const loading = ref(false)
const error = ref('')
const currentPage = ref(1)
const lastPage = ref(1)
const total = ref(0)

const filters = reactive({
  area: '',
  min: '',
  max: '',
  bedrooms: '',
})

const formatPrice = (price: number) =>
  new Intl.NumberFormat('en-NG', {
    style: 'currency',
    currency: 'NGN',
    maximumFractionDigits: 0,
  }).format(price)

let debounceTimer: ReturnType<typeof setTimeout> | undefined

async function fetchProperties(page = 1) {
  loading.value = true
  error.value = ''

  try {
    const params: Record<string, string | number> = {
      page,
      per_page: 6,
    }

    if (filters.area.trim()) params.area = filters.area.trim()
    if (filters.min) params.min = filters.min
    if (filters.max) params.max = filters.max
    if (filters.bedrooms) params.bedrooms = filters.bedrooms

    const response = await $fetch<PropertyResponse>(
      `${apiBase}/api/properties`,
      { params }
    )

    properties.value = response.data
    currentPage.value = response.meta.current_page
    lastPage.value = response.meta.last_page
    total.value = response.meta.total
  } catch {
    error.value = 'Unable to load properties. Please check your connection and try again.'
    properties.value = []
  } finally {
    loading.value = false
  }
}

function applyFilters() {
  clearTimeout(debounceTimer)
  currentPage.value = 1
  fetchProperties(1)
}

function debounceAreaSearch() {
  clearTimeout(debounceTimer)
  debounceTimer = setTimeout(applyFilters, 400)
}

function resetFilters() {
  Object.assign(filters, {
    area: '',
    min: '',
    max: '',
    bedrooms: '',
  })
  applyFilters()
}

function changePage(page: number) {
  if (page < 1 || page > lastPage.value) return
  fetchProperties(page)
}

onMounted(() => fetchProperties())

onBeforeUnmount(() => clearTimeout(debounceTimer))
</script>

<template>
  <main class="page">
    <header class="topbar">
      <a href="/" class="brand">clavibase<span>.</span></a>
      <span class="top-label">SHORTLET COLLECTION</span>
    </header>

    <section class="hero">
      <p class="eyebrow">FIND YOUR NEXT STAY</p>
      <h1>Spaces that feel<br />like <span>home.</span></h1>
      <p class="hero-copy">
        Explore comfortable spaces, thoughtfully selected for your next stay.
      </p>
    </section>

    <section class="listings">
      <div class="section-heading">
        <div>
          <p class="eyebrow">EXPLORE OUR COLLECTION</p>
          <h2>Available properties</h2>
        </div>
        <span class="result-count">{{ total }} properties</span>
      </div>

      <div class="filters">
        <label class="filter-field area-field">
          <span>AREA</span>
          <input
            v-model="filters.area"
            placeholder="Search location..."
            @input="debounceAreaSearch"
            @keyup.enter="applyFilters"
          />
        </label>

        <label class="filter-field">
          <span>MIN. PRICE (₦)</span>
          <input
            v-model="filters.min"
            type="number"
            min="0"
            placeholder="Minimum"
            @keyup.enter="applyFilters"
          />
        </label>

        <label class="filter-field">
          <span>MAX. PRICE (₦)</span>
          <input
            v-model="filters.max"
            type="number"
            min="0"
            placeholder="Maximum"
            @keyup.enter="applyFilters"
          />
        </label>

        <label class="filter-field">
          <span>BEDROOMS</span>
          <select v-model="filters.bedrooms">
            <option value="">Any</option>
            <option value="1">1 bedroom</option>
            <option value="2">2 bedrooms</option>
            <option value="3">3 bedrooms</option>
            <option value="4">4 bedrooms</option>
          </select>
        </label>

        <button class="apply-button" @click="applyFilters">
          Apply filters
        </button>
        <button class="reset-button" @click="resetFilters">
          Reset
        </button>
      </div>

      <div v-if="loading" class="property-grid">
        <div v-for="n in 6" :key="n" class="skeleton"></div>
      </div>

      <div v-else-if="error" class="message">
        <p>{{ error }}</p>
        <button class="apply-button" @click="fetchProperties(currentPage)">
          Try again
        </button>
      </div>

      <div v-else-if="properties.length === 0" class="message">
        <h3>No properties found</h3>
        <p>Try changing your filters to see more results.</p>
        <button class="reset-button" @click="resetFilters">
          Clear filters
        </button>
      </div>

      <div v-else class="property-grid">
        <article
          v-for="property in properties"
          :key="property.id"
          class="property-card"
        >
          <div class="property-image">
            <span class="image-placeholder">PROPERTY {{ property.id }}</span>
            <span
              class="availability"
              :class="{ unavailable: !property.is_available }"
            >
              {{ property.is_available ? 'Available' : 'Unavailable' }}
            </span>
          </div>

          <div class="property-content">
            <p class="property-area">{{ property.area }}</p>
            <h3>{{ property.title }}</h3>

            <p class="description">
              {{ property.description || 'No description provided.' }}
            </p>

            <div class="property-footer">
              <div>
                <strong>{{ formatPrice(property.price_per_night) }}</strong>
                <span class="per-night"> / night</span>
              </div>
              <span class="bedrooms">
                {{ property.bedrooms }} {{ property.bedrooms === 1 ? 'bedroom' : 'bedrooms' }}
              </span>
            </div>
          </div>
        </article>
      </div>

      <div v-if="!loading && properties.length && lastPage > 1" class="pagination">
        <button
          class="page-button"
          :disabled="currentPage === 1"
          @click="changePage(currentPage - 1)"
        >
          Previous
        </button>

        <span>Page {{ currentPage }} of {{ lastPage }}</span>

        <button
          class="page-button"
          :disabled="currentPage === lastPage"
          @click="changePage(currentPage + 1)"
        >
          Next
        </button>
      </div>
    </section>

    <footer>
      <span class="brand">clavibase<span>.</span></span>
      <p>Find a place. Feel at home.</p>
    </footer>
  </main>
</template>

<style>
@import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap');

* {
  box-sizing: border-box;
}

body {
  margin: 0;
  background: #faf9f6;
  color: #252820;
  font-family: 'DM Sans', sans-serif;
}

button, input, select {
  font: inherit;
}

.page {
  max-width: 1240px;
  margin: auto;
  padding: 0 32px;
}

.topbar {
  height: 84px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 1px solid #e9e7e1;
}

.brand {
  color: #252820;
  font-size: 25px;
  font-weight: 700;
  text-decoration: none;
  letter-spacing: -1.5px;
}

.brand span, .hero h1 span {
  color: #8a9565;
}

.top-label, .eyebrow {
  font-size: 11px;
  letter-spacing: 1.5px;
  font-weight: 700;
  color: #8a9565;
}

.hero {
  padding: 85px 0 75px;
}

.hero h1 {
  margin: 18px 0;
  font-family: 'Playfair Display', serif;
  font-size: clamp(46px, 7vw, 76px);
  line-height: 1.08;
  font-weight: 500;
  letter-spacing: -2px;
}

.hero-copy {
  max-width: 420px;
  color: #777970;
  line-height: 1.8;
  font-size: 15px;
}

.section-heading {
  display: flex;
  justify-content: space-between;
  align-items: end;
  margin-bottom: 25px;
}

.section-heading h2 {
  font-family: 'Playfair Display', serif;
  font-size: 32px;
  font-weight: 500;
  margin: 8px 0 0;
}

.result-count {
  color: #777970;
  font-size: 13px;
}

.filters {
  display: flex;
  align-items: end;
  flex-wrap: wrap;
  gap: 12px;
  padding: 20px;
  background: #fff;
  border: 1px solid #ecebe6;
  border-radius: 8px;
  margin-bottom: 32px;
}

.filter-field {
  flex: 1;
  min-width: 125px;
  display: flex;
  flex-direction: column;
  gap: 9px;
}

.filter-field span {
  font-size: 10px;
  font-weight: 700;
  letter-spacing: .8px;
  color: #777970;
}

.filter-field input, .filter-field select {
  width: 100%;
  min-width: 0;
  padding: 11px;
  border: 1px solid #e9e7e1;
  border-radius: 5px;
  background: #fff;
  outline: none;
  color: #252820;
}

.filter-field input:focus, .filter-field select:focus {
  border-color: #8a9565;
}

.apply-button, .reset-button, .page-button {
  padding: 12px 17px;
  border-radius: 5px;
  cursor: pointer;
}

.apply-button {
  border: 1px solid #30382b;
  background: #30382b;
  color: #fff;
}

.reset-button, .page-button {
  border: 1px solid #e4e3dc;
  background: #fff;
  color: #30382b;
}

.property-grid {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 24px;
}

.property-card {
  overflow: hidden;
  border: 1px solid #ecebe6;
  background: #fff;
  border-radius: 8px;
}

.property-image {
  height: 190px;
  background: linear-gradient(135deg, #e8e8dc, #d8ddcf);
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
}

.image-placeholder {
  color: #818674;
  font-size: 11px;
  letter-spacing: 2px;
}

.availability {
  position: absolute;
  top: 14px;
  right: 14px;
  background: #e6eddd;
  color: #50683f;
  padding: 6px 10px;
  border-radius: 20px;
  font-size: 10px;
  font-weight: 700;
}

.availability.unavailable {
  background: #f3e5e2;
  color: #9a554b;
}

.property-content {
  padding: 20px;
}

.property-area {
  color: #8a9565;
  font-size: 12px;
  font-weight: 700;
  margin: 0 0 8px;
}

.property-content h3 {
  font-family: 'Playfair Display', serif;
  font-size: 20px;
  font-weight: 500;
  line-height: 1.4;
  margin: 0 0 10px;
}

.description {
  color: #777970;
  font-size: 12px;
  line-height: 1.7;
  min-height: 60px;
}

.property-footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
  border-top: 1px solid #eeede8;
  padding-top: 16px;
  margin-top: 15px;
  gap: 8px;
}

.property-footer strong {
  font-size: 15px;
}

.per-night, .bedrooms {
  color: #777970;
  font-size: 11px;
}

.message {
  text-align: center;
  padding: 55px 20px;
  background: #fff;
  border: 1px solid #ecebe6;
  border-radius: 8px;
}

.skeleton {
  height: 340px;
  border-radius: 8px;
  background: linear-gradient(90deg, #eeede8 25%, #f7f6f2 50%, #eeede8 75%);
  background-size: 200% 100%;
  animation: shimmer 1.4s infinite;
}

@keyframes shimmer {
  to { background-position: -200% 0; }
}

.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 22px;
  padding: 45px 0;
  font-size: 13px;
}

.page-button:disabled {
  opacity: .4;
  cursor: not-allowed;
}

footer {
  border-top: 1px solid #e9e7e1;
  margin-top: 70px;
  padding: 30px 0;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

footer p {
  color: #777970;
  font-size: 12px;
}

@media (max-width: 850px) {
  .property-grid {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }

  .filters {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }
}

@media (max-width: 560px) {
  .page {
    padding: 0 18px;
  }

  .topbar {
    height: 68px;
  }

  .top-label {
    font-size: 9px;
  }

  .hero {
    padding: 60px 0;
  }

  .section-heading {
    align-items: start;
    flex-direction: column;
    gap: 12px;
  }

  .section-heading h2 {
    font-size: 27px;
  }

  .property-grid {
    grid-template-columns: 1fr;
  }

  .filters {
    grid-template-columns: 1fr;
  }

  footer {
    align-items: start;
    flex-direction: column;
    gap: 12px;
  }
}
</style>
