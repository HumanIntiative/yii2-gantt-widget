<?php //src/GanttChart.php
namespace pkpudev\gantt;

use pkpudev\gantt\converter\MemberConverter;
use yii\base\Widget;
use yii\web\View;

/**
 * Gantt widget
 * 
 * Here is long desc
 *
 * @author Zein Miftah <zeinmiftah@gmail.com>
 * @since 1.0
 */
class GanttChart extends Widget
{
    /**
     * @var string $selector
     */
    public $selector = '#ganttId';
    /**
     * @var string $scaleSelector
     */
    public $scaleSelector = '#scale';
    /**
     * @var bool $useScale
     */
    public $useScale = false;
    /**
     * @var bool $useMarker
     */
    public $useMarker = false;
    /**
     * @var bool $useHighlight
     */
    public $useHighlight = false;
    /**
     * @var string $apiUrl
     */
    public $apiUrl = '/api';
    /**
     * @var model\Member[] $members
     */
    public $members = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        // Register bundle
        GanttAsset::register($this->view);
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $irand = rand(0, 1000);

        $script = $this->createWidget();
        if ($this->useMarker) {
            $script .= $this->createMarkerOptions();
        }
        if ($this->useScale) {
            $script .= $this->createScaleOptions();
        }
        if ($this->useHighlight) {
            $script .= $this->createHighlightOptions();
        }

        $this->view->registerJs($script, View::POS_END, "gantt-js{$irand}");
    }

    public function createWidget()
    {
        $members = (new MemberConverter($this->members))->toString();
        $template = "
            var percent = [], key = 0;
            for (var i=0; i<=10; i++) {
                key = i / 10;
                percent.push({key: key, label: (i * 10)+\" %%\"});
            }

            function byId(list, id) {
                for (var i = 0; i < list.length; i++) {
                    if (list[i].key == id)
                        return list[i].label || \"\";
                }
                return \"\";
            }

            gantt.config.grid_width = 400;
            gantt.config.grid_resize = true;
            gantt.config.open_tree_initially = true;
            gantt.config.xml_date = \"%%Y-%%m-%%d %%H:%%i:%%s\";

            gantt.config.sort = true;

            gantt.serverList(\"members\", [%s]);

            var labels = gantt.locale.labels;
            labels.column_owner = labels.section_owner = \"PIC\";
            labels.column_progress = labels.section_progress = \"Progress\";

            gantt.templates.progress_text = function (start, end, task) {
                return \"<span style='text-align:left;'>\" + Math.round(task.progress * 100) + \"%% </span>\";
            };

            gantt.config.columns = [
                {name: \"text\", label: \"Task name\", tree: true, width: '*'},
                {name: \"owner\", width: 80, align: \"center\", template: function (item) {
                    return byId(gantt.serverList('members'), item.pic_id)}},
                {name: \"add\", width: 40}
            ];

            gantt.config.lightbox.sections = [
                {name: \"description\", height: 50, map_to: \"text\", type: \"textarea\", focus: true},
                {name: \"owner\", height: 36, map_to: \"pic_id\", type: \"select\", options: gantt.serverList(\"members\")},
                {name: \"progress\", height: 36, map_to: \"progress\", type: \"radio\", options: percent},
                {name: \"time\", type: \"duration\", map_to: \"auto\"}
            ];

            gantt.init(\"%s\");
            gantt.load(\"%s\");

            var dp = gantt.createDataProcessor({
                url: \"%s\",
                mode: \"REST\"
            });";

        return sprintf($template, $members, $this->selector, $this->apiUrl, $this->apiUrl);
    }

    public function createScaleOptions()
    {
        $template = "
            var htmlContent = '<form class=\"gantt_control\">' + 
                '<input type=\"radio\" id=\"scale1\" class=\"gantt_radio\" name=\"scale\" value=\"day\" checked>' +
                '<label for=\"scale1\">Skala Hari</label>' +
                '<input type=\"radio\" id=\"scale2\" class=\"gantt_radio\" name=\"scale\" value=\"week\">' +
                '<label for=\"scale2\">Skala Pekan</label>' +
                '<input type=\"radio\" id=\"scale3\" class=\"gantt_radio\" name=\"scale\" value=\"month\">' +
                '<label for=\"scale3\">Skala Bulan</label>' +
                '<input type=\"radio\" id=\"scale4\" class=\"gantt_radio\" name=\"scale\" value=\"year\">' +
                '<label for=\"scale4\">Skala Tahun</label>' +
            '</form>';
            jQuery('%s').html(htmlContent);";

        $template .= "
            var zoomConfig = {
                levels: [
                    {
                        name: \"day\",
                        scale_height: 27,
                        min_column_width: 80,
                        scales: [
                            {unit: \"day\", step: 1, format: \"%%d %%M\"}
                        ]
                    },
                    {
                        name: \"week\",
                        scale_height: 50,
                        min_column_width: 50,
                        scales: [
                            {unit: \"week\", step: 1, format: function (date) {
                                var dateToStr = gantt.date.date_to_str(\"%%d %%M\");
                                var endDate = gantt.date.add(date, -6, \"day\");
                                var weekNum = gantt.date.date_to_str(\"%%W\")(date);
                                return \"#\" + weekNum + \", \" + dateToStr(date) + \" - \" + dateToStr(endDate);
                            }},
                            {unit: \"day\", step: 1, format: \"%%j %%D\"}
                        ]
                    },
                    {
                        name: \"month\",
                        scale_height: 50,
                        min_column_width: 120,
                        scales:[
                            {unit: \"month\", format: \"%%F, %%Y\"},
                            {unit: \"week\", format: \"Week #%%W\"}
                        ]
                    },
                    {
                        name:\"year\",
                        scale_height: 50,
                        min_column_width: 30,
                        scales:[
                            {unit: \"year\", step: 1, format: \"%%Y\"}
                        ]
                    }
                ]
            }
            
            gantt.ext.zoom.init(zoomConfig);
            gantt.ext.zoom.setLevel(\"day\");
            
            var radios = jQuery(document).on('click', 'input[name=\"scale\"]', function(e) {
                console.log(e.target.value);
                gantt.ext.zoom.setLevel(e.target.value);
            });";

        return sprintf($template, $this->scaleSelector);
    }

    public function createMarkerOptions()
    {
        return "
            var date_to_str = gantt.date.date_to_str(gantt.config.task_date);
            var today = new Date;
            gantt.addMarker({
                start_date: today,
                css: \"today\",
                text: \"Today\",
                title: \"Today: \" + date_to_str(today)
            });";
    }

    public function createHighlightOptions()
    {
        return "
            gantt.templates.scale_cell_class = function (date) {
                if (date.getDay() == 0 || date.getDay() == 6) {
                    return \"weekend\";
                }
            };
            gantt.templates.timeline_cell_class = function (item, date) {
                if (date.getDay() == 0 || date.getDay() == 6) {
                    return \"weekend\"
                }
            };";
    }
}