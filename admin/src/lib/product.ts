import type { Product } from "../store/productStore"
import API from "./base"

export const all = (page: number) => {
    return API.get(`products?page=${page}`)
}

export const create = (payload: Product) => {
    return API.post(`products`, payload)
}

export const fetch = (id: number) => {
    return API.get(`products/${id}`)
}

export const update = (id: number, payload: Product) => {
    return API.put(`products/${id}`, payload)
}

export const search = (keyword: string) => {
    return API.get('products/search', { params: { keyword: keyword }})
}

export const remove = (id: number) => {
    return API.delete(`products/${id}`)
}