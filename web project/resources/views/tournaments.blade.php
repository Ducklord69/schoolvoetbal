<x-base-layout>
    <h1 class="text-2xl font-bold mb-6 text-white text-center">
        All Tournaments
    </h1>

    @if($tournaments->isEmpty())
        <p class="text-white text-center">There are no tournaments available.</p>
    @else
        <div class="overflow-x-auto">
            <div class="mx-auto max-w-4xl">
                <table class="w-full bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                    <thead class="bg-gray-700">
                        <tr>
                            <th class="px-5 py-3 text-left text-sm font-medium text-white uppercase">Name</th>
                            <th class="px-5 py-3 text-left text-sm font-medium text-white uppercase">Description</th>
                            <th class="px-5 py-3 text-left text-sm font-medium text-white uppercase">Status</th>
                            <th class="px-5 py-3 text-left text-sm font-medium text-white uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tournaments as $tournament)
                            <tr class="border-b border-gray-700 hover:bg-gray-600">
                                <td class="px-5 py-3 text-white text-sm">{{ $tournament->name }}</td>
                                <td class="px-5 py-3 text-white text-sm">{{ $tournament->description }}</td>
                                <td class="px-5 py-3 text-white text-sm">{{ ucfirst($tournament->status) }}</td>
                                <td class="px-5 py-3 text-white text-sm">
                                    @if(Auth::user()->role === 'coach')
                                        <!-- Sign Up Button -->
                                        @if(Auth::user()->role === 'coach')
                                            <form action="{{ route('tournaments.signup', $tournament->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-green-400 hover:underline">Sign Up</button>
                                            </form>
                                        @endif
                                    @elseif(Auth::user()->role === 'admin')
                                        <!-- Admin Actions -->
                                        <a href="{{ route('tournaments.edit', $tournament->id) }}" class="text-yellow-400 hover:underline">Edit</a>
                                        <form action="{{ route('tournaments.destroy', $tournament->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:underline">Delete</button>
                                        </form>
                                    @else
                                        <a href="{{ route('tournaments.show', $tournament->id) }}" class="text-blue-400 hover:underline">View</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</x-base-layout>
