<script setup lang="ts">
    import AppLayout from '../../layouts/AppLayout.vue'
    import Paginate from '../../components/Paginate.vue'
    import NoData from '../../components/NoData.vue'
    import { onMounted, ref } from 'vue'
    import { useCategoryStore } from '../../store/categoryStore'
    import { useNotification } from '@kyvg/vue3-notification'

    const categoryStore = useCategoryStore()
    const { notify }  = useNotification()
    const searchKeyword = ref<string>('')

    onMounted(()=> document.title = 'Category List')

    onMounted(()=> categoryStore.paginatedList(1))

    const deleteCategory = (id: number) => {
        if(confirm('Do you want to delete this category ?')){
            categoryStore.removeCategory(id).then((response)=> {
                notify({
                    type: "success",
                    title: "Delete Category",
                    text: response.data.successMessage,
                })
                
                categoryStore.paginatedList(1)
            })   
        }             
    }
</script>

<template>
    <AppLayout>
        <div class="w-8/12 mx-auto">            
            <div class="bg-white border border-gray-100 rounded-lg mt-7">
                <div class="border-b border-gray-200 flex items-center justify-between py-3 px-5">
                    <h2 class="font-roboto text-gray-700 text-lg">Category List</h2>
                    <form @submit.prevent="categoryStore.searchCategory(searchKeyword)" v-if="categoryStore.categories.length > 0" class="w-6/12 flex justify-end space-x-1.5">
                        <input v-model="searchKeyword" type="text" placeholder="Search Category" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                        <button :class="searchKeyword === '' ? 'cursor-not-allowed' : ''" :disabled="searchKeyword === ''" class="bg-indigo-500 hover:bg-indigo-700 text-white font-roboto py-1.5 px-4 rounded-3xl">Search</button>
                    </form>
                </div>
                <NoData v-if="categoryStore.categories.length === 0" />
                <table v-else class="w-full">
                    <thead>
                        <tr class="bg-gray-100 border-b border-gray-200">
                            <th class="text-left py-3 px-5 font-roboto text-gray-700 font-normal uppercase text-sm whitespace-nowrap">Title</th>
                            <th class="text-left py-3 px-5 font-roboto text-gray-700 font-normal uppercase text-sm whitespace-nowrap">Slug</th>
                            <th class="p-3 text-gray-600 font-roboto font-normal flex items-center space-x-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="category in categoryStore.categories" :key="category.id" :class="[category.id % 2 === 0 ? 'bg-gray-50' : '']">
                            <td class="py-3 px-5 text-gray-600 font-roboto">{{ category.title }}</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">{{ category.slug }}</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto space-x-2">
                                <RouterLink :to="{name: 'update-category', params: {id: category.id}}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-roboto py-1.5 px-4 rounded-3xl">Edit</RouterLink>
                                <button @click.prevent="deleteCategory(category.id)" class="bg-red-500 hover:bg-red-700 text-white font-roboto py-1 px-4 rounded-3xl">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <Paginate v-if="categoryStore.categories.length > 0" :pagination="categoryStore.pagination" :offset="3" @paginate="categoryStore.paginatedList(categoryStore.pagination.current_page)" />
            </div>          
        </div>
    </AppLayout>
</template>