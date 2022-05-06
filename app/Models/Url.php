<?php

namespace App\Models;

use Hashids\Hashids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function setUrlAttribute($value)
    {
        $this->attributes['url'] = $value;
        $this->attributes['uniq'] = $this->generateRandom();
    }

    private function generateRandom(): string
    {
        $ID = $this->getLastInsertedID();
        $hashids = new Hashids('BlueCoding', 5, 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890');
        do {
            $ID++;
            $key = $hashids->encode($ID);
        } while (Url::where('uniq', $key)->exists());

        return $key;
    }

    private function getLastInsertedID(): int
    {
        if ($lastInserted = Url::select('id')->first())
            return $lastInserted->id;

        return 0;
    }
}
