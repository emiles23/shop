import { defineStore } from 'pinia'

// Puedes nombrar a a la función retornada `defineStore()` como tú quieras
// pero es mejor usar el nombre del almacén poniendo `use` delante y 
// `Store` al final (por ejemplo `useUserStore`, `useCartStore`, 
// `useProductStore`)
// El primer parámetro es el id único del almacén en toda la aplicación
export const useSearchEngineStore = defineStore('searchEngine', {

    state: () => ({ search:'' }),
   
})