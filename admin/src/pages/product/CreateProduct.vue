<script setup lang="ts">
    import AppLayout from '../../layouts/AppLayout.vue'
    import { onMounted, ref } from 'vue'
    import { useProductStore, type Product } from '../../store/productStore'
    import { useCategoryStore } from '../../store/categoryStore'
    import { useNotification } from '@kyvg/vue3-notification'
    import { useRouter } from 'vue-router'

    const productStore = useProductStore()
    const categoryStore = useCategoryStore()
    const product = ref<Product>({} as Product)
    const { notify }  = useNotification()
    const router = useRouter()

    onMounted(()=> document.title = 'Create new Product')

    onMounted(()=> categoryStore.paginatedList(1))

    const createNewProduct = () => {
        productStore.store(product.value).then((response) => {
            notify({
                type: "success",
                title: "Create Product",
                text: response.data.successMessage,
            })

            router.push({name: 'product-list'})
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
                    <h2 class="font-roboto text-gray-700 text-lg">Create new Product</h2>
                </div>
                <form action="" @submit.prevent="createNewProduct" class="p-5 space-y-2">
                    <div class="flex flex-col space-y-2">
                        <label for="name" class="font-roboto text-lg text-gray-600">Name <span class="text-red-600" title="Required">*</span></label>
                        <input type="text" v-model="product.name" placeholder="Name" id="name" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                    </div>
                    <div class="flex flex-col space-y-2">
                        <label for="category" class="font-roboto text-lg text-gray-600">Category</label>
                        <select id="category" v-model="product.category_id" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                           <option :value="product.category_id">Choose a Category</option>
                           <option :value="category.id" v-for="category in categoryStore.categories" :key="category.id">{{ category.title }}</option>
                        </select>
                    </div>
                    <div class="flex flex-col space-y-2">
                        <label for="sku" class="font-roboto text-lg text-gray-600">SKU <span class="text-red-600" title="Required">*</span></label>
                        <input type="text" v-model="product.sku" placeholder="SKU" id="sku" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                    </div>
                    <div class="flex flex-col space-y-2">
                        <label for="price" class="font-roboto text-lg text-gray-600">Per unit price <span class="text-red-600" title="Required">*</span></label>
                        <input type="text" v-model="product.per_unit_price" placeholder="Price" id="price" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-roboto py-1.5 px-4 rounded-3xl">Save</button>
                    </div>
                </form>
            </div>          
        </div>
    </AppLayout>
</template>