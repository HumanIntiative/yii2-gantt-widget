<?php //src/transformer/RequestTransformer.php
namespace pkpudev\gantt\transformer;

use app\models\ProjectWbs;

class RequestTransformer
{
    protected $projectId;
    protected $data;

    public function __construct(int $projectId, array $data)
    {
        $this->projectId = $projectId;
        $this->data = $data;
    }

    public function transform(): ProjectWbs
    {
        $newWbs = new ProjectWbs;
        $newWbs->parent_id = (int)$this->data['parent'];
        $newWbs->project_id = $this->projectId;
        $newWbs->task_name = $this->data['text'];
        $newWbs->duration = (int)$this->data['duration'];
        $newWbs->duration_unit = 'day';
        $newWbs->start = date('Y-m-d', strtotime($this->data['start_date']));
        $newWbs->finish = date('Y-m-d', strtotime($this->data['end_date']));
        return $newWbs;
    }
}