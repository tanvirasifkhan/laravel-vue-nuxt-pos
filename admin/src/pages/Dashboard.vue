<script setup lang="ts">
    import AppLayout from '../layouts/AppLayout.vue'
    import { onMounted } from 'vue'

    onMounted(()=> document.title = 'Dashboard')
</script>

<template>
    <AppLayout>
        <div class="w-10/12 mx-auto">
          <h2 class="text-gray-600 text-xl font-roboto">Welcome to Dashboard</h2>
        </div>
    </AppLayout>
</template>