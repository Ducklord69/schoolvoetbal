<x-base-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        Welcome to your team management dashboard, {{ auth()->user()->name }}!
                    </div>
                    <div class="mt-6 text-gray-500">
                        @if(Auth::user()->role === 'coach')
                        Here you can manage your team and players.
                        @elseif (Auth::user()->role === 'referee')
                        Here you can manage your tournaments.
                        @elseif (Auth::user()->role === 'admin')
                        Here you can manage the system.
                        @endif
                    </div>
                </div>
                <div class="p-6">
                    @if(Auth::user()->role === 'coach')
                        @if(Auth::user()->team)
                            <div class="grid md:grid-cols-2 gap-6">
                                <!-- Team Information Section -->
                                <div class="bg-gray-100 rounded-lg shadow-md p-6">
                                    <h3 class="text-lg font-semibold mb-4">Team Details</h3>

                                    <!-- Edit Team Form -->
                                    <form method="POST" action="{{ route('teams.update', $team->id) }}" class="space-y-4">
                                        @csrf
                                        @method('PATCH')

                                        <div>
                                            <label for="name" class="block text-sm font-medium text-gray-700">Team Name</label>
                                            <input
                                                type="text"
                                                name="name"
                                                id="name"
                                                value="{{ $team->name }}"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                required
                                            >
                                        </div>

                                        <div>
                                            <label for="description" class="block text-sm font-medium text-gray-700">Team Description</label>
                                            <textarea
                                                name="description"
                                                id="description"
                                                rows="4"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                            >{{ $team->description }}</textarea>
                                        </div>

                                        <div>
                                            <button
                                                type="submit"
                                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition"
                                            >
                                                Update Team
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @else
                            <p>No team found. Please create a team.</p>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-base-layout>
