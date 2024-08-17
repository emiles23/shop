import { defineStore } from 'pinia'

export const useDarkModeStore = defineStore('darkMode', {

    state: () => ({ isDark: localStorage.isDark !== undefined ? JSON.parse(localStorage.isDark) : false }),

})