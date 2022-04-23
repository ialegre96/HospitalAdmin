<?php

namespace App\Repositories;

use App\Models\Doctor;
use App\Models\HospitalSchedule;
use App\Models\Schedule;
use App\Models\ScheduleDay;
use App\Models\User;
use Arr;
use Auth;

/**
 * Class ScheduleRepository
 * @version February 24, 2020, 5:55 am UTC
 */
class ScheduleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'available_on',
        'available_from',
        'available_to',
    ];

    /**
     * Return searchable fields
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Schedule::class;
    }

    /**
     * @return array
     */
    public function getData()
    {
        /** @var User $user */
        $user = Auth::user();
        $data = [];
        $query = null;
        /** @var Doctor $doctors */
        if (request()->route()->getName() != 'schedules.edit') {
            $query = Doctor::with('user')->withCount('schedules')->having('schedules_count', '==', 0);
        } else {
            $query = Doctor::with('user');
        }

        if ($user->hasRole('Doctor')) {
            $query->where('user_id', $user->id);
        }

        $doctors = $query->get()->where('user.status', '=', 1)->pluck('user.full_name', 'id')->sort();
        $data['doctors'] = $doctors;
        $data['hospitalSchedule'] = HospitalSchedule::get()->toArray();
        $data['availableOn'] = Schedule::days;

        return $data;
    }

    /**
     * @param  array  $input
     *
     * @return array
     */
    public function prepareInputForScheduleDayItem($input)
    {
        $items = [];
        foreach ($input as $key => $data) {
            foreach ($data as $index => $value) {
                $items[$index][$key] = $value;
            }
        }

        return $items;
    }

    /**
     * @param  array  $input
     *
     * @return bool
     */
    public function store($input)
    {
        $schedule = Schedule::create($input);

        $scheduleDayArray = Arr::only($input, ['available_on', 'available_from', 'available_to']);
        $scheduleDayItemInput = $this->prepareInputForScheduleDayItem($scheduleDayArray);
        foreach ($scheduleDayItemInput as $key => $data) {
            $data['doctor_id'] = $input['doctor_id'];
            $data['schedule_id'] = $schedule->id;
            $scheduleDay = ScheduleDay::create($data);
        }

        return true;
    }

    /**
     * @param  array  $input
     * @param  int  $id
     *
     * @return bool
     */
    public function update($input, $id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->update($input);

        $scheduleDayArray = Arr::only($input, ['available_on', 'available_from', 'available_to']);
        $scheduleDayItemInput = $this->prepareInputForScheduleDayItem($scheduleDayArray);
        foreach ($scheduleDayItemInput as $key => $data) {
            $scheduleDay = ScheduleDay::whereScheduleId($id)
                ->where('available_on', $data['available_on']);
            $data['doctor_id'] = $input['doctor_id'];
            $data['schedule_id'] = $schedule->id;
            $scheduleDay->update($data);
        }

        return true;
    }

    /**
     * @param  array  $input
     *
     * @return ScheduleDay
     */
    public function getDoctorSchedule($input)
    {
        /** @var ScheduleDay $scheduleDay */
        $data['scheduleDay'] = ScheduleDay::where('doctor_id', $input['doctor_id'])->Where('available_on',
            $input['day_name'])->get();

        $data['perPatientTime'] = Schedule::whereDoctorId($input['doctor_id'])->get();

        return $data;
    }
}
