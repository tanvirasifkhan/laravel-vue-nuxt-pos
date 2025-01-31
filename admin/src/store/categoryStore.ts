import { defineStore } from "pinia"
import { ref } from "vue"
import { create, all, fetch, remove, search, update } from "../lib/category"

export interface Category {
    id: number,
    title: string,
    slug: string
}

export const useCategoryStore = defineStore("category", ()=> {
    const categories = ref<Category[]>([])
    const pagination = ref<any>()

    const store = (category: Category) => create(category)

    const show = (id: number) => fetch(id)

    const paginatedList = (page: number) => {
        all(page).then((response) => {
            categories.value = response.data.data.data
            pagination.value = response.data.data.meta
        })
    }

    const updateCategory = (id: number, category: Category) => update(id, category)

    const searchCategory = (keyword: string) => {
        search(keyword).then((response) => {            
            categories.value = response.data.data.data
            pagination.value = response.data.data.meta          
        }).catch(error => {
            alert(error.response.data.errorMessage)
        })
    }

    const removeCategory = (id: number) => remove(id)

    return {
        categories,
        pagination,
        store,
        show,
        paginatedList,
        updateCategory,
        searchCategory,
        removeCategory
    }
})