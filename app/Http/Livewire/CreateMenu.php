<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Traits\WithSweetAlert;
use App\Models\Menu;

class CreateMenu extends Component
{


    use WithSweetAlert;
    use WithFileUploads;

    public $is_add_new_menu_item_show = false;

    public $parent_menu_id;

    public $name;
    public $link;
    public $order;
    public $icon;
    public $old_icon;
    public $is_published;
    public $category_id;


    protected $rules = [
        'name' => ['required', 'string'],
        'link' => ['nullable', 'string'],
        'order' => ['nullable', 'integer'],
        'parent_menu_id' => ['nullable', 'integer'],
        'is_published' => ['required', 'boolean'],
        'category_id' => ['nullable', 'integer'],
    ];

    protected $listeners = [
        'onShowCreateMenuModal' => 'enableAddNewMenuModal'
    ];


    public function render()
    {
        return view('admin.components.create-menu');
    }

    public function createMenu()
    {
        $this->validate();

        try {

            $menu = new Menu();

            $menu->name = $this->name;
            $menu->order = $this->order;
            $menu->is_published = $this->is_published;
            $menu->link = $this->link;

    
            if($this->parent_menu_id){
                $menu->parent_id = $this->parent_menu_id;
            }
    
            if($menu && $this->icon)
            {
                $menu->addMedia($this->icon)->toMediaCollection('icon');
            }
    
            $menu->save();
            
            $this->reset();
            $this->emit('onMenuCreated');
            $this->success('Added', '');
            
        }catch(\Exception $e){
            return $this->error('Failer', $e->getMessage());
        }


    }



    public function cancelAddNewMenuItemModal()
    {
        $this->reset();
        $this->is_add_new_menu_item_show = false;
    }

    public function enableAddNewMenuModal($parent_id)
    {
        $this->parent_menu_id = $parent_id; 
        $this->is_add_new_menu_item_show = true;
    }


    public function removeIcon()
    {
        $this->icon->delete();
        $this->icon = null;
    }


}
