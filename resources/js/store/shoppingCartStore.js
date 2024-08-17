import { defineStore } from 'pinia'
import { useDefinitionsStore } from "../store/definitions.js"

export const useShoppingCartStoreStore = defineStore('shoppingCartStore', {

    state: () => ({
        products: localStorage.getItem('cartPruducts') !== null  ? JSON.parse(localStorage.getItem('cartPruducts')) : [],
        show: false,
    }),

    actions: {
        add(product) {
            // console.log(this.getTheGroupDiscount())
            var product = { ...product }
            var productFound = this.products.find(productBag => product.name == productBag.name)
            if (productFound) {
                productFound.quantity++
                return
            }

            product.quantity = 1
            product.price = product.discountedPrice > 0 ? product.discountedPrice : product.price
            this.products = [product, ...this.products]
            // shoppingCartStore.products = shoppingCartStore.products
        },

        totalQty() {
            return this.products.map(product => product.quantity)
                .reduce((acc, qty) => acc + qty, 0);

        },

        // Important note
        // functions used in SubtotalTotal and ShoppingCart

        elementCart() {
            return this.products.length == 0
        },

        subtotal() {
            return this.products.map(product => product.quantity * product.price)
                .reduce((acc, toPay) => acc + toPay, 0);
        },

        getDiscountsApplied() {
            const definitionsStore = useDefinitionsStore();

            return definitionsStore.discounts.filter(discountedBrand => this.products
                .some(shoppingCartProduct => discountedBrand.brand === shoppingCartProduct.brand))
        },

        getTheGroupDiscount() {
            const definitionsStore = useDefinitionsStore();
            return definitionsStore.discountGroups.map(group => {
                let prodcuts = this.products.filter(productCart => group.brands.includes(productCart.brand)).map(productCart => {
                    return productCart.brand
                })

                return prodcuts.filter((item, index) => {
                    return prodcuts.indexOf(item) === index;
                })
            })

            // .find(group => group.brands.includes(productCart.brand))
        },

        getDiscountGroupAmount() {
            const definitionsStore = useDefinitionsStore();
            let group = this.getTheGroupDiscount()[0]
            let discountTotal = 0
            let subtotal = this.subtotal()

            discountTotal = definitionsStore.discountGroups
                .filter(discount => subtotal >= discount.min && group.length >= discount.quantity)
                .map(discount => {
                    if (discount.type === 'flat') {
                        return (discount.value)
                    }
                    else {
                        return (subtotal * discount.value) / 100
                    }
                })
                .reduce((acc, toPay) => acc + toPay, 0)
            return discountTotal
        },

        totalPerBrand(discount) {
            return this.products
                .filter(product => product.brand == discount.brand)
                .map(product => product.quantity * product.price)
                .reduce((acc, toPay) => acc + toPay, 0)
        },

        totalDiscount() {
            return this.getDiscountsApplied()
                .filter(discount => this.totalPerBrand(discount) >= discount.min)
                .map(discount => this.totalPerBrand(discount) * (discount.value / 100))
                .reduce((acc, toPay) => acc + toPay, 0) + this.getDiscountGroupAmount()

        },

    },
})
