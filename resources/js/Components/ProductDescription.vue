<template>
  <BasicCard class="grid grid-cols-1 sm:grid-cols-12 p-2 gap-y-10 sm:gap-x-5 lg:gap-x-12">
    <div class="sm:col-span-5 lg:col-span-7 grid grid-cols-12">
      <div class="col-span-2 pr-2 pb-2">
        <img @click="currentImageSrc = image.img" v-for="(image) in displayedProduct.images" :src="image.img"
          :class="currentImageSrc == image.img ? 'border dark:border-tertiary-500 border-tertiary-800' : ''"
          class=" cursor-pointer mb-2">
      </div>
      <div class="col-span-10">
        <img :src="currentImageSrc">
      </div>
    </div>
    <div class="sm:col-span-7 lg:col-span-5 py-5 lg:pr-10 pt-4">
      <div class="text-2xl grid grid-cols-12 pb-5 gap-5">
        <h1 class="col-span-5 md:col-span-9">{{ displayedProduct.name }}</h1>
        <ProductPrice :product="displayedProduct" class="col-span-3 text-end text-xl" />
      </div>
      <div class="flex">
        <h1>0</h1>
        <Star v-for="n in 5" />
      </div>
      <h1 class="pt-7 pb-2">Talla</h1>
      <div class="grid grid-cols-12 gap-1 pb-10">
        <CartSelect v-for="(option, ) in displayedProduct.options" :option="option" v-model="displayedProduct.value"
          class="col-span-2  text-center">
          <h1>{{ option.size }}</h1>
        </CartSelect>
      </div>
      <Accordion :titleAccordio="titleAccordio" class="my-10">
        <table>
          <tbody class="text-justify text-xs font-normal leading-loose">
            <tr v-for="(description) in displayedProduct.descriptions">
              <td class="pr-10">{{ description.key }}</td>
              <td>{{ description.val }}</td>
            </tr>
          </tbody>
        </table>
      </Accordion>
      <CustomButton @click="add(displayedProduct)">Agregar al Carrito</CustomButton>
    </div>

  </BasicCard>
</template>

<script>
import CartSelect from "./CartSelect.vue";
import BasicCard from "./BasicCard.vue";
import CustomButton from "./CustomButton.vue";
import Star from "./icons/Star.vue";
import Accordion from "./Accordion.vue";
import ProductPrice from "./ProductPrice.vue"

// pinia
import { mapState, mapActions } from 'pinia'
import { useProductDetailStore } from "../store/productDetail.js"
import { useShoppingCartStoreStore } from "../store/shoppingCartStore.js"

export default {
  components: {
    BasicCard,
    Star,
    CartSelect,
    CustomButton,
    Accordion,
    ProductPrice,
  },
  data() {
    return {
      currentImageSrc: '',
      titleAccordio: 'Descripción',
    }
  },

  methods: {
    ...mapActions(useShoppingCartStoreStore, ['add']),
  },

  mounted() {
    this.currentImageSrc = this.displayedProduct.images?.at(0).img ?? ''
  },

  computed: {
    ...mapState(useProductDetailStore, ['displayedProduct']),
  },
}
</script>


