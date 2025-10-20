@props(['eventName' => null, 'eventCoverPhoto' => null])
<div wire:ignore.self class="modal" id="event-image-detail-modal">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5"> {{ $eventName }} </h1>
            <button wire:click='close' class="modal-close" onclick="closeModalImageDetailsModal()">&times;</button>
        </div>


        <div class="modal-body">
        <img style="width: 400px;" src="{{ asset('storage/imgs/' . $eventCoverPhoto) }}"
         class='w-100 rounded'
        />

        </div>

      </div>
  </div>


