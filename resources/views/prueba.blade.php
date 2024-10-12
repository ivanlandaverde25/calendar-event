<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.15/index.global.min.js"></script>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.css' rel='stylesheet' />
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/locales/es.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>Calendario de prueba</title>
</head>
<style>
    body{
        background-color: #ececec;
    }
    
    .container{
        position: relative;
        overflow: hidden;
        background-color: #FAFAFA;
        font-family: "Roboto", sans-serif;
    }

    .calendar{
        font-size: 0.9rem;
    }

    .background-modal{
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 10;
        display: none;
        justify-content: center;
        align-items: center;
    }
    
    .modal{
        position: relative;
        background-color: #FFFFFF;
        color: #333333;
        padding: 20px;
        border-radius: 10px;
        min-width: 35%;
        border-left: solid #9c9c9c 2px;
        border-right: solid #9c9c9c 2px;
        border-bottom: solid #9c9c9c 2px;
        border-top: solid #3F688C 8px;
        transform: translateY(-140%);
        transition: .7s .1s ease-in-out;
        font-weight: bold;
        font-size: 1.1rem;
    }

    .modal-header{
        display: flex;
        flex-flow: column;
        justify-content: space-between;
        margin-bottom: 1.8rem;
    }
    
    .filaModal{
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        color: #333333;
    }
    
    .center-modal{
        transform: translateY(0%);
    }

    .margin-right{
        margin-right: 15px;
    }

    .inputTitle{
        outline: none;
        border: none;
        width: 100%;
        color: #333333;
        background-color: transparent;
        font-size: 1.6rem;
        font-weight: bold;
    }

    .breadcrums{
        font-size: 1rem;
        padding: 0;
        margin: 0;
        margin-top: 0.5rem;
    }

    .actions{
        color: #3F688C;
        font-size: 1.6rem;
        cursor: pointer;
        text-align: end;
    }

    .modal-footer{
        text-align: end;
    }

    .btn-fill{
        background-color: #3F688C;
        color: #FAFAFA;
        border-radius: 5px;
        border: 2px solid #3C5B77;
        outline: none;
        font-size: 1rem;
        padding: 5px 10px;
    }
</style>
<body>
    {{-- Contenedor general --}}
    <div class="container">

        {{-- Calendario --}}
        <div id="calendar" class="calendar">
        </div>

        {{-- Modal --}}
        <div class="background-modal" id="modalCreateCalendarEvent">
            
            {{-- Header modal --}}
            <div class="modal" id="modalContainer">
                <div class="modal-header">
                    <div class="actions">
                        <i class="fa-solid fa-ellipsis margin-right"></i>
                        <i class="fa-solid fa-xmark" id="btnCloseModal"></i>
                    </div>
                    <div class="title">
                        <input type="text" class="inputTitle" id="nombreActividad" placeholder="Nombre de la actividad">
                        <h3 class="breadcrums">Ubicación: Espacios > SIS | Tablero: Proyecto 1</h3>
                    </div>
                </div>
                
                {{-- Body modal --}}
                <div class="modal-content">
                    <form action="#" method="POST">
                        
                        {{-- fila 1 --}}
                        <div class="fila1 filaModal">
                            <div class="">
                                <i class="fa-regular fa-circle margin-right"></i>
                                <label>Grupo</label>
                            </div>
                            <input type="text" id="grupo" placeholder="Este mes">
                        </div>
                        
                        {{-- fila 2 --}}
                        <div class="fila2 filaModal">
                            <div class="">
                                <i class="fa-solid fa-user margin-right"></i>
                                <label>Responsable</label>
                            </div>
                            <input type="text" id="responsable" placeholder="Este mes">
                        </div>
                        
                        {{-- fila 3 --}}
                        <div class="fila3 filaModal">
                            <div class="">
                                <i class="fa-solid fa-server margin-right"></i>
                                <label>Estado</label>
                            </div>
                            <input type="text" id="estado" placeholder="Este mes">
                        </div>

                        {{-- fila 4 --}}
                        <div class="fila4 filaModal">
                            <div class="">
                                <i class="fa-solid fa-calendar-days margin-right"></i>
                                <label>Fecha de creación</label>
                            </div>
                            <input type="text" id="fechaCreacion" placeholder="Este mes" value="{{$fechaCreacion->format('d/m/Y')}}" @readonly(true)>
                        </div>
                        
                        {{-- fila 5 --}}
                        <div class="fila5 filaModal">
                            <div class="">
                                <i class="fa-solid fa-clipboard-check margin-right"></i>
                                <label>Prioridad</label>
                            </div>
                            <input type="text" id="prioridad" placeholder="Este mes">
                        </div>

                        {{-- Rango de fechas --}}
                        <div class="fechas" style="display: flex; margin-bottom:10px;">
                            {{-- fila 6 --}}
                            <div class="fila6">
                                <p>Fecha Inicio</p>
                                <input type="date" id="fechaInicioEvento" placeholder="dd/mm/yyyy">
                            </div>
    
                            {{-- fila 7 --}}
                            <div class="fila7">
                                <p>Fecha Fin</p>
                                <input type="date" id="fechaFinEvento" placeholder="dd/mm/yyyy">
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Footer modal --}}
                <div class="modal-footer">
                    {{-- <button type="button" id="btnCloseModal">Cerrar</button> --}}
                    <button type="button" class="btn-fill" id="btnCreateEvent">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            
            let fechaInicioEvento = document.getElementById('fechaInicioEvento');
            let fechaFinEvento = document.getElementById('fechaFinEvento');
            
            let modalCreateCalendarEvent = document.getElementById('modalCreateCalendarEvent');
            let modalContainer = document.getElementById('modalContainer');
            
            let btnCreateEvent = document.getElementById('btnCreateEvent'); 
            let btnCloseModal = document.querySelector('#btnCloseModal');
            btnCloseModal.addEventListener('click', () => {
                modalCreateCalendarEvent.style.display = 'none';
            });

            let agregarTarea = (event) => {

            };
            
            // Calendario
            let calendarEl = document.getElementById('calendar');
            let calendar = new FullCalendar.Calendar(calendarEl, {
                // plugins: [dayGridPlugin],
                locale: 'es',
                events: '/mostrar-eventos',
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                selectable: true,
                selectHelper: true,
                editable: true,
                select: function(event){
                    
                    modalCreateCalendarEvent.style.display = 'flex';
                    modalContainer.classList.add('center-modal');
                    fechaInicioEvento.value = event.startStr;
                    fechaFinEvento.value = event.endStr;

                    btnCreateEvent.addEventListener('click', () =>{
                        let nombreActividad = document.getElementById('nombreActividad').value;
                        let grupo = document.getElementById('grupo').value;
                        let responsable = document.getElementById('responsable').value;
                        let estado = document.getElementById('estado').value;
                        let prioridad = document.getElementById('prioridad').value;
                        let fechaCreacion = document.getElementById('fechaCreacion').value;
                        let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        
                        const fecha = new Date();
                        let fechaC = fecha.getFullYear() + '-' + (fecha.getMonth() + 1) + '-' + fecha.getDate();

                        let eventData = {
                            nombre: nombreActividad,
                            grupo: grupo,
                            responsable: responsable,
                            estado: estado,
                            prioridad: prioridad,
                            fecha_creacion: fechaC,
                            fecha_inicio: event.startStr,
                            fecha_fin: event.endStr,
                        }
                        console.log('La fecha inicial del evento a registrar es: ' + event.startStr)
                        console.log('La fecha final del evento a registrar es: ' + event.endStr)

                        fetch('/registrar-evento', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify(eventData)
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                console.log('El evento se registro con exito')
                                calendar.addEvent({
                                    title: nombreActividad,
                                    start: event.startStr,
                                    end: event.endStr
                                });
                            } else {
                                // console.log(data);
                            }
                        })
                        .catch(error => console.error('Error:', error));

                        modalCreateCalendarEvent.style.display = 'none';
                        modalContainer.classList.remove('center-modal');
                        
                        // Limpiar campos
                        document.getElementById('nombreActividad').value = '';
                        document.getElementById('grupo').value = '';
                        document.getElementById('responsable').value = '';
                        document.getElementById('estado').value = '';
                        document.getElementById('prioridad').value = '';
                        document.getElementById('fechaInicioEvento').value = '';
                        document.getElementById('fechaFinEvento').value = '';
                        // event.startStr = '';
                        // event.endStr = '';
                    });
                },
                eventClick: function(event){
                    alert('nfghnfghfghf');
                }
            });

            calendar.render();
        });
    </script>
</body>
</html>