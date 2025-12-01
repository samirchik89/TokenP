<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageVisibility extends Model
{
    const PAGE_PLAID = 'plaid';
    protected $fillable = ['page_key', 'is_visible'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_visible' => 'boolean',
    ];

    public static function getPageKeys(){
        return collect([
            [
            'key' => self::PAGE_PLAID,
            'label' => 'Plaid',
            'icon' => 'fa-solid fa-bank',
            'value' => true,
            ],
        ]);
    }

    public static function getItems(){
        $items = self::all()->keyBy('page_key');
        $pageKeys = self::getPageKeys();
        $pageKeys = $pageKeys->map(function($page) use ($items){
            $dbPage = $items->get($page['key']);
            if($dbPage){
                $page['value'] = $dbPage->is_visible;
            }
            return $page;
        });
        return $pageKeys;
    }
}