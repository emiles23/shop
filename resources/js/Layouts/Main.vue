<template>
  <div class="font-medium flex " :class="{'dark': isDark }">
    <!-- <NavBar @onChangeDarkMode="(value) => isDark = value" /> -->
    <NavBar />
    <!-- v-if="$route.name !=='Checkout'" -->
    <ShoppingCart  />
    <div class="min-h-screen bg-primary-100 dark:bg-secondary-1000">
      <slot></slot>
    </div>
    
  </div>
</template> 

<script>

import NavBar from '@/Components/NavBar.vue';
import ShoppingCart from '@/Components/ShoppingCart.vue';
// import { darkMode } from "../store.js";

// Pinia store
import { mapState } from 'pinia'
import { useDarkModeStore } from "../store/darkMode.js"

export default {

  components: {
    NavBar,
    ShoppingCart
  },

  data(){
    return{    
    }
  },

  computed:{ 
    ...mapState(useDarkModeStore, ['isDark']),
   },

}
</script>