<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class Page extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        if(preg_match('/\[([^\[]+)\]/', $this->config['pageContent'], $match)) {
            $this->config['pageContent'] = preg_replace_callback('/\[([^\[]+)\]/', function ($matches)
            {
                $widgetContent = NULL;
                
                foreach($matches as $match) {
                    $dataRef = substr($match, 1, -1);
                    $dataRef = strip_tags($dataRef);
                    $dataRef = preg_replace("/&#?[a-z0-9]{2,8};/i","",$dataRef);
                    $dataRef = preg_replace('/\s+/', '', $dataRef);

                    $widgetData = NULL;
                    $arr = explode(',', $dataRef);
                    foreach($arr as $val) {
                        $item = explode('=', $val);
                        $widgetData[$item[0]] = $item[1];
                    }

                    $model = '\App\Models\\' . $widgetData['source'];

                    $whereContent = NULL;
                    if(array_key_exists('where', $widgetData)) {
                        $cond = explode(':', $widgetData['where']);
                        //$whereContent = $model::where($cond[0], $cond[1])->paginate(10);
                        $whereContent = $model::where($cond[0], $cond[1])->get();
                    } else {
                        //$whereContent = $model::paginate(10);
                        $whereContent = $model::all();
                    }

                    if(array_key_exists('position', $widgetData)) {
                        $position = $widgetData["position"];
                        $widgetContent[$position] = $whereContent->toArray();
                    } else {
                        $widgetContent['main'] = $whereContent->toArray();
                    }

                    $widgetView = 'page';
                    if(array_key_exists('widget', $widgetData)) {
                        $widgetView = $widgetData["widget"];
                    }

                    return view('widgets.' . $widgetView, [
                        'widgetContent' => $widgetContent,
                    ]);
                }
            }, $this->config['pageContent']);
        }

        return $this->config['pageContent'];
    }
}
