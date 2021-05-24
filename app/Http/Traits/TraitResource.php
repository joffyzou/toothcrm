<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

trait TraitResource
{
    protected $error = null;

    /**
     * @param object|array $list 获取的数据
     * @param int $page 当前页数
     * @param int $limit 没有数量
     * @return array
     * Description:获取分页数据
     */
    private static function getPageData($list, $page, $limit)
    {
        if (is_object($list)) {
            $listArr = $list->toArray();
        } elseif (is_array($list)) {
            $listArr = $list;
        } else {
            $listArr = [];
        }
        $count = count($list);
        $item = array_slice($listArr, ($page - 1) * $limit, $limit);
        $paginator = new LengthAwarePaginator($item, $count, $limit, $page);

        return [
            'data' => $paginator->items(),
            'count' => $count
        ];
    }

    /**
     * @param int $code 返回状态码
     * @param string $msg 返回信息
     * @param null $data 返回数据
     * @param array $additional 附加数据
     * @param array $header 头信息
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * Description:返回json数据
     */
    protected function resJson($code = 0, $msg = '', $data = null, array $additional = [], array $header = [])
    {
        $result = [
            'code' => $code,
            'msg' => $msg,
            'data' => $data,
        ];
        if (count($additional) > 0) {
            foreach ($additional as $key => $val) {
                $result[$key] = $val;
            }
        }

        return response($result)->withHeaders($header);
    }
}
