<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class AdminEditCategoryComponent extends Component
{

    public $category_id;
    public $name;
///    public $slug;
    public $parent_id;
    public $image;
    public $category;
    public $seo_text;
    public $status;
    public $in_menu = 0;

    public function mount($category_id)
    {

        if(!$category_id) $this->redirect(route('admin.categories'));

        $this->category_id = $category_id;
        $this->category = Category::find($this->category_id);
        if(!$this->category) $this->redirect(route('admin.categories'));

        $this->name = $this->category->name;
        $this->parent_id = $this->category->parent_id;
        $this->in_menu = $this->category->menu;
        $this->image = $this->category->image;
        $this->seo_text = $this->category->seo_text;
        $this->parent_id = $this->category->parent_id;
        $this->status = $this->category->status;

    }

    public function updateStatus($status)
    {
        $this->status = $status;
    }

    //only for clone
    public function updateMenuStatus($status)
    {
        $this->in_menu = $status;
    }

    public function updateParentCategory($id)
    {
        $this->parent_id = $id;
    }

    public function storeCategory()
    {

        $this->category->name = $this->name;
        $this->category->seo_text = $this->seo_text;
//        $category->slug = $this->slug;
        $this->category->menu = $this->in_menu;
        $this->category->parent_id = $this->parent_id ?: 0;
        $this->category->status = (int)$this->status;
//        $category->image = $this->image;
        $this->category->save();
        session()->flash('message','Категория успешно отредактирована!');
    }

    public function render()
    {
        $categories = Category::where('partner_id', Auth::user()->partner_id)->get();
        return view('livewire.admin.category.admin-edit-category-component', compact('categories'))->layout('layouts.base');
    }
}
