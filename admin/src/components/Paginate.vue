<script setup lang="ts">
import { computed } from 'vue';

   const props = defineProps<{
    pagination: any,
    offset: number
   }>()

   const emit = defineEmits(['paginate'])

   const isCurrentPage = (page: number) => props.pagination?.current_page === page

   const changePage = (page: number) => {
        if(page > props.pagination?.last_page){
            page = props.pagination?.last_page
        }

        props.pagination.current_page = page
        emit('paginate')
   }

   const pagesForData = computed(()=> {
    let pages = []

    let from = props.pagination?.current_page - Math.floor(props.offset/2)

    if(from < 1) from = 1

    let to = from + props.offset - 1

    if(to > props.pagination?.last_page){
        to = props.pagination?.last_page
    }

    while(from <= to){
        pages.push(from)
        from++
    }

    return pages
   })
</script>

<template>
    <div class="border-t border-gray-200 flex items-center justify-end p-4">        
        <ul class="flex items-center">
            <li>
                <button @click.prevent="changePage(pagination?.current_page - 1)" 
                    :disabled="props.pagination?.current_page <= 1" 
                    :class="[props.pagination?.current_page <= 1 ? 'bg-gray-50 text-gray-300 cursor-not-allowed':'bg-white text-gray-600 hover:bg-indigo-500 border-gray-200 hover:text-white']"
                    class="font-roboto px-4 py-1 border rounded-l-xl">
                Prev</button>
            </li>
            <li v-for="page in pagesForData" :key="page">
                <button @click.prevent="changePage(page)" 
                class="font-roboto px-4 py-1 border"
                :class="[isCurrentPage(page) ? 'bg-indigo-500 text-white border-indigo-500' : 'hover:bg-indigo-500 hover:text-white bg-white text-gray-600 border-gray-200']">{{ page }}</button>
            </li>
            <li>
                <button @click.prevent="changePage(props.pagination?.current_page + 1)" 
                    :disabled="props.pagination?.current_page >= props.pagination?.last_page" 
                    :class="[props.pagination?.current_page >= props.pagination?.last_page ? 'bg-gray-50 text-gray-300 cursor-not-allowed':'bg-white text-gray-600 hover:bg-indigo-500 border-gray-200 hover:text-white']"
                    class="font-roboto px-4 py-1 border rounded-r-xl">Next</button>
            </li>
        </ul>
    </div>
</template>