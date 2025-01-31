<script setup lang="ts">
    import AppLayout from '../../layouts/AppLayout.vue'
    import Paginate from '../../components/Paginate.vue'
    import NoData from '../../components/NoData.vue'
    import { onMounted, ref } from 'vue'
    import { useSupplierStore } from '../../store/supplierStore'
    import { useNotification } from '@kyvg/vue3-notification'
    import { RouterLink } from 'vue-router'

    const supplierStore = useSupplierStore()
    const { notify }  = useNotification()
    const searchKeyword = ref<string>('')

    onMounted(()=> document.title = 'Supplier List')

    onMounted(()=> supplierStore.paginatedList(1))

    const deleteSupplier = (id: number) => {
        if(confirm('Do you want to delete this supplier ?')){
            supplierStore.removeSupplier(id).then((response)=> {
                notify({
                    type: "success",
                    title: "Delete Supplier",
                    text: response.data.successMessage,
                })
                
                supplierStore.paginatedList(1)
            })
        }             
    }
</script>

<template>
    <AppLayout>
        <div class="w-8/12 mx-auto">            
            <div class="bg-white border border-gray-100 rounded-lg mt-7">
                <div class="border-b border-gray-200 flex items-center justify-between py-3 px-5">
                    <h2 class="font-roboto text-gray-700 text-lg">Supplier List</h2>
                    <form @submit.prevent="supplierStore.searchSupplier(searchKeyword)" v-if="supplierStore.suppliers.length > 0" class="w-6/12 flex justify-end space-x-1.5">
                        <input type="text" v-model="searchKeyword" placeholder="Search Supplier" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                        <button :class="searchKeyword === '' ? 'cursor-not-allowed' : ''" :disabled="searchKeyword === ''" class="bg-indigo-500 hover:bg-indigo-700 text-white font-roboto py-1.5 px-4 rounded-3xl">Search</button>
                    </form>
                </div>
                <NoData v-if="supplierStore.suppliers.length === 0" />
                <table v-else class="w-full">
                    <thead>
                        <tr class="bg-gray-100 border-b border-gray-200">
                            <th class="text-left py-3 px-5 font-roboto text-gray-700 font-normal uppercase text-sm whitespace-nowrap">Name</th>
                            <th class="text-left py-3 px-5 font-roboto text-gray-700 font-normal uppercase text-sm whitespace-nowrap">Email Address</th>
                            <th class="text-left py-3 px-5 font-roboto text-gray-700 font-normal uppercase text-sm whitespace-nowrap">Phone</th>
                            <th class="text-left py-3 px-5 font-roboto text-gray-700 font-normal uppercase text-sm whitespace-nowrap">Address</th>
                            <th class="p-3 text-gray-600 font-roboto font-normal flex items-center space-x-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="supplier in supplierStore.suppliers" :key="supplier.id" :class="[supplier.id % 2 === 0 ? 'bg-gray-50' : '']">
                            <td class="py-3 px-5 text-gray-600 font-roboto">{{ supplier.name }}</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">{{ supplier.email === null ? 'N/A' : supplier.email }}</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">{{ supplier.phone }}</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">{{ supplier.address === null ? 'N/A' : supplier.address }}</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto space-x-2">
                                <RouterLink :to="{name: 'update-supplier', params: {id: supplier.id}}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-roboto py-1.5 px-4 rounded-3xl">Edit</RouterLink>
                                <button @click.prevent="deleteSupplier(supplier.id)" class="bg-red-500 hover:bg-red-700 text-white font-roboto py-1.5 px-4 rounded-3xl">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <Paginate v-if="supplierStore.suppliers.length > 0" :pagination="supplierStore.pagination" :offset="3" @paginate="supplierStore.paginatedList(supplierStore.pagination.current_page)" />
            </div>          
        </div>
    </AppLayout>
</template>