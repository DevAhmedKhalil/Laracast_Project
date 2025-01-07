<x-layout>
    <x-slot:heading>
        Register as an Employer
    </x-slot:heading>

    <form method="POST" action="{{ route('employer.store') }}">
        @csrf

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Create an Employer Profile</h2>
                <p class="mt-1 text-sm/6 text-gray-600">We just need a few details to set up your employer profile.</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <x-form-field>
                        <x-form-label for="name">Employer Name</x-form-label>
                        <div class="mt-2">
                            <x-form-input name="name" id="name" placeholder="Your Company Name" required/>
                            <x-form-error name="name"/>
                        </div>
                    </x-form-field>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="{{ route('jobs.index') }}" class="text-sm/6 font-semibold text-gray-900">
                Cancel
            </a>
            <x-form-button>Register</x-form-button>
        </div>
    </form>
</x-layout>
