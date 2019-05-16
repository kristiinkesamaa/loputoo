<form method="post" action="/competitions/{{ $competition->id }}/confirm">
    @method("patch")
    @csrf
    <table class="table table-sm table-bordered">
        <thead class="thead-default">
        <tr class="text-center">
            <th>1. mängija nimi</th>
            <th>1. mängija email</th>
            <th>2. mängija nimi</th>
            <th>2. mängija email</th>
            <th>Mänguliik</th>
            <th>Liiga</th>
            <th>Kinnita<input class="ml-2" type="checkbox" name="confirm" id="confirm"></th>
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
                        <td class="text-center"><input class="confirm-checkbox" name="confirm[]"
                                                       value="{{ $contestant->team_id }}"
                                                       type="checkbox"></td>
                </tr>
            @endif

            <?php $a++ ?>
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