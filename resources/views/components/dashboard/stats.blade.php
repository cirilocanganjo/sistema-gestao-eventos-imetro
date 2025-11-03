@props(['eventCounter' => [], 'eventMonths' => [], 'dataStatForUserCounter' => 0, 'dataStatForEventCounter' => 0, 'dataStatForTemporaryInvitationCounter' => 0 ])
<div class="col-lg-12">
                 <div class="row">

                   <!-- Eenets Card -->
                   <div class="col-xxl-4 col-md-6">
                     <div class="card cursor-pointer info-card sales-card">

                       <div class="filter">
                         <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>                      
                       </div>

                       <div class="card-body">
                         <h5 class="card-title">Eventos</h5>

                         <div class="d-flex align-items-center">
                           <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                             <i class="ri ri-calendar-2-fill"></i>
                           </div>
                           <div class="ps-3">

                             <h6>{{ $dataStatForEventCounter }}</h6>
                           </div>
                         </div>
                       </div>

                     </div>
                   </div>

                   <!-- Invitations Card -->
                   <div class="col-xxl-4 col-md-6">
                     <div class="card cursor-pointer info-card revenue-card">

                       <div class="filter">
                         <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                         
                       </div>

                       <div class="card-body">
                         <h5 class="card-title">Convites</h5>

                         <div class="d-flex align-items-center">
                           <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                             <i class="ri  ri-notification-2-line"></i>
                           </div>
                           <div class="ps-3">
                             <h6>{{ $dataStatForTemporaryInvitationCounter }}</h6>

                           </div>
                         </div>
                       </div>

                     </div>
                   </div>

                   <!-- Users Card -->
                   <div class="col-xxl-4 col-xl-12">

                     <div class="card cursor-pointer info-card customers-card">

                       <div class="filter">
                         <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                         
                       </div>

                       <div class="card-body">
                         <h5 class="card-title">Utilizadores</h5>

                         <div class="d-flex align-items-center">
                           <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                             <i class="bi bi-people"></i>
                           </div>
                           <div class="ps-3">
                             <h6>{{ $dataStatForUserCounter }}</h6>
                           </div>
                         </div>

                       </div>
                     </div>

                   </div>

                  
                <x-dashboard.chart 
                :eventCounter="$eventCounter ?? []" 
                :eventMonths="$eventMonths ?? []" 
                />       

                 </div>
</div>
