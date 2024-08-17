<template>
    <div>
        <div v-if="!elementCart()" class="
            flex justify-between 
            text-secondary-800 
            dark:text-primary-300 font-normal">
            <div>
                <p class=" pb-5">Subtotal actual:</p>
                <p v-if="summary.totalDiscount" class="
                text-red-600">
                    Descuento:
                </p>

                <p class="pt-5 font-semibold">Total</p>
            </div>
            <div>
                <p class=" pb-5">${{ summary.subtotal.toFixed(2) }}</p>

                <p v-if="summary.totalDiscount" class="text-red-600">-${{ summary.totalDiscount.toFixed(2) }}</p>
                <p class=" 
                        border-t 
                        border-primary-300
                        dark:border-secondary-500 
                        pt-5 
                        font-semibold ">
                    ${{ summary.total.toFixed(2) }} </p>
            </div>
        </div>
        <slot></slot>
    </div>
</template>

<script>
import { mapWritableState, mapActions } from 'pinia'
import { useShoppingCartStoreStore } from "../store/shoppingCartStore.js"


export default {

    methods: {

        ...mapActions(useShoppingCartStoreStore,
            [
                'elementCart',
                'subtotal',
                'getDiscountGroupAmount',
                'totalDiscount'
            ]
        ),

        total() {
            return this.subtotal() - this.totalDiscount() - this.getDiscountGroupAmount()
        },
    },

    computed: {
        ...mapWritableState(useShoppingCartStoreStore, ['products']),

        summary() {
            return {
                total: this.total(),
                subtotal: this.subtotal(),
                totalDiscount: this.totalDiscount(),
            }
        },
    }
}
</script>