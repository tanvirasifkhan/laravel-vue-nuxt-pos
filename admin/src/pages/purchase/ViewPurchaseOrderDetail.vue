<script setup lang="ts">
    import AppLayout from '../../layouts/AppLayout.vue'
    import { onMounted, ref } from 'vue'
    import { usePurchaseStore, type PurchaseOrder } from '../../store/purchaseStore'
    import { useRoute } from 'vue-router'

    const purchaseStore = usePurchaseStore()
    const route = useRoute()
    const purchase = ref<PurchaseOrder>({} as PurchaseOrder)

    const id = Number(route.params.id)

    onMounted(()=> document.title = 'Purchase Order Details')

    onMounted(()=> {
        purchaseStore.show(id)
            .then(response => purchase.value = response.data.data)
            .catch(()=> alert('Purchase not found.'))
    })
</script>

<template>
    <AppLayout>
        <div class="w-8/12 mx-auto">            
            <div class="bg-white border border-gray-100 rounded-lg mt-7">
                <div class="border-b border-gray-200 flex items-center justify-between py-3 px-5">
                    <h2 class="font-roboto text-gray-700 text-lg">Purchase Order Details</h2>
                </div>
                <div class="p-5 space-y-2">
                    <div class="flex items-center justify-between space-x-2">
                        <div class="flex flex-col w-6/12 space-y-2">
                            <h3 class="font-roboto text-lg text-gray-600">Purchase Date</h3>
                            <h2 class="font-roboto text-gray-800 text-xl">{{ purchase.date?.human }}</h2>
                        </div>
                        <div class="flex flex-col w-6/12 space-y-2">
                            <h3 class="font-roboto text-lg text-gray-600">Supplier</h3>
                            <h2 class="font-roboto text-gray-800 text-xl">{{ purchase.supplier?.name }}</h2>
                        </div>
                    </div>                    
                    <div class="py-4 flex flex-col space-y-3">
                        <h2 class="font-roboto text-gray-600 text-xl">Items</h2>
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-100 border-b border-gray-200">
                                    <th class="text-left py-3 px-5 font-roboto text-gray-700 font-normal uppercase text-sm whitespace-nowrap">Product</th>
                                    <th class="text-left py-3 px-5 font-roboto text-gray-700 font-normal uppercase text-sm whitespace-nowrap">Price</th>
                                    <th class="text-left py-3 px-5 font-roboto text-gray-700 font-normal uppercase text-sm whitespace-nowrap">Quantity</th>
                                    <th class="text-left py-3 px-5 font-roboto text-gray-700 font-normal uppercase text-sm whitespace-nowrap">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in purchase?.items" :key="item.id" :class="[item.id % 2 === 0 ? 'bg-gray-50' : '']">
                                    <td class="py-3 px-5 text-gray-600 font-roboto">{{ item.product.name }}</td>
                                    <td class="py-3 px-5 text-gray-600 font-roboto">{{ item.product.per_unit_price }}</td>
                                    <td class="py-3 px-5 text-gray-600 font-roboto">{{ item.quantity }}</td>
                                    <td class="py-3 px-5 text-gray-600 font-roboto">{{ item.total }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="py-3 px-5 text-gray-800 font-roboto text-right uppercase">Total</td>
                                    <td class="py-3 px-5 text-gray-600 font-roboto">{{ purchase.total }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> 
            <div class="flex justify-center mt-3">
                <button @click="$router.push({name: 'purchase-order-list'})" class="bg-indigo-600 text-white cursor-pointer font-roboto text-lg px-4 py-1.5 rounded-3xl">Back</button>         
            </div>
        </div>
    </AppLayout>
</template>