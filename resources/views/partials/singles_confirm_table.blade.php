<form method="post" action="/competitions/{{ $competition->id }}/confirm">
    @method("patch")
    @csrf



    <table class="table table-sm table-bordered">
        <thead class="thead-default">
        <tr class="text-center">
            <th>Mängija nimi</th>
            <th>Mängija email</th>
            <th>Mänguliik</th>
            <th>Liiga</th>
            <th>Kinnita<input class="ml-2" type="checkbox" name="confirm" id="confirm"></th>
        </tr>
        </thead>
        <tbody>

        @foreach($unconfirmed_contestants as $contestant)
            <tr>
                <td>{{ $contestant->name }}</td>
                <td>{{ $contestant->email }}</td>
                <td>{{ $contestant->type_name }}</td>
                <td>{{ $contestant->league_name }}</td>
                <td><input class="confirm-checkbox" name="confirm[]" value="{{ $contestant->team_id }}" type="checkbox"></td>
            </tr>
        @endforeach

        </tbody>
    </table>
    <row>
        <div class="col-3 float-left p-0">
            <button class="btn btn-change text-white" type="submit">Kinnita valitud mängijad</button>
        </div>
    </row>
</form>

<script>
    $(document).ready(function () {
        $("#confirm").on("click", function () {
            $(".confirm-checkbox").each(function () {
                $(this).click()
            })
        })
    })
</script>