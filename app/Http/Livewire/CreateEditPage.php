<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Traits\WithSweetAlert;
use App\Models\Page;
use Livewire\WithFileUploads;

class CreateEditPage extends Component
{
    use WithSweetAlert;
    use WithFileUploads;

    public $is_edit_mode_on = false;

    public $name;
    public $slug;
    public $content;
    public $meta_title;
    public $meta_tags;
    public $meta_description;
    public $is_published;
    public $lang = 'bangla';
    public $excerpt;

    public $page_id;

    // pdf contents
    public $contents = [];
    public $old_contents = [];


    protected $rules = [
        'name' => ['required', 'string', 'unique:pages'],
        'slug' => ['required', 'string', 'unique:pages'],
        'content' => ['nullable', 'string'],
        'is_published' => ['required', 'boolean'],
    ];

    protected $listeners = [
        'onPageEdit' => 'enablePageEditMode',
    ];

    public function render()
    {
        return view('admin.components.create-edit-page');
    }

    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }

    public function removeExistingContentOf($id)
    {
        $this->old_contents = $this->old_contents->reject(function($file) use($id){
            if($file->id === $id){
                $file->delete();
                return true;
            }

            return false;
        });
    }


    public function removeContentOf($id)
    {
        $this->contents = array_filter($this->contents, function($content, $index) use($id){
            if($index === $id){
                $content->delete();
                return false;
            }

            return true;
        }, ARRAY_FILTER_USE_BOTH);
    }


    public function removeAllContents()
    {
        foreach($this->contents as $content){
            $content->delete();
        }

        $this->contents = [];
    }


    public function createPage()
    {
        $this->validate();

        $page = new Page();

        $page->name = $this->name;
        $page->slug = $this->slug;
        $page->content = $this->content;
        $page->lang = $this->lang;
        $page->excerpt = $this->excerpt;
        $page->meta_title = $this->meta_title;
        $page->meta_tags = $this->meta_tags;
        $page->meta_description = $this->meta_description;

        if(!$page->save()) return $this->error('Failed', 'Failed to create new page. Something went wrong.');


        if(count($this->contents) > 0){

            foreach($this->contents as $file)
            {
                $page->addMedia($file)->toMediaCollection('contents');
            }

        }


        $this->reset();
        $this->emit('onPageCreated');
        $this->dispatchBrowserEvent('tinymce:clear');
        $this->success('Created', '');
    }


    public function updatePage()
    {
        $this->validate([
            'name' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'is_published' => ['required', 'boolean'],
        ]);


        $page = Page::find($this->page_id);

        $page->name = $this->name;
        $page->slug = $this->slug;
        $page->content = $this->content;
        $page->lang = $this->lang;
        $page->excerpt = $this->excerpt;
        $page->meta_title = $this->meta_title;
        $page->meta_tags = $this->meta_tags;
        $page->meta_description = $this->meta_description;
        $page->is_published = $this->is_published;

        if(!$page->save()) return $this->error('Failed', 'Failed to updated page. Something went wrong.');


        if(count($this->contents) > 0){

            foreach($this->contents as $file)
            {
                $page->addMedia($file)->toMediaCollection('contents');
            }

        }

        $this->reset();
        $this->emit('onPageUpdated');
        $this->dispatchBrowserEvent('tinymce:clear');
        $this->success('Updated', '');

    }

    public function enablePageEditMode($id)
    {
        $page = Page::find($id);

        $this->page_id = $page->id;
        $this->name = $page->name;
        $this->slug = $page->slug;
        $this->content = $page->content;
        $this->lang = $page->lang;
        $this->excerpt = $page->excerpt;
        $this->meta_title = $page->meta_title;
        $this->meta_tags = $page->meta_tags;
        $this->meta_description = $page->meta_description;
        $this->is_published = $page->is_published;

        $this->old_contents = $page->getMedia('contents');

        $this->dispatchBrowserEvent('tinymce:set:content', $this->content);

        $this->is_edit_mode_on = true;
    }

    public function cancelEditMode()
    {
        $this->reset();
        $this->dispatchBrowserEvent('tinymce:clear');
        $this->is_edit_mode_on = false;
    }
}
