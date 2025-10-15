@props(['eventName' => null, 'eventCoverPhoto' => null])
<div wire:ignore.self class="modal fade" id="event-photo-detail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-scrollable">
      <div class="modal-content bg-white">
        <div class="modal-header">
          <h1 class="modal-title fs-5"> {{ $eventName }} </h1>
          <button  type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
        <img style="width: 400px;" src="{{ asset('storage/imgs/' . $eventCoverPhoto) }}"
         class='w-100 rounded'
        />

        </div>

      </div>
    </div>
  </div>


