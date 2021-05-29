<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'platform_id',
        'project_id',
        'origin_id',
        'user_id',
        'is_appointment',
        'is_add_wechat',
        'is_to_store',
        'achievement',
        'appointment_time',
        'note',
        'state'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format($this->dateFormat ?: 'Y-m-d H:i:s');
    }

    // 多对一：多个患者属于一个用户
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 一对多：一个患者拥有多条回访
    public function repays()
    {
        return $this->hasMany(Repay::class, 'patient_id', 'id');
    }

    // 多对一：多个患者属于一个来源
    public function origin()
    {
        return $this->belongsTo(Origin::class)->withDefault(['name' => '-']);
    }

    // 多对一：多个患者属于一个平台
    public function platform()
    {
        return $this->belongsTo(Platform::class)->withDefault(['name' => '-']);
    }

    // 多对一：多个患者属于一个项目
    public function project()
    {
        return $this->belongsTo(Project::class)->withDefault(['name' => '-']);
    }

    public function scopePatients($query)
    {
        return $query->where('user_id', '>', 0)->recent();
    }

    public function scopeSeas($query)
    {
        return $query->where('user_id', 0)->recent();
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeWithOrder($query, $order)
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $threeDay = Carbon::today()->modify('-3 days');
        $sevenDay = Carbon::today()->modify('-7 days');
        $fifteenDay = Carbon::today()->modify('-15 days');
        $thirtyDay = Carbon::today()->modify('-30 days');

        switch ($order) {
            case 'today':
                $query->whereBetween('created_at', [$today, now()]);
                break;
            case 'yesterday':
                $query->whereBetween('created_at', [$yesterday, $today]);
                break;
            case 'threeDay':
                $query->whereBetween('created_at', [$threeDay, now()]);
                break;
            case 'sevenDay':
                $query->whereBetween('created_at', [$sevenDay, now()]);
                break;
            case 'fifteenDay':
                $query->whereBetween('created_at', [$fifteenDay, now()]);
                break;
            case 'thirtyDay':
                $query->whereBetween('created_at', [$thirtyDay, now()]);
                break;
            default:
                $query->recent();
                break;
        }
    }
}
