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
            <th class="text-center"><input type="checkbox" id="confirm"></th>
        </tr>
        </thead>
        <tbody>

        @foreach($unconfirmed_contestants as $contestant)
            <tr>
                <td>{{ $contestant->name }}</td>
                <td>{{ $contestant->email }}</td>
                <td>{{ $contestant->type_name }}</td>
                <td>{{ $contestant->league_name }}</td>
                <td class="text-center"><input class="confirm-checkbox" name="confirm[]" value="{{ $contestant->team_id }}" type="checkbox"></td>
            </tr>
        @endforeach

        </tbody>
    </table>
    <row>
        <div class="col-12 float-left p-0">
            <button class="btn btn-change text-white float-right" type="submit">Kinnita valitud mängijad</button>

            <button class="btn btn-delete text-white float-left" type="button" data-toggle="modal" data-target=".delete-modal">
                Kustuta valitud mängijad
            </button>

            {{-- Invisible button that sends delete request --}}
            <button type="submit" style="display: none;" id="btn-delete-contestants"
                    formaction="/competitions/{{ $competition->id }}/destroy">
            </button>
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