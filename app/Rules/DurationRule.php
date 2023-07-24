<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\Rule;

class DurationRule implements Rule
{
    private $class_id;
    private $case;
    private $old_duration;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($class_id, $case = 'create', $old_duration = null)
    {
        $this->class_id = $class_id;
        $this->case = $case;
        $this->old_duration = $old_duration;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $class = DB::table('class')
        ->select([
            'class.id',
            'master_class.duration as duration_class',
            DB::raw("SUM(presence.duration) as presence_sum")
        ])
        ->join('master_class', 'class.master_class_id', '=', 'master_class.id')
        ->join('presence', 'class.id', '=', 'presence.class_id')
        ->where('class.id', $this->class_id)
        ->where('start_time', '<=', Carbon::now())->first();

        $value = $value ?? 1;

        if($this->case == 'update' && $this->old_duration){
            $class->presence_sum = $class->presence_sum - $this->old_duration;
        }

        return $class->id && $class->presence_sum + $value <= $class->duration_class ? $value : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Kelas Belum Mulai atauTotal Durasi Pertemuan Melebihi Batas Jam Pembelajaran';
    }
}
