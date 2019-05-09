<form method="post" action="/competitions/{{ $competition->id }}/confirm">
    @method("patch")
    @csrf

    <table class="table table-sm table-bordered">
        <thead>
        <tr>
            <th>Mängija nimi</th>
            <th>Mängija email</th>
            <th>Mänguliik</th>
            <th>Liiga</th>
            <th>Kinnita</th>
        </tr>
        </thead>
        <tbody>

        @foreach($contestants as $contestant)
            <tr>
                <td>{{ $contestant->name }}</td>
                <td>{{ $contestant->email }}</td>
                <td>{{ $contestant->type_name }}</td>
                <td>{{ $contestant->league_name }}</td>
                <td><input name="confirmed[]" value="{{ $contestant->team_id }}" type="checkbox"></td>
            </tr>
        @endforeach

        </tbody>
    </table>
    <button class="btn-change" type="submit">Kinnita valitud mängijad</button>

</form>