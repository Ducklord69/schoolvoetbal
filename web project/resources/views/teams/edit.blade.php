<form method="POST" action="{{ route('teams.update', $team->id) }}">
    @csrf
    @method('PATCH')
    <div>
        <label for="name">Team Name</label>
        <input type="text" name="name" value="{{ $team->name }}" required>
    </div>

    <div>
        <label for="description">Team Description</label>
        <textarea name="description" rows="4">{{ $team->description }}</textarea>
    </div>

    <button type="submit">Update Team</button>
</form>
