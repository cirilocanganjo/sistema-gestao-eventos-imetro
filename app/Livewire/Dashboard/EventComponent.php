<?php

namespace App\Livewire\Dashboard;

use \App\Models\{Event, EventCategory};
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class EventComponent extends Component
{
    use WithFileUploads;
    public $event_category,$event_date,$event_time,$event_description,$event_photo,$fileName,$event_name,$status,$searcher,$startdate,$enddate,$eventName,$eventCoverPhoto;

    public function mount () {
        $this->status = false;
    }

    #[Layout('layouts.dashboard.app')]
    public function render()
    {
        return view('livewire.dashboard.event-component',[
            'data' =>$this->getEvents(),
            'categories' =>$this->getEventCategories()
        ]);
    }

    public function store () {
        $this->validate([
            'event_name' => 'required|string|max:255',
            'event_category' => 'required|exists:event_categories,uuid',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'event_description' => 'required|string|max:1000',
            'event_photo' => 'required',
        ],[
            'event_name.required' => 'O nome do evento é obrigatório.',
            'event_category.required' => 'A categoria do evento é obrigatória.',
            'event_category.exists' => 'A categoria selecionada é inválida.',
            'event_date.required' => 'A data do evento é obrigatória.',
            'event_date.date' => 'A data do evento deve ser uma data válida.',
            'event_time.required' => 'A hora do evento é obrigatória.',
            'event_description.required' => 'A descrição do evento é obrigatória.',
            'event_description.string' => 'A descrição do evento deve ser um texto válido.',
            'event_description.max' => 'A descrição do evento não pode exceder 1000 caracteres.',
            'event_photo.required' => 'A foto do evento é obrigatória.',
        ]);
        try {
            DB::beginTransaction();
            if ($this->event_photo and $this->event_photo->isValid()) {
             $this->fileName = md5($this->event_photo->getClientOriginalName() .now()). '.' .$this->event_photo->getClientOriginalExtension();
             $this->event_photo->storeAs("imgs", $this->fileName, 'public');
            }

            if (Carbon::parse($this->event_date)->year < Carbon::now()->year) {
                LivewireAlert::title('Atenção!')
                 ->html("<div>O <strong>ano</strong> do evento não pode ser inferior ao ano atual.</div>")
                 ->warning()
                 ->withConfirmButton()
                 ->timer(0)
                 ->withOptions(['allowOutsideClick' => false])
                 ->confirmButtonText('Fechar')
                 ->show();
                 return;
            }else {
                $event = Event::create([
                    'event_name' => $this->event_name,
                    'event_category_uuid' => $this->event_category,
                    'event_date' => $this->event_date,
                    'event_time' => $this->event_time,
                    'event_description' => $this->event_description,
                    'event_cover_photo' => $this->fileName ?? null,
                    'user_id' => auth()->user()->id,
                ]);
                DB::commit();
            }
            if ($event) {
                $this->reset(['event_category','event_date','event_time','event_description','event_photo','fileName','event_name']);
                $this->status = false;
                LivewireAlert::title('Sucesso')
                 ->text('Evento cadatrado com sucesso!')
                 ->success()
                 ->withConfirmButton()
                 ->timer(0)
                 ->confirmButtonText('Fechar')
                 ->show();
                 $this->dispatch('event-created');
            }
        } catch (\Throwable $th) {
            DB::rollback();
            if (Storage::disk('public')->exists('imgs/' . $this->fileName)) { //Remove photo from storage if it exists there
              Storage::disk('public')->delete('imgs/' . $this->fileName);
            }
            LivewireAlert::title('Erro')
             ->text('erro: ' .$th->getmessage())
             ->error()
             ->withConfirmButton()
             ->timer(0)
             ->confirmButtonText('Fechar')
             ->show();
             return collect([]);
        }
    }

    public function edit () {
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function update () {
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getEventCategories () {
        try {
            return EventCategory::select('uuid', 'category')->get();
        } catch (\Throwable $th) {
             LivewireAlert::title('Erro')
             ->text('erro: ' .$th->getmessage())
             ->error()
             ->withConfirmButton()
             ->timer(0)
             ->confirmButtonText('Fechar')
             ->show();
             return collect([]);
        }
    }

    public function getEvents () {
        try {
            return Event::query()->with(['eventCategory', 'user'])
            ->when(!empty($this->searcher), fn ($q) =>
             $q->where('event_name', 'like', "%{$this->searcher}%")
             ->orWhere('event_description', 'like', "%{$this->searcher}%"))

            ->when($this->startdate && $this->enddate, fn ($q) =>
                $q->whereBetween('created_at', [
                 Carbon::parse($this->startdate)->startOfDay(),
                 Carbon::parse($this->enddate)->endOfDay()
                ])
            )->get();

        } catch (Exception $e) {
         LivewireAlert::title('Erro')
             ->text('erro: ' .$e->getmessage())
             ->error()
             ->withConfirmButton()
             ->timer(0)
             ->confirmButtonText('Fechar')
             ->show();
             return collect([]);
        }
    }

    public function close () {
        try {
            //code...
        } catch (\Throwable $th) {
            LivewireAlert::title('Erro')
             ->text('erro: ' .$th->getmessage())
             ->error()
             ->withConfirmButton()
             ->timer(0)
             ->confirmButtonText('Fechar')
             ->show();
        }
    }

    public function showEventCoverPhoto (string $eventUuid) {
        try {
            $event = Event::query()->where('uuid', $eventUuid)->first();
            $this->eventName = $event->event_name;
            $this->eventCoverPhoto = $event->event_cover_photo;
        } catch (\Throwable $th) {
           LivewireAlert::title('Erro')
             ->text('erro: ' .$th->getmessage())
             ->error()
             ->withConfirmButton()
             ->timer(0)
             ->confirmButtonText('Fechar')
             ->show();
        }
    }
}
