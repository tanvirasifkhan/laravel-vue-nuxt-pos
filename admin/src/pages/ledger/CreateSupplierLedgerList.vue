<script setup lang="ts">
    import AppLayout from '../../layouts/AppLayout.vue'
    import { onMounted, ref } from 'vue'
    import { useSupplierStore } from '../../store/supplierStore'
    import { type StoreSupplierLedgerModel, useSupplierLedgerStore, type SupplierLedgerList } from '../../store/supplierLedgerStore'
    import { usePurchaseStore } from '../../store/purchaseStore'
    import { useNotification } from '@kyvg/vue3-notification'
    import { useRouter } from 'vue-router'

    const supplierLedgerStore = useSupplierLedgerStore()
    const supplierStore = useSupplierStore()
    const purchaseStore = usePurchaseStore()
    const supplierLedgerList = ref<SupplierLedgerList>({} as SupplierLedgerList)
    const supplierLedger = ref<StoreSupplierLedgerModel>({} as StoreSupplierLedgerModel)
    const { notify }  = useNotification()
    const router = useRouter()

    onMounted(()=> document.title = 'Create Supplier Ledger')

    onMounted(()=> supplierStore.paginatedList(1))

    onMounted(()=> purchaseStore.paginatedList(1))

    const checkStatus = (supplier_id: number, purchase_id: number) => {        
        supplierLedgerStore.checkPaymentStatus(supplier_id, purchase_id).then(response => {
            supplierLedgerList.value = response.data.data
        }).catch((error)=> alert(error.response.data.errorMessage))
    }

    const createNewLedger = () => {
        supplierLedgerStore.store({
            purchase_id: supplierLedger.value.purchase_id,
            supplier_id: supplierLedger.value.supplier_id,
            transaction_date: supplierLedger.value.transaction_date,
            debited_amount: Number(supplierLedgerList.value.credited_amount),
            description: supplierLedger.value.description
        }).then((response) => {
            notify({
                type: "success",
                title: "Create Supplier Ledger",
                text: response.data.successMessage,
            })

            router.push({name: 'supplier-ledger-list'})
        }).catch(() => {
            alert('Please fill out all the required fields')
        })
    }
</script>

<template>
    <AppLayout>
        <div class="w-8/12 mx-auto">            
            <div class="bg-white border border-gray-100 rounded-lg mt-7">
                <div class="border-b border-gray-200 flex items-center justify-between py-3 px-5">
                    <h2 class="font-roboto text-gray-700 text-lg">Create Supplier Ledger</h2>
                </div>
                <form @submit.prevent="createNewLedger" class="p-5 space-y-2">
                    <div class="flex items-center justify-between space-x-2">
                        <div class="flex flex-col w-4/12 space-y-2">
                            <label for="supplier" class="font-roboto text-lg text-gray-600">Supplier <span class="text-red-600" title="Required">*</span></label>
                            <select id="supplier" v-model="supplierLedger.supplier_id" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                                <option :value="supplierLedger.supplier_id">Select a Supplier</option>
                                <option v-for="supplier in supplierStore.suppliers" :key="supplier.id" :value="supplier.id">{{ supplier.name }}</option>
                            </select>
                        </div>
                        <div class="flex flex-col w-4/12 space-y-2">
                            <label for="purchase" class="font-roboto text-lg text-gray-600">Purchase <span class="text-red-600" title="Required">*</span></label>
                            <select id="purchase" v-model="supplierLedger.purchase_id" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                                <option :value="supplierLedger.purchase_id">Select Purchase with Supplier</option>
                                <option v-for="purchase in purchaseStore.purchases" :key="purchase.id" :value="purchase.id">{{ purchase.supplier.name }} - {{ purchase.id }} - {{ purchase.date.human }}</option>
                            </select>
                        </div>
                        <div class="flex flex-col w-4/12 space-y-2 mt-6">
                            <button type="button" :class="supplierLedger.supplier_id === undefined || supplierLedger.purchase_id === undefined ? 'cursor-not-allowed' : ''" :disabled="supplierLedger.supplier_id === undefined || supplierLedger.purchase_id === undefined" @click="checkStatus(supplierLedger.supplier_id, supplierLedger.purchase_id)" class="bg-indigo-500 hover:bg-indigo-700 text-white font-roboto py-1.5 px-4 rounded-3xl">Check Payment Status</button>
                        </div>
                    </div>   
                    <div class="py-4">
                        <h2 v-if="supplierLedgerList.status === 'cleared'" class="font-roboto text-xl text-emerald-600">Already Paid</h2>  
                        <h2 v-if="supplierLedgerList.status === 'pending'" class="font-roboto text-xl text-rose-600">You will have to pay {{ supplierLedgerList.credited_amount }}</h2>  
                    </div> 
                    <div v-if="supplierLedgerList.status === 'pending'" class="flex items-center justify-between space-x-2">
                        <div class="flex flex-col w-6/12 space-y-2">
                            <label for="transaction_date" class="font-roboto text-lg text-gray-600">Transaction Date <span class="text-red-600" title="Required">*</span></label>
                            <input type="date" v-model="supplierLedger.transaction_date" placeholder="Transaction Date" id="transaction_date" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                        </div>
                        <div class="flex flex-col w-6/12 space-y-2">
                            <label for="amount" class="font-roboto text-lg text-gray-600">Total Amount to Pay</label>
                            <input type="number" disabled placeholder="Amount" :value="supplierLedgerList.credited_amount" id="amount" class="border border-gray-200 font-roboto text-gray-500 bg-gray-100 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                        </div>
                        <div class="flex flex-col w-6/12 space-y-2">
                            <label for="description" class="font-roboto text-lg text-gray-600">Remarks</label>
                            <input type="text" id="description" placeholder="Remarks" v-model="supplierLedger.description" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none" />
                        </div>
                    </div>               
                    <div v-if="supplierLedgerList.status === 'pending'" class="flex justify-end">
                        <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-roboto py-1.5 px-4 rounded-3xl">Pay Now</button>
                    </div>
                </form>
            </div>          
        </div>
    </AppLayout>
</template>