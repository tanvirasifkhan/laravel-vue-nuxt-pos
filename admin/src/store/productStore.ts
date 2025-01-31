import { defineStore } from "pinia"
import { ref } from "vue"
import { create, all, fetch, remove, search, update } from "../lib/product"
import { type Category } from "./categoryStore"

export interface ProductList {
    id: number,
    name: string,
    category: Category,
    per_unit_price: number,
    sku: string,
    quantity: number
}

export interface Product {
    id?: number,
    name: string,
    category_id: number,
    sku: string,
    per_unit_price: number
}

export const useProductStore = defineStore("product", ()=> {
    const products = ref<ProductList[]>([])
    const pagination = ref<any>()

    const store = (product: Product) => create(product)

    const show = (id: number) => fetch(id)

    const paginatedList = (page: number) => {
        all(page).then((response) => {
            products.value = response.data.data.data
            pagination.value = response.data.data.meta
        })
    }

    const updateProduct = (id: number, product: Product) => update(id, product)

    const searchProduct = (keyword: string) => {
        search(keyword).then((response) => {            
            products.value = response.data.data.data
            pagination.value = response.data.data.meta          
        }).catch(error => {
            alert(error.response.data.errorMessage)
        })
    }

    const removeProduct = (id: number) => remove(id)

    return {
        products,
        pagination,
        store,
        show,
        paginatedList,
        updateProduct,
        searchProduct,
        removeProduct
    }
})