<form method="post" action="/competitions/{{ $competition->id }}/confirm">
    @method("patch")
    @csrf

    <table class="table table-sm table-bordered">
        <thead>
        <tr>
            <th>1. mängija nimi</th>
            <th>1. mängija email</th>
            <th>2. mängija nimi</th>
            <th>2. mängija email</th>
            <th>Mänguliik</th>
            <th>Liiga</th>
            <th>Kinnita</th>
        </tr>
        </thead>
        <?php $a = 0 ?>
        <tbody>

        @foreach($unconfirmed_contestants as $contestant)

            @if($a % 2 === 0)
                <tr>
                    @endif

                    <td>{{ $contestant->name }}</td>
                    <td>{{ $contestant->email }}</td>

                    @if($a % 2 === 1)

                        <td>{{ $contestant->type_name }}</td>
                        <td>{{ $contestant->league_name }}</td>
                        <td><input class="confirm-checkbox" name="confirm[]" value="{{ $contestant->team_id }}"
                                   type="checkbox"></td>
                </tr>
            @endif

            <?php $a++ ?>
        @endforeach

        </tbody>
    </table>
    <button id="btn-select-all" class="btn-change" type="button">Vali kõik</button>
    <button class="btn-change" type="submit">Kinnita valitud mängijad</button>

</form>

<script>
    $(document).ready(function () {
        $("#btn-select-all").on("click", function () {
            $(".confirm-checkbox").each(function () {
                $(this).click()
            })
        })
    })
</script>