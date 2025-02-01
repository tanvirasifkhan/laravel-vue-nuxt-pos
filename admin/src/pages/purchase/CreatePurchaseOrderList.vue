<script setup lang="ts">
    import AppLayout from '../../layouts/AppLayout.vue'
    import { onMounted, ref } from 'vue'
    import { useProductStore } from '../../store/productStore'
    import { usePurchaseStore, type StorePurchaseModel } from '../../store/purchaseStore'
    import { useSupplierStore } from '../../store/supplierStore'
    import { useNotification } from '@kyvg/vue3-notification'
    import { useRouter } from 'vue-router'


    interface PurchaseItem {
        product_id: number,  
        product_name: string,
        price: number,      
        quantity: number,
        subtotal: number
    }

    const productStore = useProductStore()
    const purchaseStore = usePurchaseStore()
    const supplierStore = useSupplierStore()
    const purchase = ref<StorePurchaseModel>({} as StorePurchaseModel)
    const purchaseItems = ref<PurchaseItem[]>([])
    const items = ref<{product_id: number, quantity: number}[]>([])
    const { notify }  = useNotification()
    const router = useRouter()

    onMounted(()=> document.title = 'Create Purchase Order')

    onMounted(()=> productStore.paginatedList(1))

    onMounted(()=> supplierStore.paginatedList(1))

    const addPurchaseItem = (id: number) => {
        let product = purchaseItems.value.find((purchaseItem) => purchaseItem.product_id === id)

        if(product) {
            product.quantity += 1
            product.subtotal = product.price * product.quantity
            return
        }else{
            productStore.show(id).then((response) => {
                purchaseItems.value.push({
                    product_id : id,
                    product_name: response.data.data.name,
                    quantity : 1,
                    price : response.data.data.per_unit_price,
                    subtotal : response.data.data.per_unit_price * 1
                })
            })
        }

        items.value = purchaseItems.value
    }

    const deletePurchaseItem = (id: number) => {
        purchaseItems.value = purchaseItems.value.filter((item) => item.product_id !== id)
        items.value = purchaseItems.value
    }

    const addQuantity = (id: number) => {
        let product = purchaseItems.value.find((purchaseItem) => purchaseItem.product_id === id)

        if(product) {
            product.quantity += 1
            product.subtotal = product.price * product.quantity
            return
        }

        items.value = purchaseItems.value
    }

    const reduceQuantity = (id: number) => {
        let product = purchaseItems.value.find((purchaseItem) => purchaseItem.product_id === id)

        if(product) {
            if(product.quantity === 1) {
                return false
            }
            product.quantity -= 1
            product.subtotal = product.price * product.quantity
            return
        }

        items.value = purchaseItems.value
    }
    
    const createNewPurchase = () => {
        purchaseStore.store({
            date: purchase.value.date,
            supplier_id: purchase.value.supplier_id,
            items: JSON.stringify(items.value)
        }).then((response) => {
            notify({
                type: "success",
                title: "Create Purchase Order",
                text: response.data.successMessage,
            })

            router.push({name: 'purchase-order-list'})
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
                    <h2 class="font-roboto text-gray-700 text-lg">Create Purchase Order</h2>
                </div>
                <form @submit.prevent="createNewPurchase" class="p-5 space-y-2">
                    <div class="flex items-center justify-between space-x-2">
                        <div class="flex flex-col w-6/12 space-y-2">
                            <label for="date" class="font-roboto text-lg text-gray-600">Purchase Date <span class="text-red-600" title="Required">*</span></label>
                            <input type="date" placeholder="Purchase Date" v-model="purchase.date" id="date" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                        </div>
                        <div class="flex flex-col w-6/12 space-y-2">
                            <label for="supplier" class="font-roboto text-lg text-gray-600">Supplier <span class="text-red-600" title="Required">*</span></label>
                            <select id="supplier" v-model="purchase.supplier_id" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                                <option :value="purchase.supplier_id">Choose a Supplier</option>
                                <option v-for="supplier in supplierStore.suppliers" :key="supplier.id" :value="supplier.id">{{ supplier.name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="py-6 space-y-2">
                        <h2 class="text-xl font-roboto text-gray-600">Please add product items to the purchase <span class="text-red-600" title="Required">*</span></h2>
                        <div class="flex flex-col w-6/12 space-y-2">
                            <select @change="(event: any) => addPurchaseItem(Number(event.target.value))" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                                <option value="">Choose a Product</option>
                                <option v-for="product in productStore.products" :key="product.id" :value="product.id">{{ product.name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="py-4 flex flex-col space-y-2">
                        <p v-if="purchaseItems.length === 0" class="font-roboto text-center text-lg text-gray-400">No Purchase Item</p>
                        <table v-else class="w-full">
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
                                <tr v-for="item in purchaseItems" :key="item.product_id" :class="[item.product_id % 2 === 0 ? 'bg-gray-50' : '']">
                                    <td class="py-3 px-5 text-gray-600 font-roboto">{{ item.product_name }}</td>
                                    <td class="py-3 px-5 text-gray-600 font-roboto">{{ item.price }}</td>
                                    <td class="py-3 px-5 text-gray-600 font-roboto">
                                        <button type="button" @click="reduceQuantity(item.product_id)" class="py-2 px-4 text-white border border-red-500 bg-red-400">-</button>
                                        <input type="text" disabled :value="item.quantity" placeholder="Quantity" class="border border-gray-200 font-roboto text-gray-500 py-2 px-4 outline-none focus:outline-none">
                                        <button type="button" @click="addQuantity(item.product_id)" class="py-2 px-4 text-white border border-indigo-500 bg-indigo-400">+</button>
                                    </td>
                                    <td class="py-3 px-5 text-gray-600 font-roboto">{{ item.subtotal.toFixed(2) }}</td>
                                    <td class="py-3 px-5 text-gray-600 font-roboto space-x-2">
                                        <button type="button" @click="deletePurchaseItem(item.product_id)" class="bg-red-500 hover:bg-red-700 text-white font-roboto py-1.5 px-4 rounded-3xl">Delete</button>
                                    </td>
                                </tr>
                                <tr class="border-t border-b border-gray-200 bg-gray-50">
                                    <td colspan="3" class="py-3 px-5 text-gray-800 font-roboto text-right uppercase">Total</td>
                                    <td class="py-3 px-5 text-gray-600 font-roboto">{{ purchaseItems.reduce((amount, item) => amount += item.price * item.quantity,0).toFixed(2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div v-if="purchaseItems.length > 0" class="flex justify-end">
                        <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-roboto py-1.5 px-4 rounded-3xl">Save</button>
                    </div>
                </form>
            </div>          
        </div>
    </AppLayout>
</template>