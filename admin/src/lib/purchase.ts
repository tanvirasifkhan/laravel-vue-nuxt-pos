import type { StorePurchaseModel } from "../store/purchaseStore"
import API from "./base"

export const all = (page: number) => {
    return API.get(`purchases?page=${page}`)
}

export const create = (payload: StorePurchaseModel) => {
    return API.post(`purchases`, payload)
}

export const fetch = (id: number) => {
    return API.get(`purchases/${id}`)
}

export const search = (date: string) => {
    return API.get('purchases/search', {params: {date: date}})
}