import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

interface Organization {
    id: number;
    name: string;
    address: string;
    city: string;
    state: string;
    zip_code: string;
    logo: string | null;
    created_at: string;
    updated_at: string;
}

export function useOrganization() {
    const page = usePage();
    
    const organization = computed(() => page.props.organization as Organization | null);
    
    const hasOrganization = computed(() => organization.value !== null);
    
    const organizationName = computed(() => organization.value?.name || null);
    
    const organizationLogo = computed(() => {
        if (organization.value?.logo) {
            return `/storage/${organization.value.logo}`;
        }
        return null;
    });
    
    return {
        organization,
        hasOrganization,
        organizationName,
        organizationLogo,
    };
}