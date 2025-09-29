@section('title', 'Dashboard')
<div>

       <main>
      		<div id="main-wrapper" class="flex p-5 xl:pr-0">
      			<x-dashboard.side-bar />
        			<div class=" w-full page-wrapper xl:px-6 px-0">
          				<main class="h-full  max-w-full">
              					<div class="container full-container p-0 flex flex-col gap-6">
                            <x-dashboard.top-bar />           		
                            <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-x-6 gap-x-0 lg:gap-y-0 gap-y-6">
                             <x-dashboard.chart />       
              					    </div>      

              					  <x-dashboard.footer />
              					</div>
          				</main>				
        			</div>

      		</div>	
  	    </main>

</div>
