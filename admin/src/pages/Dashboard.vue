<script setup lang="ts">
    import AppLayout from '../layouts/AppLayout.vue'
    import { onMounted } from 'vue'

    onMounted(()=> document.title = 'Dashboard')
</script>

<template>
    <AppLayout>
        <div class="mx-auto my-72 justify-center items-center flex">
          <h2 class="text-gray-600 text-5xl font-roboto">Welcome to Dashboard</h2>
        </div>
    </AppLayout>
</template>