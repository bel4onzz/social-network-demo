<template>
    <div class="w-full">
        <div class="flex flex-col sm:justify-center items-center sm:pt-0">
            <slot name="logo" class="mx-auto" />
        </div>

        <div class="w-full">
            <slot />
        </div>
    </div>
</template>
