import axios from "axios"

const baseAPI = import.meta.env.VITE_BASE_URL

const API = axios.create({
    baseURL: baseAPI
})

export default API