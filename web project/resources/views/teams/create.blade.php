<x-base-layout>
    <form method="POST" action="{{ route('teams.store') }}">
        @csrf
        <div>
            <label for="name">Team Name</label>
            <input type="text" name="name" required>
        </div>

        <div>
            <label for="description">Team Description (Optional)</label>
            <textarea name="description" rows="4"></textarea>
        </div>

        <button type="submit">Create Team</button>
    </form>
</x-base-layout>
