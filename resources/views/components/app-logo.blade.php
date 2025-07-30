<div class="flex aspect-square size-8 items-center justify-center rounded-md  text-accent-foreground">
    @if($hasOrganizationLogo)
        <img src="{{ $organizationLogoUrl }}" alt="{{ $organizationName }}" class="size-8">
    @else
        <x-app-logo-icon class="size-5 fill-current text-white dark:text-black" />
    @endif
</div>
<div class="ms-1 grid flex-1 text-start text-sm">
    <span class="truncate leading-tight font-semibold">{{ season_year() }}</span>
    <span class="mb-0.5 truncate leading-tight font-semibold">{{ $organizationName }}</span>
</div>
