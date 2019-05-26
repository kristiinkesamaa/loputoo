<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Queue extends Model
{
    public static function get_highest_queue_number_by_competition_id($id)
    {
        return DB::table('queues')
            ->leftJoin('registered_teams', 'team_1_id', '=', 'registered_teams.id')
            ->where('competition_id', '=', $id)
            ->max('queue_number');
    }

    public static function get_data_for_queue_table($id, $second_person)
    {
        $queues = DB::table('queues')
            ->leftJoin('registered_teams', 'team_1_id', '=', 'registered_teams.id')
            ->leftJoin('types', 'type_id', '=', 'types.id')
            ->leftJoin('leagues', 'league_id', '=', 'leagues.id')
            ->where('competition_id', '=', $id)
            ->orderBy('queues.queue_number')
            ->get([
                'queues.*',
                'registered_teams.*',
                'types.name AS type_name',
                'leagues.name AS league_name'
            ]);

        $contestants = RegisteredContestant::get_by_competition_id($id);

        foreach ($queues as $key => $queue) {
            foreach ($contestants as $contestant) {

                if ($queue->team_1_id === $contestant->team_id) {

                    if ($second_person) {

                        if (empty($queues[$key]->team_1_first_contestant_name)) {
                            $queues[$key]->team_1_first_contestant_name = $contestant->name;
                        } else {
                            $queues[$key]->team_1_second_contestant_name = $contestant->name;
                        }

                    } else {
                        $queues[$key]->team_1_name = $contestant->name;
                    }

                } elseif ($queue->team_2_id === $contestant->team_id) {

                    if ($second_person) {

                        if (empty($queues[$key]->team_2_first_contestant_name)) {
                            $queues[$key]->team_2_first_contestant_name = $contestant->name;
                        } else {
                            $queues[$key]->team_2_second_contestant_name = $contestant->name;
                        }

                    } else {
                        $queues[$key]->team_2_name = $contestant->name;
                    }

                }

            }
        }

        $subgroups = Subgroup::get_by_competition_id($id);

        foreach ($queues as $key => $queue) {
            foreach ($subgroups as $subgroup) {
                if ($queue->subgroup_id === $subgroup->id) {
                    $queues{$key}->subgroup_title = $subgroup->title;
                }
            }
        }

        return CompetitionType::add_short_names(self::set_time($queues, $id));
    }

    public static function set_time($queues, $id)
    {
        $time = strtotime(Competition::get_item_by_id($id, 'datetime')[0]->datetime) - 1800;

        $i = 0;
        foreach ($queues as $key => $queue) {
            if ($i % 4 === 0) {
                $time += 1800;
            }
            $queues[$key]->time = date('H:i', $time);
            $i++;
        }

        return $queues;
    }

}
