<template>
    <BasicCard class="relative p-2" :class="show ? 'h-auto' : 'h-10'">
        <h1 class="pb-4">{{ titleAccordio }}</h1>
        <button @click=" show = !show" class="absolute right-3" :class="show ? 'top-2' : 'top-0 bottom-0'">
            <Minus v-if="show" class="h-5 w-5" />
            <Plus v-else class="h-5 w-5" />
        </button>
        <slot v-if="show"></slot>
    </BasicCard>
</template>
  
<script>

import BasicCard from "./BasicCard.vue";
import Minus from "./icons/Minus.vue";
import Plus from "./icons/Plus.vue";

export default {

    components: {
        BasicCard,
        Minus,
        Plus
    },

    props: {
        titleAccordio: {
            default: "",
        },
    },
    data() {
        return {
            show: false
        }
    },
}
</script>
  
  
  