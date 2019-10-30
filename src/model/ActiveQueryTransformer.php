<?php //src/model/ActiveQueryTransformer.php
namespace pkpudev\gantt\model;

use pkpudev\gantt\Collection;
use yii\db\ActiveQueryInterface;

class ActiveQueryTransformer
{
    protected $activeQuery;

    public function __construct(ActiveQueryInterface $activeQuery)
    {
        $this->activeQuery = $activeQuery;
    }

    public function transform(): Collection
    {
        $data = $this->activeQuery->all();

        $newCollection = new Collection;
        foreach ($data as $row) {
            $transformer = new WbsTransformer($row);
            if ($wbs = $transformer->transform()) {
                $newCollection->addTask($wbs);
            }
        }
        return $newCollection;
    }
}