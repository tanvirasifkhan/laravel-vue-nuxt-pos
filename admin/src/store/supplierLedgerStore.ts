import { defineStore } from "pinia"
import { ref } from "vue"
import { create, all, search, check } from "../lib/supplier_ledger"
import type { Supplier } from "./supplierStore"
import type { PurchaseOrder } from "./purchaseStore"

export interface StoreSupplierLedgerModel {
    supplier_id: number,
    purchase_id: number,
    transaction_date: string,
    debited_amount: number,
    description: string
}

export interface SupplierLedgerList {
    id: number,
    supplier: Supplier,
    purchase: PurchaseOrder,
    date: {
        raw: string,
        human: string
    },
    type: string,
    debited_amount: string,
    credited_amount: string,
    balance: string,
    status: string,
    description?: string
}

export const useSupplierLedgerStore = defineStore("supplier_ledger", ()=> {
    const ledgers = ref<SupplierLedgerList[]>([])
    const pagination = ref<any>()

    const store = (ledger: StoreSupplierLedgerModel) => create(ledger)

    const paginatedList = (page: number) => {
        all(page).then((response) => {
            ledgers.value = response.data.data.data
            pagination.value = response.data.data.meta
        })
    }

    const searchSupplierLedger = (date_from: string, date_to: string) => {
        search(date_from, date_to).then((response) => {            
            ledgers.value = response.data.data.data
            pagination.value = response.data.data.meta          
        }).catch(error => {
            alert(error.response.data.errorMessage)
        })
    }

    const checkPaymentStatus = (supplier_id: number, purchase_id: number) => check(supplier_id, purchase_id)

    return {
        ledgers,
        pagination,
        store,
        paginatedList,
        searchSupplierLedger,
        checkPaymentStatus
    }
})