<script setup>
defineProps({
  services: Array
});

const classes = {
  section: 'bg-gray-50 dark:bg-gray-900',
  container: 'py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6',
  'container-heading': 'mx-auto max-w-screen-md text-center mb-8 lg:mb-16',
  title: 'mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white',
  subtitle: 'font-light text-gray-500 dark:text-gray-400 sm:text-xl',
  'container-services':
    'space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-8 xl:gap-8 md:space-y-0',
  card: 'p-6 bg-white rounded shadow dark:bg-gray-800',
  'card-icon-container':
    'flex justify-center items-center mb-4 w-10 h-10 rounded bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900',
  'card-icon': 'w-5 h-5 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300',
  'card-title': 'mb-2 text-xl font-bold dark:text-white',
  'card-text': 'font-light text-gray-500 dark:text-gray-400'
};
</script>

<template>
  <section :class="classes['section']">
    <div :class="classes['container']">
      <div :class="classes['container-heading']">
        <h2 :class="classes['title']">Our Platform</h2>
        <p :class="classes['subtitle']">
          A dynamic suite of tech-powered platforms tailored to empower students, talent, and
          industry professionals, where innovation meets opportunity, and brilliance knows no bounds
        </p>
      </div>
      <div :class="classes['container-services']">
        <div v-for="(service, idx) in services" :class="classes['card']" :key="`service-${idx}`">
          <div :class="classes['card-icon-container']">
            <svg
              :class="classes['card-icon']"
              v-html="service['icon']"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
            ></svg>
          </div>
          <h3 :class="classes['card-title']">
            {{ service['title'] }}
          </h3>
          <p :class="classes['card-text']">
            {{ service['description'] }}
          </p>
        </div>
      </div>
    </div>
  </section>
</template>
