<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithSweetAlert;
use App\Models\Announcement;

class AnnouncementList extends Component
{
    use WithPagination;
    use WithSweetAlert;

    public $search;

    protected $listeners = [
        'onAnnouncementCreated' => '$refresh',
        'onAnnouncementUpdated' => '$refresh',
        'onAnnouncementDelete' => 'deleteAnnouncement',
    ];


    public function render()
    {
        $announcements = $this->getAnnouncements();

        return view('admin.components.announcement-list', compact('announcements'));
    }


    public function enableAnnouncementEditMode($id)
    {
        $this->emit('onAnnouncementEdit', $id);
    }


    public function confirmDeleteAnnouncement($id)
    {
        return $this->ifConfirmThenDispatch('onAnnouncementDelete', $id, 'Are you sure ?', 'Announcement will delete permanently !');
    }


    public function deleteAnnouncement($id)
    {
        try {
            Announcement::destroy($id);
            return $this->success('Success', 'Announcement deleted successfully.');
        }catch(\Exception $e)
        {
            return $this->error('Failed', 'Failed to delete Announcement. try again');
        }

    }

    public function openSlideList($AnnouncementId)
    {
        $this->emit('onOpenSlideList', $AnnouncementId);
    }


    private function getAnnouncements()
    {

        $search = $this->search;

        $query = Announcement::query();

        $query->when($this->search, function($query) use($search){
            $query->where('announce', 'like', '%' . $search . '%')->orWhere('announce', $search);
        });

        return $query->paginate(25);

    }
}
