<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;

    /**
     * モデルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'carts';

    protected $fillable = [
        'stock_id',
        'user_id'
    ];

    public function showCart()
    {
        $userId = Auth::id();
        $data['myCarts'] = $this->where('user_id', $userId)->get();

        $data['count'] = 0;
        $data['sum'] = 0;

        foreach($data['myCarts'] as $myCart){
            $data['count']++;
            $data['sum']+= $myCart->stock->fee;
        }
        return $data;
    }

    public function stock()
    {
        return $this->belongsTo('\App\Models\Stock');
    }

    public function addCart($stockId)
    {
        $userId = Auth::id();
        $cartInfo = Cart::firstOrCreate(['stock_id' => $stockId, 'user_id' => $userId]);

        if($cartInfo->wasRecentlyCreated){
            $message = 'カートに追加しました';
        }
        else{
            $message = 'カートに登録済みです';
        }
        return $message;
    }

    public function deleteCart($stockId)
    {
        $userId = Auth::id();
        $delete = $this->where('user_id', $userId)->where('stock_id',$stockId)->delete();

        if($delete > 0){
            $message = 'カートから一つの商品を削除しました';
        }else{
            $message = '削除に失敗しました';
        }
        return $message;
    }

    public function checkoutCart()
    {
        $userId = Auth::id();
        $checkoutItems = $this->where('user_id', $userId)->get();
        $this->where('user_id', $userId)->delete();

        return $checkoutItems;
    }
}
