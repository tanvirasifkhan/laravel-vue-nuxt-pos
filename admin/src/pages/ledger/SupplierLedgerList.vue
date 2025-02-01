<script setup lang="ts">
    import AppLayout from '../../layouts/AppLayout.vue'
    import Paginate from '../../components/Paginate.vue'
    import NoData from '../../components/NoData.vue'
    import { onMounted, ref } from 'vue'
    import { useSupplierLedgerStore } from '../../store/supplierLedgerStore'

    const supplierLedgerStore = useSupplierLedgerStore()
    const startDate = ref<string>('')
    const endDate = ref<string>('')

    onMounted(()=> document.title = 'Supplier Ledger List')

    onMounted(()=> supplierLedgerStore.paginatedList(1))
</script>

<template>
    <AppLayout>
        <div class="w-10/12 mx-auto">            
            <div class="bg-white border border-gray-100 rounded-lg mt-7">
                <div class="border-b border-gray-200 flex items-center justify-between py-3 px-5">
                    <h2 class="font-roboto text-gray-700 text-lg">Supplier Ledger List</h2>
                    <form @submit.prevent="supplierLedgerStore.searchSupplierLedger(startDate, endDate)" v-if="supplierLedgerStore.ledgers.length > 0" class="w-6/12 flex justify-end space-x-2">
                        <input type="date" v-model="startDate" placeholder="Start date" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                        <input type="date" v-model="endDate" placeholder="End date" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                        <button :class="startDate === '' || endDate === '' ? 'cursor-not-allowed' : ''" :disabled="startDate === '' || endDate === ''" class="bg-indigo-500 hover:bg-indigo-700 text-white font-roboto py-1.5 px-4 rounded-3xl">Search</button>
                    </form>
                </div>
                <NoData v-if="supplierLedgerStore.ledgers.length === 0" />
                <table v-else class="w-full">
                    <thead>
                        <tr class="bg-gray-100 border-b border-gray-200">
                            <th class="text-left py-3 px-5 font-roboto text-gray-700 font-normal uppercase text-sm whitespace-nowrap">Transaction Date</th>
                            <th class="text-left py-3 px-5 font-roboto text-gray-700 font-normal uppercase text-sm whitespace-nowrap">Supplier</th>
                            <th class="text-left py-3 px-5 font-roboto text-gray-700 font-normal uppercase text-sm whitespace-nowrap">Type</th>
                            <th class="text-left py-3 px-5 font-roboto text-gray-700 font-normal uppercase text-sm whitespace-nowrap">Credit Amount</th>
                            <th class="text-left py-3 px-5 font-roboto text-gray-700 font-normal uppercase text-sm whitespace-nowrap">Debit Amount</th>
                            <th class="text-left py-3 px-5 font-roboto text-gray-700 font-normal uppercase text-sm whitespace-nowrap">Balance</th>
                            <th class="text-left py-3 px-5 font-roboto text-gray-700 font-normal uppercase text-sm whitespace-nowrap">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="ledger in supplierLedgerStore.ledgers" :key="ledger.id" :class="[ledger.id % 2 === 0 ? 'bg-gray-50' : '']">
                            <td class="py-3 px-5 text-gray-600 font-roboto">{{ ledger.date.human }}</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">{{ ledger.supplier.name }}</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">
                                <span class="font-roboto bg-emerald-500 text-white uppercase text-xs px-4 py-1.5 rounded-2xl" v-if="ledger.type === 'credit'">Credit</span>
                                <span class="font-roboto bg-rose-500 text-white uppercase text-xs px-4 py-1.5 rounded-2xl" v-if="ledger.type === 'debit'">Debit</span>
                            </td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">{{ ledger.credited_amount }}</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">{{ ledger.debited_amount }}</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">{{ ledger.balance }}</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">
                                <span class="font-roboto bg-emerald-500 text-white uppercase text-xs px-4 py-1.5 rounded-2xl" v-if="ledger.status === 'cleared'">Cleared</span>
                                <span class="font-roboto bg-rose-500 text-white uppercase text-xs px-4 py-1.5 rounded-2xl" v-if="ledger.status === 'pending'">Pending</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <Paginate v-if="supplierLedgerStore.ledgers.length > 0" :pagination="supplierLedgerStore.pagination" :offset="3" @paginate="supplierLedgerStore.paginatedList(supplierLedgerStore.pagination.current_page)" />
            </div>          
        </div>
    </AppLayout>
</template>