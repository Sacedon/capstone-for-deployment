<x-perfect-scrollbar
    as="nav"
    aria-label="main"
    class="flex flex-col flex-1 gap-4 px-3"
>

    <x-sidebar.link
        title="Dashboard"
        href="{{ route('dashboard') }}"
        :isActive="request()->routeIs('dashboard')"
    >
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>


    <x-sidebar.link
        title="Add Days"
        href="{{ route('leave-balance.form') }}"
        :isActive="request()->routeIs('leave-balance.form')"
    >
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>
    @php
    $user = auth()->user();
    @endphp

    @if ($user && $user->role === 'admin')
    <x-sidebar.link
        title="Departments"
        href="{{ route('departments.index') }}"
        :isActive="request()->routeIs('departments.index')"
    >
    <x-slot name="icon">
        <x-icons.list class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
    </x-slot>
    </x-sidebar.link>
    @endif

    @php
    $user = auth()->user();
    @endphp

    @if ($user && $user->role === 'admin')
    <x-sidebar.link
        title="User Management"
        href="{{ route('users.index') }}"
        :isActive="request()->routeIs('users.index')"
    >
    <x-slot name="icon">
        <x-icons.usermanage class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
    </x-slot>
    </x-sidebar.link>
    @endif

    @php
    $user = auth()->user();
    @endphp

    @if ($user && $user->role === 'supervisor')
    <x-sidebar.link
        title="List of Employees"
        href="{{ route('employee-users.index') }}"
        :isActive="request()->routeIs('employee-users.index')"
    >
        <x-slot name="icon">
            <x-icons.employee class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>
    @endif


    <x-sidebar.link
        title="Request Leave"
        href="{{ route('leave-requests.create') }}"
        :isActive="request()->routeIs('leave-requests.create')"
    >
        <x-slot name="icon">
            <x-icons.airplane class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    @php
        $user = auth()->user();
    @endphp

    @if ($user && $user->role === 'admin' || $user && $user->role === 'supervisor')
    <x-sidebar.link
    title="Leave Management"
    href="{{ route('leave-requests.index') }}"
    :isActive="request()->routeIs('leave-requests.index')"
>
    <x-slot name="icon">
        <x-icons.leave class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
    </x-slot>
    </x-sidebar.link>
    @endif

    @php
        $user = auth()->user();
    @endphp

    @if ($user && $user->role === 'supervisor')
    <x-sidebar.link
        title="Evaluation"
        href="{{ route('evaluations.index') }}"
        :isActive="request()->routeIs('evaluations.index')"
    >
        <x-slot name="icon">
            <x-icons.evaluation class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>
    @endif


    <x-sidebar.link
    title="Calendar of Events"
    href="{{ route('calendar') }}" {{-- Update the route name --}}
    :isActive="request()->routeIs('calendar')" {{-- Update the route name --}}
    >
    <x-slot name="icon">
        <x-icons.calendar class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
    </x-slot>
    </x-sidebar.link>

    @php
    $user = auth()->user();
    @endphp

    @if ($user && $user->role === 'admin')
    <x-sidebar.link
        title="History"
        href="{{ route('history') }}"
        :isActive="request()->routeIs('history')"
    >
        <x-slot name="icon">
            <x-icons.history class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>
    @endif

    @php
    $user = auth()->user();
    @endphp

    @if ($user && $user->role === 'admin')
        <x-sidebar.link
            title="Login/Logout Records"
            href="{{ route('logs.index') }}"
            :isActive="request()->routeIs('logs.index')"
        >
            <x-slot name="icon">
                <x-icons.records class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </x-slot>
        </x-sidebar.link>
    @endif





</x-perfect-scrollbar>
