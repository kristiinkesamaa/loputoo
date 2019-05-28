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
                'leagues.name AS league_name',
                'queues.id AS queue_id'
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

    public static function destroy_by_subgroup(array $subgroup_team_ids)
    {
        DB::table('queues')
            ->whereIn('team_1_id', $subgroup_team_ids)
            ->whereIn('team_2_id', $subgroup_team_ids)
            ->delete();
    }

    public static function destroy_by_id($queue_id)
    {
        $deleted_queue = self::get_by_queue_id($queue_id)[0];
        $queues = self::get_by_subgroup_id($deleted_queue->subgroup_id, $deleted_queue->queue_number);

        foreach ($queues as $queue) {
            self::lower_number($queue->id, $queue->queue_number);
        }

        Queue::destroy($queue_id);
    }

    public static function get_by_queue_id($queue_id)
    {
        return DB::select(DB::raw(
            "SELECT queues.queue_number, subgroup_id from queues
                      JOIN registered_teams rt ON queues.team_1_id = rt.id
                      WHERE queues.id = $queue_id"
        ));

    }

    private static function get_by_subgroup_id($subgroup_id, $queue_number = null)
    {
        if (empty($queue_number)) {
            $and = "";
        } else {
            $and = "AND queue_number > " . $queue_number;
        }

        return DB::select(DB::raw(
            "SELECT queues.* from queues
                      JOIN registered_teams rt ON queues.team_1_id = rt.id
                      WHERE subgroup_id = $subgroup_id $and"
        ));
    }

    private static function lower_number($id, $queue_number)
    {
        DB::table('queues')
            ->where('id', '=', $id)
            ->update([
                'queue_number' => $queue_number - 1
            ]);
    }

    public static function find_if_added($subgroup_id, $team_ids, $second_person)
    {
        $queues = Queue::get_by_subgroup_id($subgroup_id);
        $number = count($team_ids);

            if ($number === 3) {
                $button_states = array_fill(0, 3, true);


                $team_1_id = $team_ids[0];
                $team_2_id = $team_ids[2];

                foreach ($queues as $queue) {
                    $queue->team_1_id === $team_1_id && $queue->team_2_id === $team_2_id ||
                    $queue->team_1_id === $team_2_id && $queue->team_2_id === $team_1_id ? $button_states[0] = false : false;
                }

                $team_1_id = $team_ids[1];
                $team_2_id = $team_ids[2];

                foreach ($queues as $queue) {
                    $queue->team_1_id === $team_1_id && $queue->team_2_id === $team_2_id ||
                    $queue->team_1_id === $team_2_id && $queue->team_2_id === $team_1_id ? $button_states[1] = false : false;
                }

                $team_1_id = $team_ids[0];
                $team_2_id = $team_ids[1];

                foreach ($queues as $queue) {
                    $queue->team_1_id === $team_1_id && $queue->team_2_id === $team_2_id ||
                    $queue->team_1_id === $team_2_id && $queue->team_2_id === $team_1_id ? $button_states[2] = false : false;
                }


            } elseif ($number === 4) {
                $button_states = array_fill(0, 6, true);


                $team_1_id = $team_ids[0];
                $team_2_id = $team_ids[3];

                foreach ($queues as $queue) {
                    $queue->team_1_id === $team_1_id && $queue->team_2_id === $team_2_id ||
                    $queue->team_1_id === $team_2_id && $queue->team_2_id === $team_1_id ? $button_states[0] = false : false;
                }

                $team_1_id = $team_ids[1];
                $team_2_id = $team_ids[2];

                foreach ($queues as $queue) {
                    $queue->team_1_id === $team_1_id && $queue->team_2_id === $team_2_id ||
                    $queue->team_1_id === $team_2_id && $queue->team_2_id === $team_1_id ? $button_states[1] = false : false;
                }

                $team_1_id = $team_ids[0];
                $team_2_id = $team_ids[2];

                foreach ($queues as $queue) {
                    $queue->team_1_id === $team_1_id && $queue->team_2_id === $team_2_id ||
                    $queue->team_1_id === $team_2_id && $queue->team_2_id === $team_1_id ? $button_states[2] = false : false;
                }

                $team_1_id = $team_ids[1];
                $team_2_id = $team_ids[3];

                foreach ($queues as $queue) {
                    $queue->team_1_id === $team_1_id && $queue->team_2_id === $team_2_id ||
                    $queue->team_1_id === $team_2_id && $queue->team_2_id === $team_1_id ? $button_states[3] = false : false;
                }

                $team_1_id = $team_ids[0];
                $team_2_id = $team_ids[1];

                foreach ($queues as $queue) {
                    $queue->team_1_id === $team_1_id && $queue->team_2_id === $team_2_id ||
                    $queue->team_1_id === $team_2_id && $queue->team_2_id === $team_1_id ? $button_states[4] = false : false;
                }

                $team_1_id = $team_ids[2];
                $team_2_id = $team_ids[3];

                foreach ($queues as $queue) {
                    $queue->team_1_id === $team_1_id && $queue->team_2_id === $team_2_id ||
                    $queue->team_1_id === $team_2_id && $queue->team_2_id === $team_1_id ? $button_states[5] = false : false;
                }


            } else {
                $button_states = array_fill(0, 10, true);


                $team_1_id = $team_ids[1];
                $team_2_id = $team_ids[4];

                foreach ($queues as $queue) {
                    $queue->team_1_id === $team_1_id && $queue->team_2_id === $team_2_id ||
                    $queue->team_1_id === $team_2_id && $queue->team_2_id === $team_1_id ? $button_states[0] = false : false;
                }

                $team_1_id = $team_ids[2];
                $team_2_id = $team_ids[3];

                foreach ($queues as $queue) {
                    $queue->team_1_id === $team_1_id && $queue->team_2_id === $team_2_id ||
                    $queue->team_1_id === $team_2_id && $queue->team_2_id === $team_1_id ? $button_states[1] = false : false;
                }

                $team_1_id = $team_ids[0];
                $team_2_id = $team_ids[4];

                foreach ($queues as $queue) {
                    $queue->team_1_id === $team_1_id && $queue->team_2_id === $team_2_id ||
                    $queue->team_1_id === $team_2_id && $queue->team_2_id === $team_1_id ? $button_states[2] = false : false;
                }

                $team_1_id = $team_ids[1];
                $team_2_id = $team_ids[2];

                foreach ($queues as $queue) {
                    $queue->team_1_id === $team_1_id && $queue->team_2_id === $team_2_id ||
                    $queue->team_1_id === $team_2_id && $queue->team_2_id === $team_1_id ? $button_states[3] = false : false;
                }

                $team_1_id = $team_ids[0];
                $team_2_id = $team_ids[3];

                foreach ($queues as $queue) {
                    $queue->team_1_id === $team_1_id && $queue->team_2_id === $team_2_id ||
                    $queue->team_1_id === $team_2_id && $queue->team_2_id === $team_1_id ? $button_states[4] = false : false;
                }

                $team_1_id = $team_ids[2];
                $team_2_id = $team_ids[4];

                foreach ($queues as $queue) {
                    $queue->team_1_id === $team_1_id && $queue->team_2_id === $team_2_id ||
                    $queue->team_1_id === $team_2_id && $queue->team_2_id === $team_1_id ? $button_states[5] = false : false;
                }

                $team_1_id = $team_ids[0];
                $team_2_id = $team_ids[2];

                foreach ($queues as $queue) {
                    $queue->team_1_id === $team_1_id && $queue->team_2_id === $team_2_id ||
                    $queue->team_1_id === $team_2_id && $queue->team_2_id === $team_1_id ? $button_states[6] = false : false;
                }

                $team_1_id = $team_ids[1];
                $team_2_id = $team_ids[3];

                foreach ($queues as $queue) {
                    $queue->team_1_id === $team_1_id && $queue->team_2_id === $team_2_id ||
                    $queue->team_1_id === $team_2_id && $queue->team_2_id === $team_1_id ? $button_states[7] = false : false;
                }

                $team_1_id = $team_ids[0];
                $team_2_id = $team_ids[1];

                foreach ($queues as $queue) {
                    $queue->team_1_id === $team_1_id && $queue->team_2_id === $team_2_id ||
                    $queue->team_1_id === $team_2_id && $queue->team_2_id === $team_1_id ? $button_states[8] = false : false;
                }

                $team_1_id = $team_ids[3];
                $team_2_id = $team_ids[4];

                foreach ($queues as $queue) {
                    $queue->team_1_id === $team_1_id && $queue->team_2_id === $team_2_id ||
                    $queue->team_1_id === $team_2_id && $queue->team_2_id === $team_1_id ? $button_states[9] = false : false;
                }
            }

        return $button_states;
    }

}
