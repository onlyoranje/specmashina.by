<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'key',
        'value',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'integer',
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array<int, string>
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * Get the value of the setting.
     *
     * @param string|null $value
     * @return string|null
     */
    public function getValueAttribute($value)
    {
        if ($value === null) {
            return null;
        }

        return json_decode($value, true);
    }

    /**
     * Set the value of the setting.
     *
     * @param string|null $value
     * @return void
     */
    public function setValueAttribute($value)
    {
        $this->attributes['value'] = is_null($value) ? null : json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
