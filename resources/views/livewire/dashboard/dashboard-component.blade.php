@section('title', 'Dashboard')
<div>

    
 <x-dashboard.top-bar />
  <x-dashboard.side-bar />

         <main id="main" class="main">

           <div class="pagetitle">
             <h1>Dashboard</h1>             
           </div>

           <section class="section dashboard">
             <div class="row">      

               <x-dashboard.stats 
                :eventCounter="$eventCounter ?? []" 
                :eventMonths="$eventMonths ?? []"  
                :dataStatForUserCounter="$dataStatForUserCounter ?? 0"
                :dataStatForEventCounter="$dataStatForEventCounter ?? 0"
                :dataStatForTemporaryInvitationCounter="$dataStatForTemporaryInvitationCounter ?? 0"
              />

             </div>
           </section>

         </main>

</div>
