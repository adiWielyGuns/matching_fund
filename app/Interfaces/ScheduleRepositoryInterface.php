<?php

namespace App\Interfaces;

interface ScheduleRepositoryInterface
{
    public function getAllSchedules();
    public function getIdSchedule();
    public function getScheduleById($scheduleId);
    public function deleteSchedule($scheduleId);
    public function createSchedule(array $scheduleDetails);
    public function updateSchedule($scheduleId, array $newDetails);
    public function getScheduleWithEloquent($relation);
}
