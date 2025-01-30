<script setup lang="ts">
    import AppLayout from '../../layouts/AppLayout.vue'
    import { onMounted } from 'vue'

    onMounted(()=> document.title = 'Create new Supplier')
</script>

<template>
    <AppLayout>
        <div class="w-5/12 mx-auto">            
            <div class="bg-white border border-gray-100 rounded-lg mt-7">
                <div class="border-b border-gray-200 flex items-center justify-between py-3 px-5">
                    <h2 class="font-roboto text-gray-700 text-lg">Create new Supplier</h2>
                </div>
                <form action="" class="p-5">
                    <div class="flex flex-col space-y-2">
                        <label for="name" class="font-roboto text-lg text-gray-600">Name <span class="text-red-600" title="Required">*</span></label>
                        <input type="text" placeholder="Name" id="name" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                        <p class="font-roboto text-red-500"></p>
                    </div>
                    <div class="flex flex-col space-y-2">
                        <label for="email" class="font-roboto text-lg text-gray-600">Email address</label>
                        <input type="email" placeholder="Email address" id="email" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                        <p class="font-roboto text-red-500"></p>
                    </div>
                    <div class="flex flex-col space-y-2">
                        <label for="phone" class="font-roboto text-lg text-gray-600">Phone <span class="text-red-600" title="Required">*</span></label>
                        <input type="text" placeholder="Phone" id="phone" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                        <p class="font-roboto text-red-500"></p>
                    </div>
                    <div class="flex flex-col space-y-2">
                        <label for="address" class="font-roboto text-lg text-gray-600">Address</label>
                        <textarea placeholder="Address" id="address" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none"></textarea>
                        <p class="font-roboto text-red-500"></p>
                    </div>
                    <div class="flex justify-end">
                        <button class="bg-indigo-500 hover:bg-indigo-700 text-white font-roboto py-1.5 px-4 rounded-3xl">Save</button>
                    </div>
                </form>
            </div>          
        </div>
    </AppLayout>
</template>