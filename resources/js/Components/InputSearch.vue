<template>
  <div class="flex">
    <div class="flex gap-2 relative">
      <Search class="absolute left-2 top-2 h-5 w-5 text-gray-400" />
      <!-- <Close  class="absolute right-2 top-1 h-4 w-4 text-gray-900"/> -->
      <!-- v-model="search" -->
      <input v-model="search" id="search" name="search" placeholder="Buscar por nombre" type="search" class="
        pl-8
        pr-3
        py-2
        w-96
        font-light
        text-sm
        rounded-lg 
        border       
        shadow-xl     
        focus:outline-none 
        focus:text-gray-800
        hover:text-gray-600 
        border-gray-200
        text-gray-200
        dark:text-gray-200
        dark:bg-gray-800
        dark:border-gray-800       
        ">
    </div>
  </div>
</template>

<script>

import Search from '@/Components/icons/Search.vue';
// import Close from "../components/icons/Close.vue";
import { useSearchEngineStore } from "../store/searchEngine.js"
import { mapWritableState } from 'pinia'

export default {

  components: {
    Search,
    // Close
    
  },

  data() {
    return {

    }
  },
   computed:{
    ...mapWritableState(useSearchEngineStore, ['search']),
   }
}
</script>