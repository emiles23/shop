import { defineStore } from 'pinia'

export const useProductDetailStore = defineStore('productDetail', {

  state: () => ({
    displayedProduct: null
  })

})