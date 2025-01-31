import type { Supplier } from "../store/supplierStore"
import API from "./base"

export const all = (page: number) => {
    return API.get(`suppliers?page=${page}`)
}

export const create = (payload: Supplier) => {
    return API.post(`suppliers`, payload)
}

export const fetch = (id: number) => {
    return API.get(`suppliers/${id}`)
}

export const update = (id: number, payload: Supplier) => {
    return API.put(`suppliers/${id}`, payload)
}

export const search = (keyword: string) => {
    return API.get(`suppliers/search/${keyword}`)
}

export const remove = (id: number) => {
    return API.delete(`suppliers/${id}`)
}