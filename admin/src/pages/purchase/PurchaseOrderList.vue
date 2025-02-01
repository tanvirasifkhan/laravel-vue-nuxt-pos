<script setup lang="ts">
    import AppLayout from '../../layouts/AppLayout.vue'
    import Paginate from '../../components/Paginate.vue'
    import NoData from '../../components/NoData.vue'
    import { onMounted, ref } from 'vue'
    import { usePurchaseStore } from '../../store/purchaseStore'

    const purchaseStore = usePurchaseStore()
    const searchDate = ref<string>('')

    onMounted(()=> document.title = 'Purchase Order List')

    onMounted(()=> purchaseStore.paginatedList(1))
</script>

<template>
    <AppLayout>
        <div class="w-8/12 mx-auto">            
            <div class="bg-white border border-gray-100 rounded-lg mt-7">
                <div class="border-b border-gray-200 flex items-center justify-between py-3 px-5">
                    <h2 class="font-roboto text-gray-700 text-lg">Purchase Order List</h2>
                    <form @submit.prevent="purchaseStore.searchPurchase(searchDate)" v-if="purchaseStore.purchases.length > 0" class="w-6/12 flex justify-end space-x-1.5">
                        <input type="date" v-model="searchDate" placeholder="Search Purchase Order" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                        <button :class="searchDate === '' ? 'cursor-not-allowed' : ''" :disabled="searchDate === ''" class="bg-indigo-500 hover:bg-indigo-700 text-white font-roboto py-1.5 px-4 rounded-3xl">Search</button>
                    </form>
                </div>
                <NoData v-if="purchaseStore.purchases.length === 0" />
                <table v-else class="w-full">
                    <thead>
                        <tr class="bg-gray-100 border-b border-gray-200">
                            <th class="text-left py-3 px-5 font-roboto text-gray-700 font-normal uppercase text-sm whitespace-nowrap">Purchase Date</th>
                            <th class="text-left py-3 px-5 font-roboto text-gray-700 font-normal uppercase text-sm whitespace-nowrap">Supplier</th>
                            <th class="text-left py-3 px-5 font-roboto text-gray-700 font-normal uppercase text-sm whitespace-nowrap">Supplier Phone</th>
                            <th class="text-left py-3 px-5 font-roboto text-gray-700 font-normal uppercase text-sm whitespace-nowrap">Total</th>
                            <th class="p-3 text-gray-600 font-roboto font-normal flex items-center space-x-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="purchase in purchaseStore.purchases" :key="purchase.id" :class="[purchase.id % 2 === 0 ? 'bg-gray-50' : '']">
                            <td class="py-3 px-5 text-gray-600 font-roboto">{{ purchase.date.human }}</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">{{ purchase.supplier.name }}</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">{{ purchase.supplier.phone }}</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">{{ purchase.total }}</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto space-x-2">
                                <RouterLink :to="{name: 'purchase-order-detail', params: {id: purchase.id}}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-roboto py-1.5 px-4 rounded-3xl">View Details</RouterLink>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <Paginate v-if="purchaseStore.purchases.length > 0" :pagination="purchaseStore.pagination" :offset="3" @paginate="purchaseStore.paginatedList(purchaseStore.pagination.current_page)" />
            </div>          
        </div>
    </AppLayout>
</template>