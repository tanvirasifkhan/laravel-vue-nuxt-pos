import type{ StoreSupplierLedgerModel } from "../store/supplierLedgerStore"
import API from "./base"

export const all = (page: number) => {
    return API.get(`supplier_ledgers?page=${page}`)
}

export const create = (payload: StoreSupplierLedgerModel) => {
    return API.post(`supplier_ledgers`, payload)
}

export const check = (supplier_id: number, purchase_id: number) => {
    return API.get(`supplier_ledgers/suppliers/${supplier_id}/purchases/${purchase_id}`)
}

export const search = (date_from: string, date_to: string) => {
    return API.get('supplier_ledgers/search', { params: { date_from: date_from, date_to: date_to }})
}