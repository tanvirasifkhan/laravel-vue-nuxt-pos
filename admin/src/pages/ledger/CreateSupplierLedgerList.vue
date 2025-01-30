<script setup lang="ts">
    import AppLayout from '../../layouts/AppLayout.vue'
    import { onMounted } from 'vue'

    onMounted(()=> document.title = 'Create Supplier Ledger')
</script>

<template>
    <AppLayout>
        <div class="w-6/12 mx-auto">            
            <div class="bg-white border border-gray-100 rounded-lg mt-7">
                <div class="border-b border-gray-200 flex items-center justify-between py-3 px-5">
                    <h2 class="font-roboto text-gray-700 text-lg">Create Supplier Ledger</h2>
                </div>
                <form action="" class="p-5 space-y-2">
                    <div class="flex items-center justify-between space-x-2">
                        <div class="flex flex-col w-4/12 space-y-2">
                            <label for="supplier" class="font-roboto text-lg text-gray-600">Supplier <span class="text-red-600" title="Required">*</span></label>
                            <select id="supplier" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                                <option value="">Select a Supplier</option>
                            </select>
                            <p class="font-roboto text-red-500"></p>
                        </div>
                        <div class="flex flex-col w-4/12 space-y-2">
                            <label for="purchase" class="font-roboto text-lg text-gray-600">Supplier <span class="text-red-600" title="Required">*</span></label>
                            <select id="purchase" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                                <option value="">Select Purchase with Supplier</option>
                            </select>
                            <p class="font-roboto text-red-500"></p>
                        </div>
                        <div class="flex flex-col w-4/12 space-y-2 mt-6">
                            <button class="bg-indigo-500 hover:bg-indigo-700 text-white font-roboto py-1.5 px-4 rounded-3xl">Check Payment Status</button>
                        </div>
                    </div>
                    <div class="flex items-center justify-between space-x-2">
                        <div class="flex flex-col w-6/12 space-y-2">
                            <label for="transaction_date" class="font-roboto text-lg text-gray-600">Transaction Date <span class="text-red-600" title="Required">*</span></label>
                            <input type="date" placeholder="Transaction Date" id="transaction_date" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                            <p class="font-roboto text-red-500"></p>
                        </div>
                        <div class="flex flex-col w-6/12 space-y-2">
                            <label for="amount" class="font-roboto text-lg text-gray-600">Total Amount to Pay <span class="text-red-600" title="Required">*</span></label>
                            <input type="number" placeholder="Amount" id="amount" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                            <p class="font-roboto text-red-500"></p>
                        </div>
                    </div>    
                    <div class="py-4">
                        <h2 class="font-roboto text-xl text-gray-600">Already Paid</h2>  
                    </div>               
                    <div class="flex justify-end">
                        <button class="bg-indigo-500 hover:bg-indigo-700 text-white font-roboto py-1.5 px-4 rounded-3xl">Pay Now</button>
                    </div>
                </form>
            </div>          
        </div>
    </AppLayout>
</template>