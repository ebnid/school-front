<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Traits\WithSweetAlert;
use App\Models\Notice;

class CreateEditNotice extends Component
{
    use WithSweetAlert;
    use WithFileUploads;

    public $is_edit_mode_on = false;

    public $name;
    public $slug;
    public $content;
    public $order;
    public $is_published;
    public $lang = 'bangla';

    public $notice_id;

    // pdf contents
    public $contents = [];
    public $old_contents = [];


    protected $rules = [
        'name' => ['required', 'string'],
        'slug' => ['required', 'string'],
        'content' => ['nullable', 'string'],
        'order' => ['nullable', 'integer'],
        // 'contents' => ['nullable', 'file', 'mimes:pdf'],
        'is_published' => ['required', 'boolean'],
    ];

    protected $listeners = [
        'onNoticeEdit' => 'enableNoticeEditMode',
    ];

    public function render()
    {
        return view('admin.components.create-edit-notice');
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

    public function createNotice()
    {
        $this->validate();

        $notice = new Notice();

        $notice->name = $this->name;
        $notice->slug = $this->slug;
        $notice->content = $this->content;
        $notice->lang = $this->lang;
        $notice->order = $this->order;
        $notice->is_published = $this->is_published;


        if(!$notice->save()) return $this->error('Failed', 'Failed to create new Notice. Something went wrong.');

        if(count($this->contents) > 0){

            foreach($this->contents as $file)
            {
                $notice->addMedia($file)->toMediaCollection('contents');
            }

        }

        $this->reset();
        $this->emit('onNoticeCreated');
        $this->dispatchBrowserEvent('tinymce:clear');
        $this->success('Created', '');
    }


    public function updateNotice()
    {
        $this->validate([
            'name' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'is_published' => ['required', 'boolean'],
        ]);


        $notice = Notice::find($this->notice_id);

        $notice->name = $this->name;
        $notice->slug = $this->slug;
        $notice->content = $this->content;
        $notice->is_published = $this->is_published;
        $notice->order = $this->order;
        $notice->is_published = $this->is_published;

        if(!$notice->save()) return $this->error('Failed', 'Failed to updated Notice. Something went wrong.');

        
        if(count($this->contents) > 0){

            foreach($this->contents as $file)
            {
                $notice->addMedia($file)->toMediaCollection('contents');
            }

        }

        $this->reset();
        $this->emit('onNoticeUpdated');
        $this->dispatchBrowserEvent('tinymce:clear');
        $this->success('Updated', '');

    }

    public function enableNoticeEditMode($id)
    {
        $notice = Notice::find($id);

        $this->notice_id = $notice->id;
        $this->name = $notice->name;
        $this->slug = $notice->slug;
        $this->content = $notice->content;
        $this->order = $notice->order;
        $this->lang = $notice->lang;
        $this->is_published = $notice->is_published;

        $this->old_contents = $notice->getMedia('contents');

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
