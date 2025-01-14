<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

defineProps<{
    href: string
    classes?: string
}>();
</script>

<template>
    <Link
        :href="href"
        :class="classes"
        class="text-start text-sm leading-5 transition duration-150 ease-in-out"
    >
        <slot />
    </Link>
</template>
