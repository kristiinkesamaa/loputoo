<table class="table table-sm table-bordered">
    <thead>
    <tr>
        <th>Liiga</th>
        <th>Paare kokku</th>
    </tr>
    </thead>
    <tbody>
    @foreach($leagues as $league)
        @foreach($types as $type)
            <tr>
                <td><a class="text-grey"
                       href="/competitions/{{ $competition->id }}/{{ $league->name }}/{{ $type->short_name }}">{{ $league->name }} {{ $type->short_name }}</a>
                </td>
                <td>
                    <?php $number_of_teams = 0; $a = 0; ?>
                    @foreach($contestants as $contestant)
                        @if($contestant->league_id === $league->id && $contestant->type_id === $type->id && $a % 2 === 0)
                            <?php $number_of_teams++; ?>
                        @endif
                        <?php $a++ ?>
                    @endforeach
                    {{ $number_of_teams }}
                </td>
            </tr>
        @endforeach
    @endforeach
    </tbody>
</table>