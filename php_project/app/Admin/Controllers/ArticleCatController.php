<?php

namespace App\Admin\Controllers;

use App\Models\ArticleCat;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ArticleCatController extends Controller
{
    use HasResourceActions;

    protected $states = array(
        'on'  => ['value' => 1, 'text' => '显示', 'color' => 'success'],
        'off' => ['value' => 0, 'text' => '隐藏', 'color' => 'danger'],
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
            ->header('文章分类')
            ->description('分类列表')
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
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ArticleCat);

        $grid->name('分类名称');
        $grid->desc('分类简介');
        $grid->column('order','排序')->editable('number');
        $grid->column('is_hidden','是否隐藏')->switch($this->states);
        $grid->created_at('创建时间');
        $grid->updated_at('修改时间');

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
        $show = new Show(ArticleCat::findOrFail($id));

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
        $form = new Form(new ArticleCat);

        $form->text('name','分类名称');
        $form->textarea('desc','分类描述');
        $form->number('order','排序')->min(0)->max(100)->default(10);
        $form->switch('is_hidden','是否隐藏')->states($this->states);

        return $form;
    }
}
