<script setup lang="ts">
    import AppLayout from '../../layouts/AppLayout.vue'
    import { onMounted, ref } from 'vue'
    import { useCategoryStore, type Category } from '../../store/categoryStore'
    import { useNotification } from '@kyvg/vue3-notification'
    import { useRoute, useRouter } from 'vue-router'

    const categoryStore = useCategoryStore()
    const category = ref<Category>({} as Category)
    const { notify }  = useNotification()
    const router = useRouter()
    const route = useRoute()
    const id = Number(route.params.id)

    onMounted(()=> document.title = 'Update Category')

    onMounted(()=> {
        categoryStore.show(id).then((response) => category.value = response.data.data).catch(()=> alert('Category Not Found'))
    })

    const update = () => {
        categoryStore.updateCategory(id, category.value).then((response) => {
            notify({
                type: "success",
                title: "Update Category",
                text: response.data.successMessage,
            })

            router.push({name: 'category-list'})
        }).catch(() => {
            alert('Please fill out all the required fields')
        })
    }
</script>

<template>
    <AppLayout>
        <div class="w-5/12 mx-auto">            
            <div class="bg-white border border-gray-100 rounded-lg mt-7">
                <div class="border-b border-gray-200 flex items-center justify-between py-3 px-5">
                    <h2 class="font-roboto text-gray-700 text-lg">Update Category</h2>
                </div>
                <form action="" @submit.prevent="update" class="p-5 space-y-2">
                    <div class="flex flex-col space-y-2">
                        <label for="title" class="font-roboto text-lg text-gray-600">Title <span class="text-red-600" title="Required">*</span></label>
                        <input type="text" v-model="category.title" placeholder="Title" id="title" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                    </div>
                    <div class="flex flex-col space-y-2">
                        <label for="slug" class="font-roboto text-lg text-gray-600">Slug <span class="text-red-600" title="Required">*</span></label>
                        <input type="text" v-model="category.slug" placeholder="Slug" id="slug" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                    </div>
                    <div class="flex justify-end mt-2">
                        <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-roboto py-1.5 px-4 rounded-3xl">Update</button>
                    </div>
                </form>
            </div>          
        </div>
    </AppLayout>
</template>