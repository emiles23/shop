<template>
  <div class="font-medium text-secondary-800 dark:text-primary-300  ">
    <div class="text-right">
      <span v-if="product.productDiscount" class="flex justify-end gap-4">
        <span :class="product.productDiscount ? 'line-through decoration text-secondary-400' : ''">
          ${{ product.price + product.productDiscount }}
        </span>
        <span>
          {{ product.discountRepresentation }}
        </span>
      </span>
      <span>
        ${{ product.discountedPrice }}
      </span>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    product: {
      default: {},
    },
  },
}
</script>