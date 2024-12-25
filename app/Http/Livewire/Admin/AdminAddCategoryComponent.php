<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Partners;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;


class AdminAddCategoryComponent extends Component
{
    public $category_id;
    public $name;
    public $slug;
    public $parent_id = 0;
    public $image;
    public $category;
    public $seo_text;
    public $status;
    public $in_menu = 0;


    public function mount(){
        $this->category = new Category();
        $this->category_id = $this->category->id;
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
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
        $partner = Partners::find(Auth::user()->partner_id);
        if(!$partner) return;
        $this->category->name = $this->name;
        $this->category->slug = $this->slug;
        $this->category->direction_id = $partner->direction_id;
        $this->category->menu = $this->in_menu;
        $this->category->seo_text = $this->seo_text;
        $this->category->parent_id = $this->parent_id ?: 0;
//        $this->category->image = $this->image;/
        $this->category->partner_id = $partner->id;
        $this->category->save();
        session()->flash('message','Категория успешно добавлена!');
        $this->redirect(route('admin.categories'));
    }

    public function render()
    {
        $categories = Category::where('partner_id', Auth::user()->partner_id)->get();

        return view('livewire.admin.category.admin-add-category-component', compact('categories'))->layout('layouts.base');
    }
}
