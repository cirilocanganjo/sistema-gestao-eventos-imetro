<?php

namespace App\Livewire\Dashboard;

use Exception;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;

class InvitationComponent extends Component
{
   public $invitation_sender = [],$allInvitationEventButton,$sentInvitationEventButton,$receivedInvitationEventButton,$rejectedInvitationEventButton, $expiredInvitationEventButton;

   public function mount () {
      $this->allInvitationEventButton = true;
   }

   #[Layout('layouts.dashboard.app')]        
    public function render() : View
    {
      return view('livewire.dashboard.invitation-component');
    }

    public function allInvitationEventButtonClicked()
       {
           $this->allInvitationEventButton = true;
           $this->sentInvitationEventButton = false;
           $this->receivedInvitationEventButton = false;
           $this->rejectedInvitationEventButton = false;
           $this->expiredInvitationEventButton = false;
       }

    public function sentEventButtonClicked ()
       {
           $this->sentInvitationEventButton = true;
           $this->allInvitationEventButton = false;
           $this->receivedInvitationEventButton = false;
           $this->rejectedInvitationEventButton = false;
           $this->expiredInvitationEventButton = false;
       }

    public function receivedEventButtonClicked ()
       {
           $this->receivedInvitationEventButton = true;
           $this->sentInvitationEventButton = false;
           $this->allInvitationEventButton = false;
           $this->rejectedInvitationEventButton = false; 
           $this->expiredInvitationEventButton = false;
       }  

     public function rejectedEventButtonClicked ()
       {
           $this->rejectedInvitationEventButton = true;
           $this->receivedInvitationEventButton = false;
           $this->sentInvitationEventButton = false;
           $this->allInvitationEventButton = false;         
           $this->expiredInvitationEventButton = false;       
       }

       public function expiredEventButtonClicked () {
           $this->expiredInvitationEventButton = true;   
           $this->rejectedInvitationEventButton = false;
           $this->receivedInvitationEventButton = false;
           $this->sentInvitationEventButton = false;
           $this->allInvitationEventButton = false;         
       }

    public function close () {
      try {
         $this->pull("invitation_sender");
      } catch (Exception $e) {
          LivewireAlert::title('Erro')
          ->text('erro: ' .$e->getMessage())
          ->error()
          ->withConfirmButton()
          ->confirmButtonText('Fechar')
          ->show();
      }
    }

    public function sendEventInvitation () {
      dd($this->invitation_sender);
    }
}
