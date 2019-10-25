Gantt Chart Widget
========================
Gantt Chart Widget using ReactJs

Installation
-----

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist pkpudev/yii2-gantt-widget "*"
```

or add

```
"pkpudev/yii2-gantt-widget": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
use pkpudev\widget\gantt\Collection;
use pkpudev\widget\gantt\GanttChart;
use pkpudev\widget\gantt\Task;

$ganntCollection = new Collection();
// Task 1
$taskOne = new Task(['taskId'=>1, 'taskName'=>'My Task', 'startDate'=>'01/01/2019', 'endDate'=>'01/31/2019']);
$taskOne->addSubtask(new Task(['taskId'=>2, 'taskName'=>'My Sub Task', 'startDate'=>'01/01/2019', 'duration'=>7, 'progress'=>14]));
$ganntCollection->addTask($taskOne);

echo GanttChart::widget([
    'selector' => '#ganttId',
    'ganttData' => new Collection(),
]); ?>
```