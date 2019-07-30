<?php

namespace App\Admin\Controllers;

use App\Models\Merchant;
use App\Http\Controllers\Controller;
use App\Models\MerchantCat;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class MerchantController extends Controller
{
    use HasResourceActions;

    protected $is_hidden = array(
        '显示'  => ['value' => 1, 'text' => '显示', 'color' => 'success'],
        '隐藏' => ['value' => 0, 'text' => '隐藏', 'color' => 'danger'],
    );

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('商户管理')
            ->description('商户列表')
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
            ->header('商户管理')
            ->description('新增商户')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Merchant);

        $grid->name('商户名称');
        $grid->cat_id('商户类别')->display(function ($cat_id)
        {
           if($cat_id == 0)
           {
               return '暂无分类';
           }
           $res =  MerchantCat::where('id',$cat_id)->first('cat_name');
           return $res->cat_name;
        });
        $grid->column('cover','封面')->image();
        $grid->column('order','排序')->editable('number');
        $grid->desc('商户简介');

        $grid->column('is_hidden','隐藏/显示')->switch($this->is_hidden);


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
        $show = new Show(Merchant::findOrFail($id));

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
        $form = new Form(new Merchant);

        $form->text('name','商户名称');
        $form->select('cat_id','商户类别')->options(MerchantCat::selectOptions());
        $form->number('order','排序')->min(0)->max(100);
        $form->mobile('phone','联系电话');
        $form->image('cover','封面图片')->thumbnail('small',$width=300,$height = 300);
        $form->textarea('address','商户地址');
        $form->textarea('desc','商户介绍');
        $form->switch('is_hidden','是否隐藏')->options($this->is_hidden);

        return $form;
    }
}
