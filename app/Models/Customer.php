<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Purchase;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name','kana','tel','email','postcode','address', 'birthday','gender', 'memo'];

    public function scopeSearchCustomers($query, $input = null)
    {
        // $inputが空でない場合に処理を行う
        if (!empty($input)) {
            // 'kana'または'tel'カラムに$inputで始まるレコードが存在するかを確認
            if (Customer::where('kana', 'like', $input . '%')
                ->orWhere('tel', 'like', $input . '%')->exists()) 
            {
                // 'kana'または'tel'カラムが$inputで始まるレコードをフィルタリング
                return $query->where('kana', 'like', $input . '%')
                            ->orWhere('tel', 'like', $input . '%');
            }
        }
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

}
