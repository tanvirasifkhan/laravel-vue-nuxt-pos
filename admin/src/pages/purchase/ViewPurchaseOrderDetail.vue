<script setup lang="ts">
    import AppLayout from '../../layouts/AppLayout.vue'
    import { onMounted } from 'vue'

    onMounted(()=> document.title = 'Purchase Order Details')
</script>

<template>
    <AppLayout>
        <div class="w-8/12 mx-auto">            
            <div class="bg-white border border-gray-100 rounded-lg mt-7">
                <div class="border-b border-gray-200 flex items-center justify-between py-3 px-5">
                    <h2 class="font-roboto text-gray-700 text-lg">Purchase Order Details</h2>
                </div>
                <form action="" class="p-5">
                    <div class="flex items-center justify-between space-x-2">
                        <div class="flex flex-col w-6/12 space-y-2">
                            <label for="date" class="font-roboto text-lg text-gray-600">Purchase Date <span class="text-red-600" title="Required">*</span></label>
                            <input type="date" placeholder="Purchase Date" id="date" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                            <p class="font-roboto text-red-500"></p>
                        </div>
                        <div class="flex flex-col w-6/12 space-y-2">
                            <label for="Supplier" class="font-roboto text-lg text-gray-600">Supplier <span class="text-red-600" title="Required">*</span></label>
                                <select id="Supplier" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                            <option value="">Choose a Supplier</option>
                            </select>
                            <p class="font-roboto text-red-500"></p>
                        </div>
                    </div>
                    <div class="py-6 space-y-2">
                        <h2 class="text-xl font-roboto text-gray-600">Please add product items to the purchase</h2>
                        <div class="flex flex-col w-6/12 space-y-2">
                            <select class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                                <option value="">Choose a Product</option>
                            </select>
                            <p class="font-roboto text-red-500"></p>
                        </div>
                    </div>
                    <div class="py-4 flex flex-col space-y-2">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-100 border-b border-gray-200">
                                    <th class="text-left py-3 px-5 font-roboto text-gray-700 font-normal uppercase text-sm whitespace-nowrap">Product</th>
                                    <th class="text-left py-3 px-5 font-roboto text-gray-700 font-normal uppercase text-sm whitespace-nowrap">Price</th>
                                    <th class="text-left py-3 px-5 font-roboto text-gray-700 font-normal uppercase text-sm whitespace-nowrap">Quantity</th>
                                    <th class="text-left py-3 px-5 font-roboto text-gray-700 font-normal uppercase text-sm whitespace-nowrap">Subtotal</th>
                                    <th class="p-3 text-gray-600 font-roboto font-normal flex items-center space-x-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="py-3 px-5 text-gray-600 font-roboto">Product One</td>
                                    <td class="py-3 px-5 text-gray-600 font-roboto">20</td>
                                    <td class="py-3 px-5 text-gray-600 font-roboto">
                                        <input type="number" placeholder="Quantity" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                                    </td>
                                    <td class="py-3 px-5 text-gray-600 font-roboto">200</td>
                                    <td class="py-3 px-5 text-gray-600 font-roboto space-x-2">
                                        <button class="bg-red-500 hover:bg-red-700 text-white font-roboto py-1.5 px-4 rounded-3xl">Delete</button>
                                    </td>
                                </tr>
                                <tr class="bg-gray-50">
                                    <td class="py-3 px-5 text-gray-600 font-roboto">Product One</td>
                                    <td class="py-3 px-5 text-gray-600 font-roboto">20</td>
                                    <td class="py-3 px-5 text-gray-600 font-roboto">
                                        <input type="number" placeholder="Quantity" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                                    </td>
                                    <td class="py-3 px-5 text-gray-600 font-roboto">200</td>
                                    <td class="py-3 px-5 text-gray-600 font-roboto space-x-2">
                                        <button class="bg-red-500 hover:bg-red-700 text-white font-roboto py-1.5 px-4 rounded-3xl">Delete</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-3 px-5 text-gray-600 font-roboto">Product One</td>
                                    <td class="py-3 px-5 text-gray-600 font-roboto">20</td>
                                    <td class="py-3 px-5 text-gray-600 font-roboto">
                                        <input type="number" placeholder="Quantity" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                                    </td>
                                    <td class="py-3 px-5 text-gray-600 font-roboto">200</td>
                                    <td class="py-3 px-5 text-gray-600 font-roboto space-x-2">
                                        <button class="bg-red-500 hover:bg-red-700 text-white font-roboto py-1.5 px-4 rounded-3xl">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>          
        </div>
    </AppLayout>
</template>