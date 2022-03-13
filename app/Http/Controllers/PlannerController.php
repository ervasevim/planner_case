<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use App\Models\Task;
use Exception;


class PlannerController extends Controller
{

    private $tasks;
    private $developers;

    /**
     * PlannerController constructor.
     */
    public function __construct()
    {
        $this->tasks        = Task::orderBy('id')->get();
        $this->developers   = Developer::all();
        return $this->taskList();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function taskList()
    {
        $tasks = $this->tasks;
        return view('main', compact( 'tasks'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws Exception
     */
    public function makePlan()
    {
        $week = 1;

        $this->tasks->each(function ($task){
            $task->developer()->dissociate();
            $task->week = null;
            $task->save();
        });

        try {
            while (count($this->tasks) > 0 ){
                foreach ($this->tasks as $ind => $task){
                    foreach ($this->developers as $dev){
                        if (($dev->getTime($week) + ($task->size / $dev['level'])) < Developer::WEEKLY_WORK_HOUR ){
                            $task->developer()->associate($dev, ['week' => $week]);
                            $task->week = $week;
                            $task->save();
                            unset($this->tasks[$ind]);
                            break;
                        }
                    }
                }
                $week++;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }


        $tasks = Task::orderBy('week')
            ->orderBy('developer_id', 'ASC')
            ->get()
            ->toArray();

        $weeks = [];
        foreach ($tasks as $task){
            $weeks[$task->week][$task->developer->id]['tasks'][] = $task;
            $weeks[$task->week][$task->developer->id]['name'] = $task->developer->name;
            $weeks[$task->week][$task->developer->id]['time'] = $task->developer->getTime($task->week);
        }

        return view('tasks', compact( 'weeks'));
    }
}
