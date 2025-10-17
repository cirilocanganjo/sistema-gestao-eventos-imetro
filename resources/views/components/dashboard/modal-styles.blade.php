<style>                  
       
        .modal {
            display: none;            
            position: fixed;          
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: start;
            z-index: 1000;
        }

        .modal-content {
            margin-top: 100px;
            background-color: #fff;
            border-radius: 4px;
            max-width: 500px;
            width: 90%;
            max-height: 80vh; 
            overflow-y: auto; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.3s ease-in-out;
        }

        .modal-header {
            padding: 15px;
            border-bottom: 1px solid #e5e5e5;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky; /* Fixa o cabeçalho no topo */
            top: 0;
            background-color: #fff; /* Garante fundo branco */
            z-index: 1; /* Mantém o cabeçalho acima do conteúdo */
        }

        .modal-header h2 {
            margin: 0;
            font-size: 1.5rem;
        }

        .modal-close {
            font-size: 1.5rem;
            font-weight: bold;
            color: #000;
            cursor: pointer;
            background: none;
            border: none;
            line-height: 1;
        }

        .modal-close:hover {
            color: #dc3545;
        }

        .modal-body {
            padding: 15px;
        }

        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal.fade-in {
            display: flex;
            animation: fadeInBackdrop 0.3s ease-in-out;
        }

        @keyframes fadeInBackdrop {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
</style>