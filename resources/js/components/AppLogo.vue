<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { useOrganization } from '@/composables/useOrganization';

const { organizationName, organizationLogo } = useOrganization();
</script>

<template>
    <div class="flex aspect-square size-8 items-center justify-center rounded-md text-sidebar-primary-foreground">
        <img
            v-if="organizationLogo"
            :src="organizationLogo"
            :alt="organizationName || 'Organization logo'"
            class="size-8 rounded-md object-cover"
        />
        <span v-if="!organizationLogo" class="text-2xl">⚾</span>
        <AppLogoIcon v-else class="size-5 fill-current text-white dark:text-black" />
    </div>
    <div class="ml-1 grid flex-1 text-left text-sm">
        <span class="mb-0.5 truncate leading-tight font-semibold">
            {{ organizationName || 'Baseball Organization' }}
        </span>
    </div>
</template>
