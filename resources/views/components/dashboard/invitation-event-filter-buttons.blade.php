@props(["allInvitationEventButton" => true,"sentInvitationEventButton" => false, "receivedInvitationEventButton"  => false, "rejectedInvitationEventButton"  => false])
<div class='d-flex flex-wrap justify-content-center gap-1 my-3 mb-3'>
        <button wire:click='allInvitationEventButtonClicked' class="btn {{ $allInvitationEventButton ? 'btn-warning' : 'btn-dark' }} rounded ">Todos</button>
        <button wire:click='sentEventButtonClicked' class="btn {{ $sentInvitationEventButton ? 'btn-warning' : 'btn-dark' }} rounded">Enviados</button>
       <button wire:click='receivedEventButtonClicked' class="btn  {{ $receivedInvitationEventButton ? 'btn-warning' : 'btn-dark' }} rounded">Recebidos</button>
       <button wire:click='rejectedEventButtonClicked' class="btn  {{ $rejectedInvitationEventButton ? 'btn-warning' : 'btn-dark' }} rounded">Rejeitados</button> 
       <button wire:click='rejectedEventButtonClicked' class="btn  {{ $rejectedInvitationEventButton ? 'btn-warning' : 'btn-dark' }} rounded">Expirados</button> 

</div>





