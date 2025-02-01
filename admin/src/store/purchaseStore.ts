import { defineStore } from "pinia"
import { ref } from "vue"
import { create, all, fetch, search } from "../lib/purchase"
import { type Supplier } from "./supplierStore"
import type { Category } from "./categoryStore"

export interface Product {
    id?: number,
    name: string,
    category: Category,
    sku: string,
    per_unit_price: number
}

export interface ProductItems {
    id: number,
    product: Product,
    quantity: number,
    price: number,
    total: number
}

export interface PurchaseOrder {
    id: number,
    date: {
        raw: string,
        human: string
    },
    supplier: Supplier,
    items: ProductItems[],
    total: number
}

export interface StorePurchaseModel {
    date: string,
    supplier_id: number,
    items: string
}

export const usePurchaseStore = defineStore("purchase", ()=> {
    const purchases = ref<PurchaseOrder[]>([])
    const pagination = ref<any>()

    const store = (purchase: StorePurchaseModel) => create(purchase)

    const show = (id: number) => fetch(id)

    const paginatedList = (page: number) => {
        all(page).then((response) => {
            purchases.value = response.data.data.data
            pagination.value = response.data.data.meta
        })
    }

    const searchPurchase = (date: string) => {
        search(date).then((response) => {            
            purchases.value = response.data.data.data
            pagination.value = response.data.data.meta          
        }).catch(error => {
            alert(error.response.data.errorMessage)
        })
    }

    return {
        purchases,
        pagination,
        store,
        show,
        paginatedList,
        searchPurchase
    }
})