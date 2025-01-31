import { defineStore } from "pinia"
import { ref } from "vue"
import { create, all, fetch, remove, search, update } from "../lib/supplier"

export interface Supplier {
    id: number,
    name: string,
    email?: string,
    phone: string,
    address?: string
}

export const useSupplierStore = defineStore("supplier", ()=> {
    const suppliers = ref<Supplier[]>([])
    const pagination = ref<any>()

    const store = (supplier: Supplier) => create(supplier)

    const show = (id: number) => fetch(id)

    const paginatedList = (page: number) => {
        all(page).then((response) => {
            suppliers.value = response.data.data.data
            pagination.value = response.data.data.meta
        })
    }

    const updateSupplier = (id: number, supplier: Supplier) => update(id, supplier)

    const searchSupplier= (keyword: string) => {
        search(keyword).then((response) => {            
            suppliers.value = response.data.data.data
            pagination.value = response.data.data.meta          
        }).catch(error => {
            alert(error.response.data.errorMessage)
        })
    }

    const removeSupplier = (id: number) => remove(id)

    return {
        suppliers,
        pagination,
        store,
        show,
        paginatedList,
        updateSupplier,
        searchSupplier,
        removeSupplier
    }
})