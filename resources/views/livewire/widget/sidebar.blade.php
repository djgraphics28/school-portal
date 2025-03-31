<?php

use Livewire\Volt\Component;

new class extends Component {
    public $search = '';
    public $menuItems = [];

    public function with()
    {
        $menuStructure = [];
        $userType = auth()->user()->user_type;

        // Base navigation for all users
        $menuStructure[] = [
            'heading' => 'Navigations',
            'items' => [
                [
                    'icon' => 'home',
                    'route' => 'dashboard',
                    'label' => 'Home',
                    'permission' => null,
                ],
            ],
        ];

        // Superadmin & Admin menus
        if ($userType === 'superadmin' || $userType === 'admin') {
            $menuStructure[] = [
                'heading' => 'User Management',
                'permission' => null,
                'items' => [
                    [
                        'icon' => 'user-group',
                        'route' => 'users',
                        'label' => 'Users',
                        'permission' => null,
                    ],
                    [
                        'icon' => 'shield-check',
                        'route' => 'roles',
                        'label' => 'Roles',
                        'permission' => null,
                    ],
                ],
            ];

            $menuStructure[] = [
                'heading' => 'School Setup',
                'permission' => null,
                'items' => [
                    [
                        'icon' => 'calendar',
                        'route' => 'schoolyearandsemester',
                        'label' => 'Departments',
                        'permission' => null,
                    ],
                    [
                        'icon' => 'users',
                        'route' => 'schoolyearandsemester',
                        'label' => 'Employees',
                        'permission' => null,
                    ],
                ],
            ];

            $menuStructure[] = [
                'heading' => 'Academic Management',
                'permission' => null,
                'items' => [
                    [
                        'icon' => 'academic-cap',
                        'route' => 'schoolyearandsemester',
                        'label' => 'Manage S.Y. & Sem',
                        'permission' => null,
                    ],
                    [
                        'icon' => 'book-open',
                        'route' => 'schoolyearandsemester',
                        'label' => 'Courses & Majors',
                        'permission' => null,
                    ],
                    [
                        'icon' => 'clipboard-document-list',
                        'route' => 'schoolyearandsemester',
                        'label' => 'Subjects & Curriculum',
                        'permission' => null,
                    ],
                ],
            ];
        }

        // Faculty
        elseif (in_array($userType, ['faculty'])) {
            $menuStructure[] = [
                'heading' => 'Academic Settings',
                'permission' => null,
                'items' => [
                    [
                        'icon' => 'calendar',
                        'route' => 'faculty.schedules',
                        'label' => 'My Schedules',
                        'permission' => null,
                    ],
                ],
            ];
        }

        // Student
        elseif (in_array($userType, ['student'])) {
            $menuStructure[] = [
                'heading' => 'Academic Settings',
                'permission' => null,
                'items' => [
                    [
                        'icon' => 'calendar-days',
                        'route' => 'student.schedules',
                        'label' => 'Schedules',
                        'permission' => null,
                    ],
                    [
                        'icon' => 'book-open',
                        'route' => 'student.subjects',
                        'label' => 'Subjects',
                        'permission' => null,
                    ],
                    [
                        'icon' => 'academic-cap',
                        'route' => 'student.grades',
                        'label' => 'Grades',
                        'permission' => null,
                    ],
                ],
            ];
        }

        $this->menuItems = $this->filterMenuItems($menuStructure, $this->search);

        return [
            'menuItems' => $this->menuItems,
        ];
    }
    protected function filterMenuItems($menuItems, $search)
    {
        if (empty($search)) {
            return collect($menuItems)
                ->filter(function ($group) {
                    // If group has no permission requirement, show it
                    if (!isset($group['permission']) || $group['permission'] === null) {
                        return true;
                    }
                    // Otherwise, check if user has permission
                    return auth()->user()->can($group['permission']);
                })
                ->values()
                ->toArray();
        }

        $search = strtolower($search);

        return collect($menuItems)
            ->map(function ($group) use ($search) {
                $filteredItems = collect($group['items'])
                    ->filter(function ($item) use ($search, $group) {
                        // Search in both heading and item labels
                        return str_contains(strtolower($item['label']), $search) || str_contains(strtolower($group['heading']), $search);
                    })
                    ->values()
                    ->toArray();

                return array_merge($group, ['items' => $filteredItems]);
            })
            ->filter(function ($group) {
                // First check permission
                if (isset($group['permission']) && $group['permission'] !== null && !auth()->user()->can($group['permission'])) {
                    return false;
                }
                // Then check if it has items
                return !empty($group['items']);
            })
            ->values()
            ->toArray();
    }
};
?>
<div>
    <flux:navlist variant="outline" searchable>
        <flux:input type="search" placeholder="Search navigation..." class="mb-4"
            wire:model.live.debounce.300ms="search" />

        @foreach ($menuItems as $group)
            @if ($group['heading'] === 'Navigations')
                <!-- Keep Navigations group non-expandable -->
                <flux:navlist.group heading="{{ __($group['heading']) }}">
                    @foreach ($group['items'] as $item)
                        <flux:navlist.item :icon="$item['icon']" :href="route($item['route'])"
                            :current="request()->routeIs($item['route'])" wire:navigate>
                            {{ __($item['label']) }}
                        </flux:navlist.item>
                    @endforeach
                </flux:navlist.group>
            @else
                <!-- Make all other groups expandable -->
                <flux:navlist.group heading="{{ __($group['heading']) }}" expandable>
                    @foreach ($group['items'] as $item)
                        @if (!$item['permission'] || auth()->user()->can($item['permission']))
                            <flux:navlist.item :icon="$item['icon']" :href="route($item['route'])"
                                :current="request()->routeIs($item['route'])" wire:navigate>
                                {{ __($item['label']) }}
                            </flux:navlist.item>
                        @endif
                    @endforeach
                </flux:navlist.group>
            @endif
        @endforeach
    </flux:navlist>
</div>
