<?php

namespace App\Livewire\Dashboard;

use \App\Models\{Event, EventCategory};
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class EventComponent extends Component
{
    use WithFileUploads;
    public $uuid,$event,$event_category,$event_date,$event_time,$event_description,$event_photo,$fileName,$event_name,$status,$searcher,$startdate,$enddate,$eventName,$eventCoverPhoto;
    protected $listeners = ['highlightEvent' => 'confirmHighlightEvent', 'confirmEventDeletion' => 'confirmEventDeletion'];

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

            $alreadyStoredEventWithTimeAndDateToday = Event::query()->where('event_date', $this->event_date)
            ->where('event_time', $this->event_time)
            ->whereDate('event_date', Carbon::now()->toDateString())
            ->whereYear('created_at', Carbon::now()->year)
            ->first();

           if ($alreadyStoredEventWithTimeAndDateToday) {
                LivewireAlert::title('Atenção!')
                 ->text("Já existe um evento cadastrado com a data e hora informadas para o dia de hoje,tente novamente outro horário!")
                 ->warning()
                 ->withConfirmButton()
                 ->timer(0)
                 ->withOptions(['allowOutsideClick' => false])
                 ->confirmButtonText('Fechar')
                 ->show();
            }else {
                $this->event = Event::create([
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
            if ($this->event) {
                $this->status = false;
                LivewireAlert::title('Sucesso')
                ->text('Evento cadatrado com sucesso!')
                ->success()
                ->withConfirmButton()
                ->timer(0)
                ->confirmButtonText('Fechar')
                ->show();
                $this->reset(['event_category','event_date','event_time','event_description','event_photo','fileName','event_name']);
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
        }
    }

    public function edit ($uuid) {
        try {    
            $this->uuid = $uuid;      
            $this->status = true;
           $event = Event::query()->where('uuid', $uuid)->first();
           $this->event_name = $event->event_name;
           $this->event_category = $event->event_category_uuid;
           $this->event_date = $event->event_date;
           $this->event_time = $event->event_time;
           $this->event_description = $event->event_description;
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

    public function update () {
        try {
            DB::beginTransaction();       
            $old_event_cover_photo = Event::query()->where('uuid', $this->uuid)->value('event_cover_photo');

            if ($this->event_photo and $this->event_photo->isValid()) {
             $this->fileName = md5($this->event_photo->getClientOriginalName() .now()). '.' .$this->event_photo->getClientOriginalExtension();
             $this->event_photo->storeAs("imgs", $this->fileName, 'public');
            
               if (Storage::disk('public')->exists('imgs/' . $old_event_cover_photo)) { //Remove photo from storage if it exists there
                Storage::disk('public')->delete('imgs/' . $old_event_cover_photo);
                }
            }

            $event = Event::query()->where('uuid', $this->uuid)->update([
                'event_name' => $this->event_name,
                'event_category_uuid' => $this->event_category,
                'event_date' => $this->event_date,
                'event_time' => $this->event_time,
                'event_cover_photo' => $this->fileName ?? $old_event_cover_photo,
                'event_description' => $this->event_description,
                'user_id' => auth()->user()->id,
            ]);
            DB::commit();

            if ($event >= 1) {
                $this->status = false;
                LivewireAlert::title('Sucesso')
                ->text('Evento atualizado com sucesso!')
                ->success()
                ->withConfirmButton()
                ->timer(0)
                ->confirmButtonText('Fechar')
                ->show();

            }
        } catch (\Throwable $th) {
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
        }
    }

    
    public function delete (string $uuid) {
        try {
           $this->uuid = $uuid;
           LivewireAlert::title('Atenção')
            ->text('Deseja  eliminar este evento?')
            ->warning()
            ->withDenyButton()
            ->withConfirmButton()
            ->confirmButtonText('Sim, confirmar')
            ->denyButtonText('Não, cancelar')
            ->withOptions(['allowOutsideClick' => false])
            ->timer(0)
            ->onConfirm('confirmEventDeletion')
            ->show();
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

   public function confirmEventDeletion()
{
    try {
        DB::beginTransaction();

        $this->event = Event::find($this->uuid);

        if ($this->event && Storage::disk('public')->exists('imgs/' . $this->event->event_cover_photo)) {
            Storage::disk('public')->delete('imgs/' . $this->event->event_cover_photo);
        }

        $event = Event::where('uuid', $this->uuid)->delete();

        DB::commit();

        if ($event >= 1) {
            LivewireAlert::title('Sucesso')
                ->text('Evento eliminado com sucesso!')
                ->success()
                ->withConfirmButton()
                ->timer(0)
                ->confirmButtonText('Fechar')
                ->show();

            $this->dispatch('event-deleted');
        }
       
        $this->reset(['uuid', 'event']);

    } catch (\Throwable $ex) {
        DB::rollBack();

        LivewireAlert::title('Erro')
            ->text('erro: ' . $ex->getMessage())
            ->error()
            ->withConfirmButton()
            ->timer(0)
            ->confirmButtonText('Fechar')
            ->show();
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
            )->orderBy('created_at', 'DESC')
            ->get();

        } catch (Exception $e) {
         LivewireAlert::title('Erro')
             ->text('erro: ' .$e->getmessage())
             ->error()
             ->withConfirmButton()
             ->timer(0)
             ->confirmButtonText('Fechar')
             ->show();
        }
    }

    public function close () {
        try {
        $this->status = false;
        $this->reset(['event_category','event_date','event_time','event_description','event_photo','fileName','event_name']);
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

    public function highlightEvent ($uuid) {
        try {
            $this->uuid = $uuid;
            $is_highlighted = Event::where('uuid', $this->uuid)
            ->where('event_highlighted', true)
            ->value('event_highlighted');

            LivewireAlert::title('Atenção')
            ->text('Deseja ' . ($is_highlighted ? 'não destacar' : 'destacar') . ' este evento?')
            ->warning()
            ->withDenyButton()
            ->withConfirmButton()
            ->confirmButtonText('Sim, confirmar')
            ->denyButtonText('Não, cancelar')
            ->withOptions(['allowOutsideClick' => false])
            ->timer(0)
            ->onConfirm('confirmHighlightEvent')
            ->show();

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

    public function confirmHighlightEvent () {
        try {
           $alreadyExistsHighlightedEvent = Event::query()->where('event_highlighted',true)->first();
          /* if ($alreadyExistsHighlightedEvent) {
                LivewireAlert::title('Atenção')
                 ->text('
                        Já nao pode destacar este evento, apenas 1 evento de cada vez é permitido!
                        '
                 )
                 ->warning()
                 ->withConfirmButton()
                 ->timer(0)
                 ->confirmButtonText('Fechar')
                 ->show();
                }else {*/

                $event = Event::query()->where('uuid', $this->uuid)->update([
                    'event_highlighted' => DB::raw('NOT event_highlighted')  //Toggle boolean value if true set to false and vice versa
                    ]);

            //    }

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
