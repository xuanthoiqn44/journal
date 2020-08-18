<?php
namespace app\Helpers;

class CustomPagination {
    public function __construct($model, $conditions = array('offset' => 0, 'limit' => 10, 'with' => array(), 'where' => array()))
    {
        // list($offset, $limit, $with, $where) = $conditions;
        return $model
                ->with($conditions['with'])
                ->where($conditions['where'])
                ->offset($conditions['offset'])
                ->limit($conditions['limit'])
                ->all();
    }
} 