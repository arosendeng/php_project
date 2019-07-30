<?php

namespace App\Admin\Controllers;

use App\Models\Commodity;
use App\Http\Controllers\Controller;
use App\Models\Merchant;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class CommodityController extends Controller
{
    use HasResourceActions;

    protected $states = [
        'on'  => ['value' => 1, 'text' => '上架', 'color' => 'success'],
        'off' => ['value' => 0, 'text' => '下架', 'color' => 'danger'],
    ];

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('商品管理')
            ->description('商品列表')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('商品管理')
            ->description('新增商品')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Commodity);

        $grid->name('商品名称');
        $grid->m_id('所属商铺')->display(function($m_id){
            $res = Merchant::where('id',$m_id)->first('name');
            return $res->name;
        });
        $grid->desc('商品描述');
        $grid->is_up('是否上架')->switch($this->states);

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Commodity::findOrFail($id));

        $show->id('ID');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Commodity);

        $form->text('name','商品名称');
        $form->select('m_id','所属商户')->options(function($m_id){

            $mer = Merchant::find($m_id);
            if($mer){
                return [$mer->id=>$mer->name];
            }
        })->ajax('/api/merchantOption');
        $form->textarea('desc','商品简介');
        $form->number('order','排序')->min(0)->max(100);
        $form->currency('price','商品价格')->symbol('VND');
        $form->number('integral','换购积分');
        $form->image('image','商品图片');
        $form->switch('is_up','是否上架')->states($this->states);
        return $form;
    }
}
