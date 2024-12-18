<x-base-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-5xl font-bold text-center mb-8 text-white">{{ $tournament->name }} Bracket</h1>

        <div class="mt-6">
            <h2 class="text-2xl font-bold text-black mb-4">Participating Teams</h2>
            <ul class="list-disc list-inside text-white">
                @forelse($teams as $team)
                    <li class="text-black">{{ $team->id }} - {{ $team->name }}</li>
                @empty
                    <li>No teams found</li>
                @endforelse
            </ul>
        </div>

        <!-- Tournament Bracket -->
        <div class="flex flex-wrap justify-center overflow-x-auto space-x-6">
            @forelse($rounds as $roundNumber => $matches)
                <div class="w-full md:w-1/4 min-w-[200px]">
                    <h2 class="text-xl font-semibold text-center mb-4 text-white">Round {{ $roundNumber }}</h2>
                    <div class="space-y-6">
                        @foreach($matches as $match)
                            <div class="bg-white rounded-lg shadow-md p-4">
                                <div class="flex items-center justify-between">
                                    @if(auth()->user()->hasRole('admin'))
                                        <a href="{{ route('matches.editForAdmin', $match->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                                    @endif
                                    @if(auth()->user()->hasRole('referee'))
                                        <a href="{{ route('matches.editForReferee', $match->id) }}" class="text-green-500 hover:text-green-700">Edit as Referee</a>
                                    @endif
                                    <div class="flex-1 text-center">
                                        <span class="{{ $match->winner_id == $match->team1_id ? 'text-green-600 font-bold' : 'text-gray-800' }}">
                                            {{ $match->team1->name }}
                                        </span>
                                        @if($match->team1_score !== null)
                                            <span class="text-gray-600"> - {{ $match->team1_score }}</span>
                                        @endif
                                    </div>
                                    <span class="text-gray-500 font-semibold">VS</span>
                                    <div class="flex-1 text-center">
                                        <span class="{{ $match->winner_id == $match->team2_id ? 'text-green-600 font-bold' : 'text-gray-800' }}">
                                            {{ $match->team2->name }}
                                        </span>
                                        @if($match->team2_score !== null)
                                            <span class="text-gray-600"> - {{ $match->team2_score }}</span>
                                        @endif
                                    </div>
                                </div>
                                @if ($match->winner_id)
                                    <div class="text-center mt-4 text-sm text-gray-600">
                                        Winner: <span class="font-semibold">{{ $match->winner->name }}</span>
                                    </div>
                                @else
                                    <div class="text-center mt-4 text-sm text-red-500">
                                        Match Ongoing
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-400 text-xl">No matches available yet.</p>
            @endforelse
        </div>
    </div>
</x-base-layout>
