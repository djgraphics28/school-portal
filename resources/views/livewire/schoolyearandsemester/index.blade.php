<?php

use Livewire\Volt\Component;
use App\Models\SchoolYear;
use App\Models\Semester;
use App\Models\SySem;

new class extends Component {
    public $school_years,
        $semesters,
        $sysems,
        $selectedYear,
        $selectedSemester,
        $is_active = false,
        $showSchoolYearModal = false,
        $showSemesterModal = false,
        $yearName,
        $semesterName,
        $editingYearId,
        $editingSemesterId;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->school_years = SchoolYear::with('semesters')->get();
        $this->semesters = Semester::all();
        $this->sysems = SySem::all();
    }

    public function editSchoolYear($id)
    {
        $year = SchoolYear::find($id);
        $this->editingYearId = $id;
        $this->yearName = $year->name;
        $this->showSchoolYearModal = true;
    }

    public function editSemester($id)
    {
        $semester = Semester::find($id);
        $this->editingSemesterId = $id;
        $this->semesterName = $semester->name;
        $this->showSemesterModal = true;
    }

    public function saveSchoolYear()
    {
        $this->validate([
            'yearName' => 'required|string|max:255|unique:school_years,name,' . $this->editingYearId,
        ]);

        if ($this->editingYearId) {
            SchoolYear::find($this->editingYearId)->update([
                'name' => $this->yearName,
            ]);
            flash()->success('School Year updated successfully!');
        } else {
            SchoolYear::create([
                'name' => $this->yearName,
            ]);
            flash()->success('School Year created successfully!');
        }

        $this->showSchoolYearModal = false;
        $this->yearName = '';
        $this->editingYearId = null;
        $this->loadData();
    }

    public function saveSemester()
    {
        $this->validate([
            'semesterName' => 'required|string|max:255|unique:semesters,name,' . $this->editingSemesterId,
        ]);

        if ($this->editingSemesterId) {
            Semester::find($this->editingSemesterId)->update([
                'name' => $this->semesterName,
            ]);
            flash()->success('Semester updated successfully!');
        } else {
            Semester::create([
                'name' => $this->semesterName,
            ]);
            flash()->success('Semester created successfully!');
        }

        $this->showSemesterModal = false;
        $this->semesterName = '';
        $this->editingSemesterId = null;
        $this->loadData();
    }

    public function save()
    {
        $this->validate([
            'selectedYear' => 'required|exists:school_years,id',
            'selectedSemester' => 'required|exists:semesters,id',
            'is_active' => 'boolean',
        ]);

        if ($this->is_active) {
            // Set all other semesters to inactive first
            SySem::where('is_active', true)->update(['is_active' => false]);
        }

        $year = SchoolYear::find($this->selectedYear);
        $year->semesters()->attach($this->selectedSemester, [
            'is_active' => $this->is_active,
        ]);

        flash()->success('Semester has been assigned!');
        $this->resetForm();
        $this->loadData();
    }

    public function toggleActive($yearId, $semesterId)
    {
        $year = SchoolYear::find($yearId);
        $semester = $year->semesters()->where('semesters.id', $semesterId)->first();

        if (!$semester->pivot->is_active) {
            // Only update if we're activating (not deactivating)
            // Set all semesters to inactive first
            SySem::where('is_active', true)->update(['is_active' => false]);
        }

        $year->semesters()->updateExistingPivot($semesterId, [
            'is_active' => !$semester->pivot->is_active,
        ]);

        flash()->success('Status updated successfully!');
        $this->loadData();
    }

    public function delete($yearId, $semesterId)
    {
        $year = SchoolYear::find($yearId);
        $year->semesters()->detach($semesterId);

        flash()->success('Semester assignment deleted successfully!');
        $this->loadData();
    }

    public function resetForm()
    {
        $this->selectedYear = null;
        $this->selectedSemester = null;
        $this->is_active = false;
        $this->editingYearId = null;
        $this->editingSemesterId = null;
        $this->yearName = '';
        $this->semesterName = '';
    }
};

?>

<div x-data="{ darkMode: @entangle('darkMode') }" :class="{ 'dark': darkMode }" class="p-6">

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold dark:text-white">School Year & Semester Management</h2>
    </div>

    <div x-data="{ tab: 'assign' }">
        <div class="flex mb-4">
            <button class="px-4 py-2 text-sm rounded-t-lg transition-colors"
                :class="tab === 'assign' ? 'bg-blue-500 text-white dark:bg-blue-600' :
                    'bg-gray-300 dark:bg-gray-700 dark:text-gray-300'"
                @click="tab = 'assign'">Assign Semester</button>

            <button class="px-4 py-2 text-sm rounded-t-lg transition-colors"
                :class="tab === 'list' ? 'bg-blue-500 text-white dark:bg-blue-600' :
                    'bg-gray-300 dark:bg-gray-700 dark:text-gray-300'"
                @click="tab = 'list'">Semesters Lists</button>
        </div>

        <!-- Assign Semester Tab -->
        <div x-show="tab === 'assign'"
            class="p-4 bg-white border dark:bg-gray-800 dark:border-gray-700 transition-colors">
            <h3 class="text-lg font-bold dark:text-white">Assign Semester to School Year</h3>

            <form wire:submit.prevent="save" class="space-y-4">
                <div class="mt-3">
                    <div class="flex items-center justify-between gap-2">
                        <flux:select wire:model="selectedYear" :label="__('Select Year')">
                            <flux:select.option value="">-- Select Year --</flux:select.option>
                            @foreach ($school_years as $year)
                                <flux:select.option value="{{ $year->id }}">{{ $year->name }}</flux:select.option>
                            @endforeach
                        </flux:select>
                        @can('sysem.add-new-school-year')
                            <flux:button wire:click="$set('showSchoolYearModal', true)" color="green">
                                + Add New School Year
                            </flux:button>
                        @endcan
                    </div>

                </div>

                <div>
                    <div class="flex items-center justify-between gap-2">
                        <flux:select wire:model="selectedSemester" :label="__('Select Semester')">
                            <flux:select.option value="">-- Select Semester --</flux:select.option>
                            @foreach ($semesters as $semester)
                                <flux:select.option value="{{ $semester->id }}">{{ $semester->name }}
                                </flux:select.option>
                            @endforeach
                        </flux:select>
                        @can('sysem.add-new-semester')
                            <flux:button wire:click="$set('showSemesterModal', true)" color="green">
                                + Add New Semester
                            </flux:button>
                        @endcan
                    </div>

                </div>

                <div class="flex items-center">
                    <input type="checkbox" wire:model="is_active" class="mr-2 dark:bg-gray-700">
                    <span class="dark:text-gray-300">Set as Active</span>
                </div>

                @can('sysem.create')
                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700 transition-colors">
                        Save
                    </button>
                @endcan

            </form>
        </div>
        <!-- Active Semesters List -->
        <div x-show="tab === 'list'"
            class="p-4 bg-white border dark:bg-gray-800 dark:border-gray-700 transition-colors">
            <h3 class="text-lg font-bold dark:text-white">Semesters Lists</h3>

            <table class="w-full border-collapse border dark:border-gray-700">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700">
                        <th class="border p-2 dark:border-gray-600 dark:text-gray-300">School Year</th>
                        <th class="border p-2 dark:border-gray-600 dark:text-gray-300">Semester</th>
                        <th class="border p-2 dark:border-gray-600 dark:text-gray-300">Active</th>
                        <th width="20%" class="border p-2 dark:border-gray-600 dark:text-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sysems as $sysem)
                        <tr class="dark:text-gray-300">
                            <td class="border p-2 dark:border-gray-600">
                                {{ $sysem->school_year->name }}
                                @can('sysem.edit-school-year')
                                    <button wire:click="editSchoolYear({{ $sysem->school_year_id }})"
                                        class="ml-2 text-blue-500 hover:text-blue-700">
                                        Edit
                                    </button>
                                @endcan
                            </td>
                            <td class="border p-2 dark:border-gray-600">
                                {{ $sysem->semester->name }}
                                @can('sysem.edit-semester')
                                    <button wire:click="editSemester({{ $sysem->semester->id }})"
                                        class="ml-2 text-blue-500 hover:text-blue-700">
                                        Edit
                                    </button>
                                @endcan
                            </td>
                            <td class="border p-2 dark:border-gray-600 text-center">
                                {{ $sysem->is_active ? '✅' : '❌' }}
                            </td>
                            <td class="border p-2 dark:border-gray-600 text-center">
                                <div class="flex gap-2 justify-center">
                                    <button
                                        wire:click="toggleActive({{ $sysem->school_year_id }}, {{ $sysem->semester->id }})"
                                        class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 dark:bg-green-600 dark:hover:bg-green-700 transition-colors">
                                        Toggle Active
                                    </button>
                                    @can('sysem.delete')
                                        <button
                                            wire:click="delete({{ $sysem->school_year_id }}, {{ $sysem->semester->id }})"
                                            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-700 transition-colors">
                                            Delete
                                        </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- School Year Modal -->
    <div x-show="$wire.showSchoolYearModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="relative bg-white rounded-lg max-w-md w-full p-6 dark:bg-gray-800">
                <h3 class="text-lg font-bold mb-4 dark:text-white">
                    {{ $editingYearId ? 'Edit School Year' : 'Add New School Year' }}
                </h3>
                <form wire:submit.prevent="saveSchoolYear">
                    <div class="mb-4">
                        <label class="block dark:text-gray-300">School Year Name</label>
                        <input type="text" wire:model="yearName"
                            class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" wire:click="$set('showSchoolYearModal', false)"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            {{ $editingYearId ? 'Update' : 'Save' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Semester Modal -->
    <div x-show="$wire.showSemesterModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="relative bg-white rounded-lg max-w-md w-full p-6 dark:bg-gray-800">
                <h3 class="text-lg font-bold mb-4 dark:text-white">
                    {{ $editingSemesterId ? 'Edit Semester' : 'Add New Semester' }}
                </h3>
                <form wire:submit.prevent="saveSemester">
                    <div class="mb-4">
                        <label class="block dark:text-gray-300">Semester Name</label>
                        <input type="text" wire:model="semesterName"
                            class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" wire:click="$set('showSemesterModal', false)"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            {{ $editingSemesterId ? 'Update' : 'Save' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
