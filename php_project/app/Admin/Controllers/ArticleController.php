<?php

namespace App\Admin\Controllers;

use App\Models\Article;
use App\Http\Controllers\Controller;
use App\Models\ArticleCat;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ArticleController extends Controller
{
    use HasResourceActions;

    protected $states = array(
        'on'  => ['value' => 1, 'text' => '上架', 'color' => 'success'],
        'off' => ['value' => 0, 'text' => '下架', 'color' => 'danger'],
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
            ->header('文章管理')
            ->description('文章列表')
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
        $grid = new Grid(new Article);

        $grid->title('文章标题');
        $grid->column('c_id','所属分类')->display(function($cat_id){
           return ArticleCat::where('id',$cat_id)->first()->name;
        });
        $grid->desc('文章简介');
        $grid->column('is_hidden','是否上架')->switch($this->states);
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
        $show = new Show(Article::findOrFail($id));

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
        $form = new Form(new Article);

        $form->text('title','文章标题');
        $form->select('c_id','所属分类')->options(function(){
            $cat = ArticleCat::get();
            $option = array();
            foreach($cat as $v){
                $option[$v->id] = $v->name;
            }
            return $option;
        });
        $form->textarea('desc','文章描述');
        $form->image('image','图片');
        $form->UEditor('content','内容');
        $form->switch('is_hidden','是否隐藏')->states($this->states);

        return $form;
    }
}
