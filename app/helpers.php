<?php

use Carbon\Carbon;

if (!function_exists('recursive')) {
    function recursive($data, $pid = 0)
    {
        $re_data = [];
        foreach ($data as $d) {
            if ($d->parent_id == $pid) {
                $re_data[$d->id] = $d;
                $re_data[$d->id]['children'] = recursive($data, $d->id);
            } else {
                continue;
            }
        }

        return array_values($re_data);
    }
}

if (!function_exists('chance')) {
    function chance($a, $b)
    {
        if ($a === 0 || $b === 0) {
            return '暂无数据';
        }
        return round($a / $b * 100, 2) . '%';
    }
}

if (!function_exists('dateCheck')) {
    function dateCheck($date)
    {
        switch ($date) {
            case 'today':
                return Carbon::today();
                break;
            case 'yesterday':
                return Carbon::yesterday();
                break;
            case 'threeDay':
                return Carbon::today()->modify('-3 days');
                break;
            case 'sevenDay':
                return Carbon::today()->modify('-7 days');
                break;
            case 'fifteenDay':
                return Carbon::today()->modify('-15 days');
                break;
            case 'thirtyDay':
                return Carbon::today()->modify('-30 days');
                break;
            default:
                return null;
                break;
        }
    }
}



