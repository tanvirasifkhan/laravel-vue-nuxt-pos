<script setup lang="ts">
    import AppLayout from '../../layouts/AppLayout.vue'
    import { onMounted } from 'vue'

    onMounted(()=> document.title = 'Product List')
</script>

<template>
    <AppLayout>
        <div class="w-8/12 mx-auto">            
            <div class="bg-white border border-gray-100 rounded-lg mt-7">
                <div class="border-b border-gray-200 flex items-center justify-between py-3 px-5">
                    <h2 class="font-roboto text-gray-700 text-lg">Product List</h2>
                    <div class="w-6/12 flex justify-end space-x-1.5">
                        <input type="text" placeholder="Search Product" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                        <button class="bg-indigo-500 hover:bg-indigo-700 text-white font-roboto py-1.5 px-4 rounded-3xl">Search</button>
                    </div>
                </div>
                <table class="w-full">
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
                        <tr>
                            <td class="py-3 px-5 text-gray-600 font-roboto">Product One</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">Category One</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">SKU123</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">10.25</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">5</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto space-x-2">
                                <button class="bg-indigo-500 hover:bg-indigo-700 text-white font-roboto py-1.5 px-4 rounded-3xl">Edit</button>
                                <button class="bg-red-500 hover:bg-red-700 text-white font-roboto py-1.5 px-4 rounded-3xl">Delete</button>
                            </td>
                        </tr>
                        <tr class="bg-gray-50">
                            <td class="py-3 px-5 text-gray-600 font-roboto">Product One</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">Category One</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">SKU123</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">10.25</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">5</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto space-x-2">
                                <button class="bg-indigo-500 hover:bg-indigo-700 text-white font-roboto py-1.5 px-4 rounded-3xl">Edit</button>
                                <button class="bg-red-500 hover:bg-red-700 text-white font-roboto py-1.5 px-4 rounded-3xl">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-3 px-5 text-gray-600 font-roboto">Product One</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">Category One</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">SKU123</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">10.25</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto">5</td>
                            <td class="py-3 px-5 text-gray-600 font-roboto space-x-2">
                                <button class="bg-indigo-500 hover:bg-indigo-700 text-white font-roboto py-1.5 px-4 rounded-3xl">Edit</button>
                                <button class="bg-red-500 hover:bg-red-700 text-white font-roboto py-1.5 px-4 rounded-3xl">Delete</button>
                            </td>
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