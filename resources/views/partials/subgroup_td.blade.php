<td>
    @if($second_person)
        @foreach($subgroup_contestants as $contestant)
            @if($contestant->subgroup_order === $i)
                {{ $contestant->name }}{{ $loop->odd ? ' & ' : '' }}
            @endif
        @endforeach
    @else
        @foreach($subgroup_contestants as $contestant)
            @if($contestant->subgroup_order === $i)
                {{ $contestant->name }}
            @endif
        @endforeach
    @endif
</td>