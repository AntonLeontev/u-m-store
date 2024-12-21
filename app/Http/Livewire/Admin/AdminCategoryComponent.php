<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product_to_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;


class AdminCategoryComponent extends Component
{
    use WithPagination;
    public $pagesize;
    public $search;

    public function mount() {
        $this->pagesize = 12;
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);

        if(!$category) return;

        // check category for products
        $products_in_category = Product_to_category::where('category_id', $id)->get();
        if($products_in_category && $products_in_category->count() > 0)  {
            session()->flash('message','Категория не удалена так как в ней еще есть товары в количестве '. $products_in_category->count() . ' шт.');
            return;
        }
        $category->delete();
        session()->flash('message','Категория успешно удалена.');
    }

    public function seeMore()
    {
        $this->pagesize += $this->pagesize;
    }

    public function updateStatus($id, $value)
    {

        $category = Category::find($id);
        if ($category) {
            $category->status = (int)$value;
            $category->save();
        }
    }


    public function render(Request $request)
    {
        $partner_id = Auth::user()->partner_id;
        if($request->input('search') !== null) {
            $this->search = $request->input('search');
        }

        if($this->search && strlen($this->search) > 2) {
            $categories = Category::where('partner_id', $partner_id )->where('name','LIKE', '%'.$this->search.'%')->paginate($this->pagesize);
        } else {
            $categories = Category::where('partner_id', $partner_id )->paginate($this->pagesize);
        }

        return view('livewire.admin.category.admin-category-component', ['categories'=> $categories])->layout('layouts.base');
    }
}
