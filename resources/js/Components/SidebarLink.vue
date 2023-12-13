<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps(["href", "active"]);

const classes = computed(() =>
    props.active
        ? "flex items-center font-500 text-sm pl-6 py-[6px] text-black rounded-md"
        : "flex items-center font-500 text-sm pl-6 py-[6px] text-gray-400 rounded-md"
);
</script>

<template>
    <Link :href="href" :class="classes">
    <slot />
    </Link>
</template>
