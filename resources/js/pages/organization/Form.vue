<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Button } from '@/components/ui/button';
import InputError from '@/components/InputError.vue';
import { toast } from 'vue-sonner';
import { computed, onUnmounted, ref } from 'vue';

const props = defineProps({
    organization: {
        type: Object,
    }
})

const form = useForm({
    name: props.organization?.name || '',
    address: props.organization?.address || '',
    city: props.organization?.city || '',
    state: props.organization?.state || '',
    zip_code: props.organization?.zip_code || '',
    logo: null as File | string | null,
    _method: props.organization ? 'PUT' : 'POST',
});

const logoPreview = ref<string | null>(null);
const currentLogo = computed(() => props.organization?.logo);

const handleLogoChange = (event: Event) => {
    const target = event.target as HTMLInputElement;
    const file = target.files?.[0];
    if (file) {
        form.logo = file;
        logoPreview.value = URL.createObjectURL(file);
    }
}

const removeLogo = () => {
    form.logo = 'REMOVE';
    logoPreview.value = null;
    const fileInput = document.getElementById('logo') as HTMLInputElement;
    if (fileInput) fileInput.value = '';
}

const submit = () => {
    if (props.organization) {
        // Use POST with method spoofing for multipart/form-data
        form.post(route('organization.update'), {
            forceFormData: true,
            preserveScroll: true,
            onSuccess: () => {
                toast.success('Organization updated successfully.');
            },
            onError: () => {
                toast.error('Error updating organization. Please try again.');
            }
        });
    } else {
        form.post(route('organization.store'), {
            forceFormData: true,
            preserveScroll: true,
            onSuccess: () => {
                toast.success('Organization created successfully.');
            },
            onError: () => {
                toast.error('Error creating organization. Please try again.');
            }
        })
    }
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Organization Settings',
        href: '/organization-settings',
    },
];

onUnmounted(() => {
    if (logoPreview.value) {
        URL.revokeObjectURL(logoPreview.value);
    }
})
</script>

<template>
    <Head title="Organization Settings" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <form @submit.prevent="submit">
            <div class="mx-auto max-w-2xl mt-6">
                <div class="grid gap-6">
                    <div class="grid gap-2">
                        <Label for="name">Organization Name</Label>
                        <Input id="name" type="text" required autofocus tabindex="1" v-model="form.name" />
                        <InputError :message="form.errors.name" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="address">Address</Label>
                        <Input id="address" type="text" required tabindex="2" v-model="form.address" />
                        <InputError :message="form.errors.address" />
                    </div>
                    <div class="grid grid-cols-3 gap-6">
                        <div class="grid gap-2">
                            <Label for="city">City</Label>
                            <Input id="city" type="text" required tabindex="3" v-model="form.city" />
                            <InputError :message="form.errors.city" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="state">State</Label>
                            <Input id="state" type="text" required tabindex="4" v-model="form.state" />
                            <InputError :message="form.errors.state" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="zip_code">Zip Code</Label>
                            <Input id="zip_code" type="text" required tabindex="5" v-model="form.zip_code" />
                            <InputError :message="form.errors.zip_code" />
                        </div>
                    </div>
                    <div class="grid gap-2">
                        <Label for="logo">Logo</Label>

                        <div v-if="logoPreview" class="mb-2">
                            <p class="text-sm text-muted-foreground mb-2">New logo preview</p>
                            <img :src="logoPreview" alt="logo" class="max-w-32 h-auto rounded-md border" />
                        </div>

                        <div v-if="currentLogo && !logoPreview && form.logo !== 'REMOVE'" class="mb-2">
                            <p class="text-sm text-muted-foreground mb-2">Current logo</p>
                            <img :src="`/storage/${currentLogo}`" alt="Current logo" class="max-w-32 h-auto rounded-md border" />
                        </div>

                        <Button
                            v-if="(currentLogo && form.logo !== 'REMOVE') || logoPreview"
                            type="button"
                            variant="outline"
                            size="sm"
                            @click="removeLogo"
                            class="w-fit"
                            >Remove Logo</Button>

                        <Input
                            id="logo"
                            type="file"
                            accept="image/*"
                            @change="handleLogoChange"
                            class="cursor-pointer"
                        />
                        <p class="text-xs text-muted-foreground">Upload a logo image (PNG, JPG, GIF)</p>
                        <InputError :message="form.errors.logo" />
                    </div>
                     <Button type="submit" :disabled="form.processing">
                         Update Organization
                     </Button>
                </div>
            </div>
        </form>
    </AppLayout>
</template>
