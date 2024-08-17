<template>
  <BasicButton :icon="icon" class="px-5" />
</template>

<script>
import BasicButton from "./BasicButton.vue";
import Paypal from "./icons/Paypal.vue";

export default {
  components: {
    BasicButton,
    Paypal
  },

  data() {
    return {
      icon: Paypal
    }
  }
}
</script>