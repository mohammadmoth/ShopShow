<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{  
   
    protected $fillable = ['name', 'ShortDesc', 'desc'
    , 'price'
    , 'discountFromPrice'
    , 'currency'
    , 'tax'
    , 'were'
    , 'votes_like'
    , 'votes_unlike'
    , 'status'   , 'OnTopNumber' , "image" ] ; 

}
