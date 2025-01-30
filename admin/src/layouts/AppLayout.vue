<script setup lang="ts">
    import AppHeader from '../components/AppHeader.vue'
</script>

<template>
  <div class="h-screen">
    <AppHeader />
    <div class="px-4 py-8">
      <slot />
    </div>
  </div>
</template>