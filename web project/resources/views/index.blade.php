<x-base-layout>
        <div class="container mx-auto p-6">
            <h1 class="text-3xl font-bold mb-6">Open Tournaments for Signup</h1>
            <ul>
                @forelse($tournaments as $tournament)

                        <li class="mb-4 bg-gray-800 p-4 rounded-lg shadow-md">
                            <h2 class="text-xl font-bold text-white">{{ $tournament->name }}</h2>
                            <p class="text-gray-400">{{ $tournament->description }}</p>
                            <div class="mt-4">
                                <a href="{{ route('tournaments.show', $tournament->id) }}" class="text-blue-500 hover:text-blue-700">View Tournament</a>
                                <form action="{{ route('tournaments.signup', $tournament->id) }}" method="POST" class="inline-block ml-4">
                                    @csrf
                                    <button type="submit" class="text-green-500 hover:text-green-700">Sign Up Team</button>
                                </form>
                            </div>
                        </li>

                @empty
                    <li class="text-gray-400">No tournaments available for signup</li>
                @endforelse
            </ul>
        </div>
</x-base-layout>
