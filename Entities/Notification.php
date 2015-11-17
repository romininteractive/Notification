<?php namespace Modules\Notification\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string type
 * @property string message
 * @property string icon_class
 * @property string title
 * @property string link
 * @property bool is_read
 * @property \Carbon\Carbon created_at
 * @property \Carbon\Carbon updated_at
 */
class Notification extends Model
{
    protected $table = 'notification__notifications';
    protected $fillable = ['user_id', 'type', 'message', 'icon_class', 'link', 'is_read', 'title'];
    protected $appends = ['time_ago'];

    public function user()
    {
        $driver = config('asgard.user.users.driver');

        return $this->belongsTo("Modules\\User\\Entities\\{$driver}\\User");
    }

    public function getTimeAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}
