<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Setting as _Setting;
use App\Traits\WithSweetAlert;

class Setting extends Component
{
    use WithSweetAlert;
    use WithFileUploads;

    public $name_en;
    public $name_bn;
    public $address_en;
    public $address_bn;
    public $admission_button_text;
    public $admission_button_link;
    public $principal_message_excerpt_1;
    public $principal_message_excerpt_2;
    public $email;
    public $mobile;
    public $name_lang;
    public $principal_name;
    public $principal_message_page_link;
    public $banner;
    public $logo;
    public $principal_photo;

    public $old_banner;
    public $old_logo;
    public $old_principal_photo;


    public function mount()
    {
        $this->initSettingOldValues();
    }

    public function render()
    {
        return view('admin.components.setting');
    }


    public function saveChanges()
    {
        try {
            $this->updateNewValues();

            return $this->success('Saved', '');

        }catch(\Exception $e){
            return $this->error('Failer', $e->getMessage());
        }

    }


    public function removeTempBanner()
    {
        $this->banner->delete();
        $this->banner = null;
    }

    public function removeTempLogo()
    {
        $this->logo->delete();
        $this->logo = null;
    }

    public function removeTempPrincipalPhoto()
    {
        $this->principal_photo->delete();
        $this->principal_photo = null;
    }

    private function initSettingOldValues()
    {
        $this->name_en = _Setting::where('name', 'name_en')->first()->value;
        $this->name_bn = _Setting::where('name', 'name_bn')->first()->value;
        $this->address_en = _Setting::where('name', 'address_en')->first()->value;
        $this->address_bn = _Setting::where('name', 'address_bn')->first()->value;
        $this->admission_button_text = _Setting::where('name', 'admission_button_text')->first()->value;
        $this->admission_button_link = _Setting::where('name', 'admission_button_link')->first()->value;
        $this->principal_message_excerpt_1 = _Setting::where('name', 'principal_message_excerpt_1')->first()->value;
        $this->principal_message_excerpt_2 = _Setting::where('name', 'principal_message_excerpt_2')->first()->value;
        $this->email = _Setting::where('name', 'email')->first()->value;
        $this->mobile = _Setting::where('name', 'mobile')->first()->value;
        $this->name_lang = _Setting::where('name', 'name_lang')->first()->value;
        $this->principal_name = _Setting::where('name', 'principal_name')->first()->value;
        $this->principal_message_page_link = _Setting::where('name', 'principal_message_page_link')->first()->value;

        
        // Model Instance
        $this->old_banner = _Setting::where('name', 'banner')->first()->bannerUrl();
        $this->old_logo = _Setting::where('name', 'logo')->first()->logoUrl();
        $this->old_principal_photo = _Setting::where('name', 'principal')->first()->principalPhotoUrl();
    }


    private  function updateNewValues()
    {
        _Setting::where('name', 'name_en')->update(['value' => $this->name_en]);
        _Setting::where('name', 'name_bn')->update(['value' => $this->name_bn]);
        _Setting::where('name', 'address_en')->update(['value' => $this->address_en]);
        _Setting::where('name', 'address_bn')->update(['value' => $this->address_bn]);
        _Setting::where('name', 'admission_button_text')->update(['value' => $this->admission_button_text]);
        _Setting::where('name', 'admission_button_link')->update(['value' => $this->admission_button_link]);
        _Setting::where('name', 'principal_message_excerpt_1')->update(['value' => $this->principal_message_excerpt_1]);
        _Setting::where('name', 'principal_message_excerpt_2')->update(['value' => $this->principal_message_excerpt_2]);
        _Setting::where('name', 'email')->update(['value' => $this->email]);
        _Setting::where('name', 'mobile')->update(['value' => $this->mobile]);
        _Setting::where('name', 'name_lang')->update(['value' => $this->name_lang]);
        _Setting::where('name', 'principal_name')->update(['value' => $this->principal_name]);
        _Setting::where('name', 'principal_message_page_link')->update(['value' => $this->principal_message_page_link]);

        $this->updateLogo();
        $this->updateBanner();
        $this->updatePrincipalPhoto();
    }


    private function updateLogo()
    {
        if(!$this->logo) return;

        $logo = _Setting::where('name', 'logo')->first();

        $logo->addMedia($this->logo)->toMediaCollection('logo');

        $this->logo = null;

        $this->old_logo = $logo->logoUrl();

    }


    private function updateBanner()
    {
        if(!$this->banner) return;

        $banner = _Setting::where('name', 'banner')->first();

        $banner->addMedia($this->banner)->toMediaCollection('banner');

        $this->banner = null;

        $this->old_banner = $banner->bannerUrl();
    }

    private function updatePrincipalPhoto()
    {
        if(!$this->principal_photo) return;

        $principal = _Setting::where('name', 'principal')->first();

        $principal->addMedia($this->principal_photo)->toMediaCollection('principal');

        $this->principal_photo = null;

        $this->old_principal_photo = $principal->principalPhotoUrl();
    }

}
