<script setup lang="ts">
</script>

<template>
    <div class="flex items-center gap-x-2">
        <img
            :src="`http://127.0.0.1:8002/images/gatherus-logo-new.png?v=${Date.now()}`"
            alt="GatherUs Logo"
            class="h-8 w-auto"
        />
        <div class="ml-1 grid flex-1 text-left text-sm">
            <span class="mb-0.5 truncate leading-tight font-semibold">Welcome to AdvFood</span>
        </div>
    </div>
</template>
