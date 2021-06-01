<?php

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
