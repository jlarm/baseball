<div class="max-w-4xl mx-auto">
    <div class="text-center">
        <flux:heading size="xl">Welcome! Let's get you set up</flux:heading>
        <flux:text variant="subtle">Complete these steps to get your organization up and running</flux:text>
        <div class="mt-6">
            <div class="w-[300px] mx-auto overflow-hidden rounded-full bg-gray-200">
                <div style="width: {{ $percentComplete }}%" class="h-2 rounded-full bg-black"></div>
            </div>
            <flux:text>{{ $completedSteps }} of {{ $totalSteps }} completed</flux:text>
        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mt-10">
        @foreach($steps as $step)
        <flux:card :class="$step['completed'] ? 'opacity-60' : ''">
            <flux:heading size="lg">{{ $step['title'] }}</flux:heading>

            <flux:text class="mt-2 mb-4">
                <p>{{ $step['description'] }}</p>
            </flux:text>

            @if($step['completed'])
                <flux:button class="w-full" disabled>Completed</flux:button>
            @else
                <flux:button
                    wire:navigate
                    href="{{ route($step['routeName']) }}"
                    class="w-full"
                    variant="primary"
                >
                    Start
                </flux:button>
            @endif
        </flux:card>
        @endforeach
    </div>
</div>
