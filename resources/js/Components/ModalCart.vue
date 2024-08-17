<template>
    <div class="absolute inset-0 overflow-hidden">
        <div class="fixed inset-y-0 right-0 flex max-w-full">
            <div class="max-w-md max-h-screen-80">
                <div class="flex h-full bg-white dark:bg-secondary-900 w-96 shadow-xl">
                    <div class="flex-1 overflow-y-auto  sm:px-6 ">
                        <slot>
                        </slot>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.max-h-screen-80 {
    max-height: 79vh;
}
</style>
