<script setup lang="ts">
    import AppLayout from '../../layouts/AppLayout.vue'
    import { onMounted } from 'vue'

    onMounted(()=> document.title = 'Supplier Ledger List')
</script>

<template>
    <AppLayout>
        <div class="w-8/12 mx-auto">            
            <div class="bg-white border border-gray-100 rounded-lg mt-7">
                <div class="border-b border-gray-200 flex items-center justify-between py-3 px-5">
                    <h2 class="font-roboto text-gray-700 text-lg">Supplier Ledger List</h2>
                    <div class="w-6/12 flex justify-end space-x-2">
                        <input type="date" placeholder="Start date" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                        <input type="date" placeholder="End date" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                        <button class="bg-indigo-500 hover:bg-indigo-700 text-white font-roboto py-1.5 px-4 rounded-3xl">Search</button>
                    </div>
                </div>
                <table class="w-full">
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
                        <tr>
                            <td class="py-3 px-5 text-gray-600 font-roboto">2025-01-10</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">Supplier One</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">Credit</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">200</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">0</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">10</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">Cleared</td>
                        </tr>
                        <tr class="bg-gray-50">
                            <td class="py-3 px-5 text-gray-600 font-roboto">2025-01-10</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">Supplier One</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">Credit</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">200</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">0</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">10</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">Cleared</td>
                        </tr>
                        <tr>
                            <td class="py-3 px-5 text-gray-600 font-roboto">2025-01-10</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">Supplier One</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">Credit</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">200</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">0</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">10</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">Cleared</td>
                        </tr>
                    </tbody>
                </table>
                <div class="border-t border-gray-200 flex items-center justify-end p-4">        
                    <ul class="flex items-center">
                        <li><a href="" class="font-roboto text-gray-600 px-3 py-1.5 bg-white border border-gray-100 hover:text-white hover:bg-indigo-500 rounded-l-xl">Prev</a></li>
                        <li><a href="" class="font-roboto text-gray-600 px-3 py-1.5 bg-white border border-gray-100 hover:text-white hover:bg-indigo-500">1</a></li>
                        <li><a href="" class="font-roboto text-white px-3 py-1.5 bg-indigo-500 border border-indigo-500">2</a></li>
                        <li><a href="" class="font-roboto text-gray-600 px-3 py-1.5 bg-white border border-gray-100 hover:text-white hover:bg-indigo-500">3</a></li>
                        <li><a href="" class="font-roboto text-gray-600 px-3 py-1.5 bg-white border border-gray-100 hover:text-white hover:bg-indigo-500">Next</a></li>
                        <li><a href="" class="font-roboto text-gray-600 px-3 py-1.5 bg-white border border-gray-100 hover:text-white hover:bg-indigo-500 rounded-r-xl">Last</a></li>
                    </ul>
                </div>
            </div>          
        </div>
    </AppLayout>
</template>