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
               <x-dashboard.stats />
             </div>
           </section>

         </main>

</div>
