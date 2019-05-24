@if($second_person)

    @foreach($contestants as $contestant)
        @if($contestant->subgroup_id === 0)
            @if($loop->odd)
                <?php $contestant_1_name = $contestant->name ?>
            @else
                <option value="{{ $contestant->team_id }}">
                    {{ $contestant_1_name }}
                    & {{ $contestant->name }}
                </option>
            @endif

        @endif
    @endforeach
@else
    @foreach($contestants as $contestant)
        <option value="{{ $contestant->team_id }}">
            {{ $contestant->name }}
        </option>
    @endforeach
@endif