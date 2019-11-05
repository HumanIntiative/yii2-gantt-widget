<?php //src/transformer/RequestTransformer.php
namespace pkpudev\gantt\transformer;

use app\models\ProjectWbs;

class RequestTransformer
{
    protected $projectId;
    protected $taskId;
    protected $data;

    public function __construct(int $projectId, array $data)
    {
        $this->projectId = $projectId;
        $this->data = $data;
    }

    public function getNewModel(): ProjectWbs
    {
        $model = $this->mapping(new ProjectWbs);
        $model->duration_unit = 'day';
        return $model;
    }

    public function getExistingModel(int $id): ProjectWbs
    {
        return $this->mapping(ProjectWbs::findOne($id));
    }

    protected function mapping(ProjectWbs $model): ProjectWbs
    {
        $model->parent_id   = (int)$this->data['parent'];
        $model->project_id  = $this->projectId;
        $model->task_name   = $this->data['text'];
        $model->duration    = (int)$this->data['duration'];
        $model->start       = date('Y-m-d', strtotime($this->data['start_date']));
        $model->finish      = date('Y-m-d', strtotime($this->data['end_date']));

        return $model;
    }
}