@section('title', 'Sistema de Gestão de Eventos Imetro | Cadastrar nova conta')

<div>
     <x-home.header />                   

        <main class='d-flex flex-wrap col-md-12 gap-1  justify-content-center align-items-start'>

            <div class='col-md-5 '>
                <div class='form-group mb-3' wire:ignore>
                    <label>Nome:</label>
                    <input id="fullname" wire:model='fullname' type="text" required class=' px-3 py-3 form-control' placeholder="Digite o seu nome" />
                    <span id='fullname_error' class=' text-danger'></span>
                </div>

                <div class='form-group mb-3' wire:ignore>
                    <label>Número de telefone:</label>
                    <input wire:model='phone' type="text" id="phone" type="tel" placeholder="Digite o número de telefone" required class=' px-3 py-3 form-control'  />
                    <span id='phone_error' class='text-danger'></span>                
                </div>

                 <div class='form-group mb-3' wire:ignore>
                    <label>Email:</label>
                    <input id="email" wire:model='email' type="text" class='px-3 py-3 form-control' placeholder="Digite o seu email" required />
                     <span id='email_error' class='text-danger'></span>
                </div>

                  <div class='form-group mb-3' wire:ignore>
                    <label>Perfil de acesso:</label>
                    <select id='visitor_type' wire:model='visitor_type' class="py-3 px-4 block form-select" >
                        <option value="">Selecionar</option>
                         @if (isset($visitor_types) and $visitor_types->isNotEmpty()) 
                         @foreach ($visitor_types as $key => $type)
                         <option wire:key='{{ $key }}' value='{{ $type->uuid }}'>{{ $type->type }}</option>
                         @endforeach
                         @endif                                                
                    </select>
                    <span id='visitor_type_span' class='text-danger'></span>                
                </div>

                 <div class='form-group mb-3' wire:ignore>
                    <label>Foto:</label>
                    <input key="{{ now() }}" accept="image/*" wire:model='photo' type="file" id="photo" type="file" class=' px-3 py-3 form-control'  />
                </div>

            </div> 

            <div class='col-md-5'>
                <div class='form-group mb-3' wire:ignore>
                    <label>Número do bilhete de identidade::</label>
                    <input id="identity_card_number" wire:model='identity_card_number' type="text" class='px-3 py-3 form-control' placeholder="000000000AA000" required />
                    <span id='identity_card_number_span' class='text-danger'></span> 
                </div>

                 <div class='form-group mb-3' wire:ignore>
                    <label>Gênero:</label>
                    <select id='gender' wire:model='gender' required class='py-3 px-4 block form-select'>
                        <option value=''>Selecionar</option>
                        <option value='masculino'>Masculino</option>
                        <option value='feminino'>Feminino</option>
                    </select>
                    <span id='gender_span' class='text-danger'></span>                     
                </div>

                 <div class='form-group mb-3 position-relative' wire:ignore>
                    <label>Senha:</label>
                    <input id="password" wire:model='password' type="password" class='px-3 py-3 form-control' placeholder="Digite a senha" required />
                    <i class="bi bi-eye position-absolute toggle-password" onclick="togglePasswordVisibility()"  style="top: 50%; right: 15px; transform: translateY(-50%); cursor: pointer; font-size: 20px;"></i>
                    <span id='password_span' class='text-danger'></span>                    
                </div>
                      

                <div class='form-group mb-3 position-relative' wire:ignore>
                    <label>Confirmar senha:</label>
                    <input id="confirm_password" wire:model='confirm_password' type="password" class='px-3 py-3 form-control' placeholder="Digite novamente a senha para confirmar" required />
                    <i class="bi bi-eye position-absolute toggle-confirm-password" onclick="toggleConfirmPasswordVisibility()"  style="top: 50%; right: 15px; transform: translateY(-50%); cursor: pointer; font-size: 20px;"></i>
                    <span id='confirm_password_span' class='text-danger'></span> 
                </div>
               

            </div> 
                
        </main>

        <div   class='box-buttons col-md-5 '>
            <div class='form-group'>
            </div>
             <button 
                    wire:click='storeNewAccount()'
                    class=" btn  btn-dark px-2 py-2  text-base text-white font-medium hover:bg-blue-700 rounded-sm">
                        Cadastrar
             </button>
        </div>
       
</div>




@push('scripts')

    <script defer>           
            let nav_item_home = document.getElementById('nav-item-home');
            nav_item_home.classList.add('active');

            function togglePasswordVisibility() {
                const input = document.getElementById("password");
                const icon = document.querySelector(".toggle-password");

                    if (input.type === "password") {
                        input.type = "text";
                        icon.classList.remove("bi-eye");
                        icon.classList.add("bi-eye-slash");
                    } else {
                        input.type = "password";
                        icon.classList.remove("bi-eye-slash");
                        icon.classList.add("bi-eye");
                    }
                }

                function toggleConfirmPasswordVisibility() {
                const input = document.getElementById("confirm_password");
                const icon = document.querySelector(".toggle-confirm-password");

                    if (input.type === "password") {
                        input.type = "text";
                        icon.classList.remove("bi-eye");
                        icon.classList.add("bi-eye-slash");
                    } else {
                        input.type = "password";
                        icon.classList.remove("bi-eye-slash");
                        icon.classList.add("bi-eye");
                    }
                }


            let placeholder_for_fullname = {
                placeholder: "Digite o seu nome"                
            };              

            let placeholder_for_identity_card = {
                placeholder: "000000000AA000",
                'translation':{
                    A:{
                    pattern: /[A-Z]/
                }
                    }
            };    

            let placeholder_for_phone_number = {
                placeholder: "Digite o número de telefone"                
            };   

             $('#fullname').on('input', function() {  //Validation for names              
              var input_value = $(this).val();
              var updated_value = input_value.replace(/[^a-zA-Z\s\-\á\Á\à\À\ñ\Ñ\.\ã\ç\ó\Ó\é\É\\]/g, '');
              $(this).val(updated_value);
            }); 

            $('#phone').mask('+244000000000', placeholder_for_phone_number); //Validation for phone numbers   
            $('#identity_card_number').mask('000000000AA000',placeholder_for_identity_card); // Validation for identity cards

            
                document.querySelectorAll('input[type="password"]').forEach(input => {
                    input.addEventListener('focus', () => {
                        input.classList.add('no-focus');
                    });
                });

              document.addEventListener('livewire:initialized', () => {
                Livewire.on('validate-inputs', () => {
                    let fullname = document.getElementById('fullname').value;
                    let fullname_span = document.getElementById('fullname_error');

                    let phone = document.getElementById('phone').value;
                    let phone_span = document.getElementById('phone_error');

                    let email = document.getElementById('email').value;
                    let email_span = document.getElementById('email_error');  

                     let visitor_type = document.getElementById('visitor_type').value;
                    let visitor_type_span = document.getElementById('visitor_type_span'); 

                    let identity_card_number = document.getElementById('identity_card_number').value;
                    let identity_card_number_span = document.getElementById('identity_card_number_span');

                    let gender = document.getElementById('gender').value;
                    let gender_span = document.getElementById('gender_span'); 

                    let password = document.getElementById('password').value;
                    let password_span = document.getElementById('password_span'); 

                    let confirm_password = document.getElementById('confirm_password').value;
                    let confirm_password_span = document.getElementById('confirm_password_span'); 


                    if (fullname) {
                      fullname_span.classList.add('d-none');

                    }else {
                      fullname_span.classList.remove('d-none');
                      fullname_span.textContent = 'Campo obrigatório *';
                    }

                    if (phone) {
                     phone_span.classList.add('d-none');
                    }else {
                      phone_span.classList.remove('d-none');
                      phone_span.textContent = 'Campo obrigatório *';
                    }   
                  
                    if (email) {
                     email_span.classList.add('d-none');
                    }else {
                        email_span.classList.remove('d-none');
                        email_span.textContent = 'Campo obrigatório *';
                    }  

                    if (visitor_type) {
                      visitor_type_span.classList.add('d-none');
                    }else {
                        visitor_type_span.classList.remove('d-none');
                        visitor_type_span.textContent = 'Campo obrigatório *';
                    }    

                     if (identity_card_number) {
                      identity_card_number_span.classList.add('d-none');
                    }else {
                        identity_card_number_span.classList.remove('d-none');
                        identity_card_number_span.textContent = 'Campo obrigatório *';
                    }  

                     if (gender) {
                      gender_span.classList.add('d-none');
                     }else {
                        gender_span.classList.remove('d-none');
                        gender_span.textContent = 'Campo obrigatório *';
                    }  

                    if (password) {
                      password_span.classList.add('d-none');
                     }else {
                       password_span.classList.remove('d-none');
                       password_span.textContent = 'Campo obrigatório *';
                    }  

                    if (confirm_password) {
                      password_span.classList.add('d-none');
                     }else {
                       confirm_password_span.classList.remove('d-none');
                       confirm_password_span.textContent = 'Campo obrigatório *';
                    }

                    if (password != confirm_password) {
                       confirm_password_span.textContent = 'O campo senha e confirmar senha não correspondem,tente novamente';                        
                    }else if (password && confirm_password && password === confirm_password){
                      confirm_password_span.classList.add('d-none');                        
                    }  
                  
            });
            });
               

    </script>
  
           

@endpush
