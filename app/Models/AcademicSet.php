<?php

namespace App\Models;

use App\Models\Advisor;
use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicSet extends Model
{
    use HasFactory;

    protected $table = 'sets';
    const TOKEN_LENGTH = 20;


    public function students()
    {
        return $this->hasMany(Student::class, 'set_id');
    }

    public function advisor()
    {
        return $this->belongsTo(Advisor::class);
    }

    public function totalStudents()
    {
        return $this->students->count();
    }

    public function courses() {
        return $this->hasMany(Course::class);
    }

    public static function getSetFromToken(string $token)
    {

        $set = self::where('token', $token);

        if ($set->exists()) {
            return $set->first()->set;
        }

        return null;
    }

    public static function retrieveToken(int $set_id)
    {
        $set = self::where('id', $set_id);

        if ($set->exists()) {
            return $set->first()->token;
        }
        return null;
    }

    public static function getToken(AcademicSet $set)
    {
        return $set->token;
    }



    public static function tokenURL(AcademicSet $set, int $tokenLength = self::TOKEN_LENGTH)
    {
        if ($token = self::getToken($set, $tokenLength)) {
            return url("/register?invite={$token}");
        }
        return null;
    }




    public static function regenerateToken(AcademicSet $set, int $tokenLength = self::TOKEN_LENGTH)
    {

        do {
            $token = Str::random($tokenLength);
        } while (self::getSetFromToken($token));

        $set->update(compact('token'));

        return $token;
    }

    public static function revokeToken(AcademicSet $set)
    {
        $set->update([
            'token' => null
        ]);
    }

    public static function getSetFromURL()
    {
        if (request()->has('invite')) {
            $token = request('invite');
            $set = self::where('token', $token);
            if ($set->exists()) {
                return $set->first();
            }
        }
        return null;
    }
}
