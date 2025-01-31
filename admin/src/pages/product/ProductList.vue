<script setup lang="ts">
    import AppLayout from '../../layouts/AppLayout.vue'
    import Paginate from '../../components/Paginate.vue'
    import NoData from '../../components/NoData.vue'
    import { onMounted, ref } from 'vue'
    import { useProductStore } from '../../store/productStore'
    import { useNotification } from '@kyvg/vue3-notification'

    const productStore = useProductStore()
    const { notify }  = useNotification()
    const searchKeyword = ref<string>('')

    onMounted(()=> document.title = 'Product List')

    onMounted(()=> productStore.paginatedList(1))

    const deleteProduct = (id: number) => {
        if(confirm('Do you want to delete this product ?')){
            productStore.removeProduct(id).then((response)=> {
                notify({
                    type: "success",
                    title: "Delete Product",
                    text: response.data.successMessage,
                })
                
                productStore.paginatedList(1)
            })   
        }             
    }
</script>

<template>
    <AppLayout>
        <div class="w-8/12 mx-auto">            
            <div class="bg-white border border-gray-100 rounded-lg mt-7">
                <div class="border-b border-gray-200 flex items-center justify-between py-3 px-5">
                    <h2 class="font-roboto text-gray-700 text-lg">Product List</h2>
                    <form @submit.prevent="productStore.searchProduct(searchKeyword)" v-if="productStore.products.length > 0" class="w-6/12 flex justify-end space-x-1.5">
                        <input type="text" v-model="searchKeyword" placeholder="Search Product" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                        <button :class="searchKeyword === '' ? 'cursor-not-allowed' : ''" :disabled="searchKeyword === ''" class="bg-indigo-500 hover:bg-indigo-700 text-white font-roboto py-1.5 px-4 rounded-3xl">Search</button>
                    </form>
                </div>
                <NoData v-if="productStore.products.length === 0" />
                <table v-else class="w-full">
                    <thead>
                        <tr class="bg-gray-100 border-b border-gray-200">
                            <th class="text-left py-3 px-5 font-roboto text-gray-700 font-normal uppercase text-sm whitespace-nowrap">Name</th>
                            <th class="text-left py-3 px-5 font-roboto text-gray-700 font-normal uppercase text-sm whitespace-nowrap">Category</th>
                            <th class="text-left py-3 px-5 font-roboto text-gray-700 font-normal uppercase text-sm whitespace-nowrap">SKU</th>
                            <th class="text-left py-3 px-5 font-roboto text-gray-700 font-normal uppercase text-sm whitespace-nowrap">Price</th>
                            <th class="text-left py-3 px-5 font-roboto text-gray-700 font-normal uppercase text-sm whitespace-nowrap">Quantity</th>
                            <th class="p-3 text-gray-600 font-roboto font-normal flex items-center space-x-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product in productStore.products" :key="product.id" :class="[product.id % 2 === 0 ? 'bg-gray-50' : '']">
                            <td class="py-3 px-5 text-gray-600 font-roboto">{{ product.name }}</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">{{ product.category ? product.category.title : 'N/A' }}</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">{{ product.sku }}</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">{{ product.per_unit_price }}</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">{{ product.quantity }}</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto space-x-2">
                                <RouterLink :to="{name: 'update-product', params: {id: product.id}}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-roboto py-1.5 px-4 rounded-3xl">Edit</RouterLink>
                                <button @click.prevent="deleteProduct(product.id)" class="bg-red-500 hover:bg-red-700 text-white font-roboto py-1 px-4 rounded-3xl">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <Paginate v-if="productStore.products.length > 0" :pagination="productStore.pagination" :offset="3" @paginate="productStore.paginatedList(productStore.pagination.current_page)" />
            </div>          
        </div>
    </AppLayout>
</template>