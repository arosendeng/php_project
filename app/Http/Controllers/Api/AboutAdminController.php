<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/7/11
 * Time: 17:41
 */

namespace App\Http\Controllers\Api;


use App\Models\Merchant;
use Illuminate\Http\Request;

class AboutAdminController
{
    public function MerchantOption(Request $request)
    {
        $q = $request->get('q');
        return Merchant::where('name','like',"%$q%")->paginate(null,['id','name as text']);
    }

}