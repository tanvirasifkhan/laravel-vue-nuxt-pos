<script setup lang="ts">
    const { loadingText = 'Loading' } = defineProps<{loadingText?: string}>()
</script>

<template>
    <div class="flex flex-col items-center space-y-4 p-16">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10 animate-spin text-gray-600">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
        </svg>
        <p class="font-roboto text-gray-400 text-xl">{{ loadingText }}</p>
    </div>
</template>