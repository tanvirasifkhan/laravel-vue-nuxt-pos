<script setup lang="ts">
    import AppLayout from '../../layouts/AppLayout.vue'
    import { onMounted, ref } from 'vue'
    import { useSupplierStore, type Supplier } from '../../store/supplierStore'
    import { useNotification } from '@kyvg/vue3-notification'
    import { useRoute, useRouter } from 'vue-router'

    const supplierStore = useSupplierStore()
    const supplier = ref<Supplier>({} as Supplier)
    const { notify }  = useNotification()
    const router = useRouter()
    const route = useRoute()
    const id = Number(route.params.id)

    onMounted(()=> document.title = 'Update Category')

    onMounted(()=> {
        supplierStore.show(id).then((response) => supplier.value = response.data.data).catch(()=> alert('Supplier Not Found'))
    })

    const update = () => {
        supplierStore.updateSupplier(id, supplier.value).then((response) => {
            notify({
                type: "success",
                title: "Update Supplier",
                text: response.data.successMessage,
            })

            router.push({name: 'supplier-list'})
        }).catch(() => {
            alert('Please fill out all the required fields')
        })
    }
</script>

<template>
    <AppLayout>
        <div class="w-5/12 mx-auto">            
            <div class="bg-white border border-gray-100 rounded-lg mt-7">
                <div class="border-b border-gray-200 flex items-center justify-between py-3 px-5">
                    <h2 class="font-roboto text-gray-700 text-lg">Create new Supplier</h2>
                </div>
                <form action="" @submit.prevent="update" class="p-5 space-y-2">
                    <div class="flex flex-col space-y-2">
                        <label for="name" class="font-roboto text-lg text-gray-600">Name <span class="text-red-600" title="Required">*</span></label>
                        <input type="text" placeholder="Name" v-model="supplier.name" id="name" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                    </div>
                    <div class="flex flex-col space-y-2">
                        <label for="email" class="font-roboto text-lg text-gray-600">Email address</label>
                        <input type="email" v-model="supplier.email" placeholder="Email address" id="email" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                    </div>
                    <div class="flex flex-col space-y-2">
                        <label for="phone" class="font-roboto text-lg text-gray-600">Phone <span class="text-red-600" title="Required">*</span></label>
                        <input type="text" placeholder="Phone" v-model="supplier.phone" id="phone" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                    </div>
                    <div class="flex flex-col space-y-2">
                        <label for="address" class="font-roboto text-lg text-gray-600">Address</label>
                        <textarea placeholder="Address" id="address" v-model="supplier.address" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none"></textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-roboto py-1.5 px-4 rounded-3xl">Save</button>
                    </div>
                </form>
            </div>          
        </div>
    </AppLayout>
</template>