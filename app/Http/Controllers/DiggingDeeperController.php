<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Carbon\CarbonPeriod;

class DiggingDeeperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function collections()
    {
        $eloquentCollection = BlogPost::withoutTrashed()->get();
        dd(__METHOD__, $eloquentCollection, $eloquentCollection->toArray());
//        $collection = collect($eloquentCollection->toArray());
//        $newCollection[] = $collection->map(function ($item) {
//            $item['id'] = $item['category_id']."rrrr"; return $item;
//        })->values();
//        $newCollection[] = $collection->filter(function ($item) {$item["created_at"]->isFriday(); $result = $uslovie && $uslovie2 return $result;})->values();
//        dd($newCollection);
    }


}
