<?php

namespace App\Models;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class MerchantCat extends Model
{
    use ModelTree,AdminBuilder;

    protected $table = 'merchant_cat';

    protected $fillable = [
        'cat_name',
        'parent_id',
        'desc',
        'order',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setParentColumn('parent_id');
        $this->setOrderColumn('order');
        $this->setTitleColumn('cat_name');
    }


}
