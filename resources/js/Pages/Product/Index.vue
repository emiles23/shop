<template>
    <Main>
    <div class="flex justify-center py-32">
        <div class="w-10/12 mt-6 grid grid-cols-1 gap-x-10 gap-y-20 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
            <ProductCard v-for="(product, index) in products" :key="index" :product="product"
                :discountGroups="discountGroups" :getProductDiscount="getProductDiscount(product)" class="
              dark:bg-secondary-900 bg-gray-50 
              px-2
              py-3 
              rounded-xl" />
        </div>
    </div>
    </Main>
</template>
  
<script>

import ProductCard from '@/Components/ProductCard.vue';
import Main from '@/Layouts/Main.vue';

// pinia store
import { mapActions, mapState } from 'pinia'
import { useDefinitionsStore } from '@/store/definitions.js'


export default {
    components: {
        ProductCard,
        Main

    },

    props:{
        products: {
            default: [],
            type: Array
        }
    },

    data() {
        return {
            showCart: false,
            showDiscount: false,
            showCurrentiIndex: null,
        }
    },

    methods: {
        ...mapActions(useDefinitionsStore, ['getProductDiscount'])
    },

    computed: {
        ...mapState(useDefinitionsStore, [
            'discounts', 
            'discountGroups', 
            // 'products', 
            // 'productsWithDicount'
        ]),
    }
}
</script>