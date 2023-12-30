<script setup>
const classes = {
  section: 'bg-white dark:bg-gray-900',
  container: 'py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12',
  alert:
    'inline-flex justify-between items-center py-1 px-1 pr-4 mb-7 text-sm text-gray-700 bg-gray-100 rounded-full dark:bg-gray-800 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700',
  'alert-cta': 'text-xs bg-primary-600 rounded-full text-white px-4 py-1.5 mr-3',
  'alert-text': 'text-sm font-medium',
  'alert-icon': 'ml-2 w-4 h-4',
  title:
    'mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white',
  text: 'mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400'
};
</script>

<template>
  <section :class="classes['section']">
    <div :class="classes['container']">
      <a href="#" :class="classes['alert']" role="alert">
        <span :class="classes['alert-cta']">Coming Soon!</span>
        <span :class="classes['alert-text']">Our platforms are still in development</span>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          :class="classes['alert-icon']"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5"
          />
        </svg>
      </a>
      <h1 :class="classes['title']">Empower Students, Shaping The Future</h1>
      <p :class="classes['text']">
        Are you an aspiring tech enthusiast looking to gain real-world experience while still
        pursuing your studies? Or are you a forward-thinking company seeking to discover and test
        the brightest talent of tomorrow? Look no further - Glorious Code is your gateway to
        excellence in the tech industry.
      </p>
    </div>
  </section>
</template>
