<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use LogsActivity;
    use SoftDeletes;
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'reservations';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['start_date', 'end_date', 'status', 'user_id', 'deposit_slip'];

    

    /**
     * Change activity log event description
     *
     * @param string $eventName
     *
     * @return string
     */
    public function getDescriptionForEvent($eventName)
    {
        return __CLASS__ . " model has been {$eventName}";
    }

    /**
     * Get rooms associated with the reservation
     *
     * @return mixed
     */
    public function roomTypes()
    {
        return $this->belongsToMany('App\RoomType', 'reservation_rooms', 'reservation_id', 'room_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
