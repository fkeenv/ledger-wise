<template>
  <div class="min-h-screen bg-gray-100 dark:bg-black p-8 flex flex-col">
    <header class="flex w-full items-center justify-between">
      <div>
        iam@keenvergara.dev
      </div>

      <div class="flex items-center space-x-4">
        <GuestHomeColorMode />
      </div>
    </header>

    <main class="flex-grow flex items-center justify-center">
      <GuestHomeTerminal class="w-full" />
    </main>
  </div>
</template>

<script setup lang="ts">
definePageMeta({
  title: 'Keen',
  description: 'Keen is a modern CMS for developers',
  layout: 'guest',
})
</script>
