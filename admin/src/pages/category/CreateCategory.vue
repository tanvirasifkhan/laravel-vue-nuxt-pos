<script setup lang="ts">
    import AppLayout from '../../layouts/AppLayout.vue'
    import { onMounted, ref } from 'vue'
    import { useCategoryStore, type Category } from '../../store/categoryStore'
    import { useNotification } from '@kyvg/vue3-notification'
    import { useRouter } from 'vue-router'

    const categoryStore = useCategoryStore()
    const category = ref<Category>({} as Category)
    const { notify }  = useNotification()
    const router = useRouter()

    onMounted(()=> document.title = 'Create new Category')

    const createNewCategory = () => {
        categoryStore.store(category.value).then((response) => {
            notify({
                type: "success",
                title: "Create Category",
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
                    <h2 class="font-roboto text-gray-700 text-lg">Create new Category</h2>
                </div>
                <form action="" @submit.prevent="createNewCategory" class="p-5 space-y-2">
                    <div class="flex flex-col space-y-2">
                        <label for="title" class="font-roboto text-lg text-gray-600">Title <span class="text-red-600" title="Required">*</span></label>
                        <input type="text" v-model="category.title" placeholder="Title" id="title" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                    </div>
                    <div class="flex flex-col space-y-2">
                        <label for="slug" class="font-roboto text-lg text-gray-600">Slug <span class="text-red-600" title="Required">*</span></label>
                        <input type="text" v-model="category.slug" placeholder="Slug" id="slug" class="border border-gray-200 font-roboto text-gray-500 rounded-2xl py-2 px-4 outline-none focus:outline-none">
                    </div>
                    <div class="flex justify-end mt-2">
                        <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-roboto py-1.5 px-4 rounded-3xl">Save</button>
                    </div>
                </form>
            </div>          
        </div>
    </AppLayout>
</template>