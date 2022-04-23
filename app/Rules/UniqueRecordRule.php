<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueRecordRule implements Rule
{
    /**
     * The table to run the query against.
     *
     * @var string
     */
    protected $table;

    /**
     * The column to check on.
     *
     * @var string
     */
    protected $column;

    protected $updateFieldValue;

    public function __construct($table, $column, $updateFieldValue = null)
    {
        $this->table = $table;
        $this->column = $column;
        $this->updateFieldValue = $updateFieldValue;
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
        $query = DB::table($this->table)
            ->where($this->column, $value)
            ->where('tenant_id', tenancy()->tenant->id);

        if (! empty($this->updateFieldValue)) {
            $query->where('id', '!=', $this->updateFieldValue);
        }
        
        $exists = $query->exists();

        return ($exists) ? false : true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return [
        ];
    }
}
