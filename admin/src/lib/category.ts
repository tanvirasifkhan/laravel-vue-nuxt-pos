import type { Category } from "../store/categoryStore"
import API from "./base"

export const all = (page: number) => {
    return API.get(`categories?page=${page}`)
}

export const create = (payload: Category) => {
    return API.post(`categories`, payload)
}

export const fetch = (id: number) => {
    return API.get(`categories/${id}`)
}

export const update = (id: number, payload: Category) => {
    return API.put(`categories/${id}`, payload)
}

export const search = (keyword: string) => {
    return API.get('categories/search', { params: { keyword: keyword }})
}

export const remove = (id: number) => {
    return API.delete(`categories/${id}`)
}