<x-base-layout>
    <div class="container mx-auto max-w-4xl mt-10 bg-gray-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-6 text-white text-center">Edit Tournament</h1>

        @if(session('success'))
            <div class="mb-4 bg-green-500 text-white text-sm font-medium rounded-lg py-2 px-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('tournaments.update', $tournament->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <!-- Tournament Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-white mb-2">Tournament Name</label>
                <input type="text" name="name" id="name"
                    class="w-full px-4 py-2 border border-gray-600 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('name', $tournament->name) }}" required>
                @error('name')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tournament Description -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-white mb-2">Tournament Description</label>
                <textarea name="description" id="description"
                    class="w-full px-4 py-2 border border-gray-600 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                    rows="4">{{ old('description', $tournament->description) }}</textarea>
                @error('description')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Teams Section: Display all teams associated with the tournament -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-white mb-4">Teams in Tournament</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($tournament->teams as $team)
                        <div class="border border-gray-600 rounded-lg bg-gray-700 p-3 flex items-center">
                            <!-- Team Name -->
                            <span class="text-white text-sm font-medium flex-1">
                                {{ $team->name }}
                            </span>
                            </form>
                        </div>
                    @endforeach

                    <!-- If no teams, display a message -->
                    @if($tournament->teams->isEmpty())
                        <p class="text-sm text-gray-400">No teams associated with this tournament.</p>
                    @endif
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-between items-center">
                @if(auth()->id() == $tournament->user_id && $tournament->status == 'Not_started')
                    <form action="{{ route('tournaments.start', $tournament->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                            Start Tournament
                        </button>
                    </form>
                @endif
                <a href="{{ route('tournaments.index') }}"
                    class="px-6 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-base-layout>
