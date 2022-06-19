<?php

namespace App\Traits;

use App\Models\Reserve;
use App\Models\Service;
use Carbon\Carbon;

trait TimeHandel
{

    public function table(array|int $times, int $duration)
    {
        if (is_string($times[0])) {
            return $this->TimetoArray($times, $duration);
        }
        foreach ($times as $value) {
            $result[] = $this->TimetoArray($value, $duration);
        }
        $finish = [];
        foreach ($result as $value) {
            foreach ($value as $val) {
                $finish[] = $val;
            }
        }
        return $finish;
    }

    public function TimetoArray(array $value, int $duration)
    {
        $container = [];
        $b = Carbon::parse($value[0])->diffInMinutes($value[1]);
        $a = Carbon::parse($value[0]);
        if ($b >= $duration) {
            for ($i = 0; $i <= $b / $duration; $i++) {
                $container[] = $a->format('h:i A');
                $a->addMinutes($duration);
            }
        }
        $container = array_map(fn ($val) =>  $val = (array_search($val, $container) !== array_key_last($container)) ? [$val, $container[array_search($val, $container) + 1]] : '', $container);
        array_pop($container);
        foreach ($container as &$val) {
            $val['station_id'] = $value['station_id'];
        }
        return $container;
    }

    public static function getFreeTime(array $where, $service_time)
    {
        $result = Reserve::where($where)->get();
        if (empty($result->toArray())) {
            return Reserve::TIME;
        }


        $result = $result->map(fn ($val) => $val = [$val->open_time, $val->exit_time])
            ->sortby(fn ($val) => strtotime($val[0]))->values()->toArray();

        $container = [];
        foreach ($result as $key => $value) {
            if (isset($result[$key + 1]) && Carbon::parse($value[1])->diffInMinutes($result[$key + 1][0]) >= $service_time) {
                $container[] = [$value[1], $result[$key + 1][0]];
            }
        }
        $first = $result[0][0];
        $last = $result[array_key_last($result)][1];
        if (Carbon::parse($first)->diffInMinutes(Reserve::TIME[0]) >= $service_time) {
            array_unshift($container, [Reserve::TIME[0], $first]);
        }
        if (Carbon::parse(Reserve::TIME[1])->diffInMinutes($last) >= $service_time) {
            $container[] = [$last, Reserve::TIME[1]];
        }

        return $container;
    }

    public function uniqeTime($values)
    {
        $container = [];
        foreach ($values as $value) {
            foreach ($values as $val) {
                if ($value['station_id'] === $this->min_id($values)) {
                    if ($value[0] === $val[0] && $value[1] === $val[1] && $val['station_id'] !== $this->min_id($values)) {
                        $container[] = $val;
                    }
                }
            }
        }

        foreach ($values as $value) {
            if (!in_array($value, $container)) {
                $result[] = $value;
            }
        }
        return self::sortTime($result);
    }

    public function min_id($value)
    {
        return collect($value)->pluck('station_id')->unique()->min();
    }

    public static function sortTime($values)
    {
        $result = collect($values)
            ->sortby(fn ($val) => strtotime($val[0]))->values()->toArray();
        return $result;
    }

    public static function getAllStationFreeTime($stations, $request)
    {
        foreach ($stations as $value) {
            $result = Reserve::getFreeTime(
                [
                    ['station_id', $value->id],
                    ['day', $request['day']]
                ],
                Service::time($request['service'])
            );

            if (is_string($result[0])) {
                $result = [$result];
            }
            foreach ($result as &$val) {
                $val['station_id'] = $value['id'];
                $container[] = $val;
            }
        }
        return $container;
    }
}
