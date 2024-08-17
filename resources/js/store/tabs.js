import { defineStore } from 'pinia'

export const useTabsStore = defineStore('tabs', {

  state: () => ({

    currentTab: null,
    tabs: [
      { name: 'Productos', component: 'ProductsAvailable' },
      { name: 'Checkout', component: 'Checkout' },
      { name: 'Login', component: 'Login' },
      { name: 'Product', component: 'Product', isVisible:false }
    ],

  }),
})