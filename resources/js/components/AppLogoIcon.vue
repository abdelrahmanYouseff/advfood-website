<script setup lang="ts">
import type { HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

defineProps<Props>();
</script>

<template>
    <img
        :src="`http://127.0.0.1:8002/images/gatherus-logo-new.png?v=${Date.now()}`"
        alt="GatherUs Logo"
        :class="className"
        v-bind="$attrs"
        class="h-6 w-auto"
    />
</template>
