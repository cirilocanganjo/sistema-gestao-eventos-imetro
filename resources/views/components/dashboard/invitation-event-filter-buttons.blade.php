@props(["allInvitationEventButton" => true,"sentInvitationEventButton" => false, "receivedInvitationEventButton"  => false, "rejectedInvitationEventButton"  => false, "expiredInvitationEventButton" => false])
<div class='d-flex flex-wrap justify-content-center gap-1 my-3 mb-3'>
        <button wire:click='allInvitationEventButtonClicked' class="btn btn-sm {{ $allInvitationEventButton ? 'btn-warning' : 'btn-dark' }} rounded ">Todos</button>
        <button wire:click='sentEventButtonClicked' class="btn btn-sm {{ $sentInvitationEventButton ? 'btn-warning' : 'btn-dark' }} rounded">Enviados</button>
       <button wire:click='receivedEventButtonClicked' class="btn btn-sm {{ $receivedInvitationEventButton ? 'btn-warning' : 'btn-dark' }} rounded">Recebidos</button>
       <button wire:click='rejectedEventButtonClicked' class="btn btn-sm {{ $rejectedInvitationEventButton ? 'btn-warning' : 'btn-dark' }} rounded">Rejeitados</button> 
       <button wire:click='expiredEventButtonClicked' class="btn btn-sm {{ $expiredInvitationEventButton ? 'btn-warning' : 'btn-dark' }} rounded">Expirados</button> 

</div>





