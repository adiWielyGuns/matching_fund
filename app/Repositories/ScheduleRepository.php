<?php

namespace App\Repositories;

use App\Interfaces\ScheduleRepositoryInterface;
use App\Models\Schedule;

class ScheduleRepository implements ScheduleRepositoryInterface
{
    public function getAllSchedules()
    {
        return Schedule::all();
    }

    public function getScheduleById($scheduleId)
    {
        return Schedule::findOrFail($scheduleId);
    }

    public function deleteSchedule($scheduleId)
    {
        Schedule::destroy($scheduleId);
    }

    public function createSchedule(array $scheduleDetails)
    {
        return Schedule::create($scheduleDetails);
    }

    public function updateSchedule($scheduleId, array $newDetails)
    {
        return Schedule::whereId($scheduleId)->update($newDetails);
    }

    public function getIdSchedule()
    {
        return Schedule::max('id') + 1;
    }

    public function getScheduleWithEloquent($relation)
    {
        return Schedule::with($relation)->get();
    }
}
