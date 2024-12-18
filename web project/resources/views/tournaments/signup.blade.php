<x-base-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-md mx-auto bg-gray-800 rounded-lg shadow-lg p-8">
            <h2 class="text-2xl font-bold mb-6 text-white text-center">Tournament Sign-In</h2>

            @if($errors->any())
                <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('tournaments.signin') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="tournament_id" class="block text-white mb-2">Select Tournament</label>
                    <select
                        name="tournament_id"
                        id="tournament_id"
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    >
                        <option value="">Choose a Tournament</option>
                        @foreach($tournaments as $tournament)
                            <option value="{{ $tournament->id }}">
                                {{ $tournament->name }}
                                ({{ ucfirst($tournament->status) }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="team_id" class="block text-white mb-2">Select Your Team</label>
                    <select
                        name="team_id"
                        id="team_id"
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    >
                        <option value="">Choose Your Team</option>
                        @foreach(auth()->user()->teams as $team)
                            <option value="{{ $team->id }}">
                                {{ $team->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="confirmation" class="flex items-center text-white">
                        <input
                            type="checkbox"
                            name="confirmation"
                            id="confirmation"
                            class="mr-2 bg-gray-700 text-blue-500 rounded focus:ring-blue-500"
                            required
                        >
                        I confirm I want to sign up this team for the tournament
                    </label>
                </div>

                <button
                    type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300"
                >
                    Sign In to Tournament
                </button>
            </form>
        </div>
    </div>
</x-base-layout>
