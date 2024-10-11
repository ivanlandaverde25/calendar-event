<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.15/index.global.min.js"></script>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.css' rel='stylesheet' />
    {{-- <script src='fullcalendar/core/locales/es.global.js'></script> --}}
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
    <title>Calendario de prueba</title>
</head>
<style>
    .container{
        position: relative;
        overflow: hidden;
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
        transition: .6s .1s ease-in-out;
    }

    .modal{
        position: relative;
        background-color: #FFFFFF;
        padding: 20px;
        border-radius: 10px;
        max-width: 70%;
        border-left: solid #9c9c9c 2px;
        border-right: solid #9c9c9c 2px;
        border-bottom: solid #9c9c9c 2px;
        border-top: solid #3F688C 8px;
    }
</style>
<body>
    {{-- Contenedor general --}}
    <div class="container">

        {{-- Calendario --}}
        <div id="calendar">
        </div>

        {{-- Modal --}}
        <div class="background-modal" id="modalCreateCalendarEvent">
            
            {{-- Header modal --}}
            <div class="modal">
                <div class="modal-header">
                    <h2>Detalles del nuevo evento</h2>
                    <h3>Pertenece al grupo:</h3>
                </div>
                
                {{-- Body modal --}}
                <div class="modal-content">
                    <form action="#" method="POST">

                        {{-- fila 1 --}}
                        <div class="fila1">
                            <p>Nombre actividad</p>
                            <input type="text" id="nombreActividad" placeholder="Este mes">
                        </div>

                        {{-- fila 2 --}}
                        <div class="fila2">
                            <p>Grupo</p>
                            <input type="text" id="grupo" placeholder="Este mes">
                        </div>

                        {{-- fila 3 --}}
                        <div class="fila3">
                            <p>Responsable</p>
                            <input type="text" id="responsable" placeholder="Este mes">
                        </div>

                        {{-- fila 4 --}}
                        <div class="fila4">
                            <p>Estado</p>
                            <input type="text" id="estado" placeholder="Este mes">
                        </div>

                        {{-- fila 5 --}}
                        <div class="fila5">
                            <p>Fecha de creación</p>
                            <input type="text" id="fechaCreacion" placeholder="Este mes" value="{{$fechaCreacion->format('d/m/Y')}}" @readonly(true)>
                        </div>

                        {{-- fila 6 --}}
                        <div class="fila6">
                            <p>Prioridad</p>
                            <input type="text" id="prioridad" placeholder="Este mes">
                        </div>

                        {{-- Rango de fechas --}}
                        <div class="fechas" style="display: flex; margin-bottom:10px;">
                            {{-- fila 7 --}}
                            <div class="fila7">
                                <p>Fecha Inicio</p>
                                <input type="date" id="fechaInicioEvento" placeholder="dd/mm/yyyy">
                            </div>
    
                            {{-- fila 8 --}}
                            <div class="fila8">
                                <p>Fecha Fin</p>
                                <input type="date" id="fechaFinEvento" placeholder="dd/mm/yyyy">
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Footer modal --}}
                <div class="modal-footer">
                    <button type="button" id="btnCloseModal">Cerrar</button>
                    <button type="button" id="btnCreateEvent">Crear</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            
            let fechaInicioEvento = document.getElementById('fechaInicioEvento');
            let fechaFinEvento = document.getElementById('fechaFinEvento');
            
            let modalCreateCalendarEvent = document.getElementById('modalCreateCalendarEvent');
            
            let btnCreateEvent = document.getElementById('btnCreateEvent'); 
            let btnCloseModal = document.getElementById('btnCloseModal');
            btnCloseModal.addEventListener('click', () => {
                modalCreateCalendarEvent.style.display = 'none';
            });
            
            // Calendario
            let calendarEl = document.getElementById('calendar');
            let calendar = new FullCalendar.Calendar(calendarEl, {
                // plugins: [dayGridPlugin],
                locale: 'es',
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                selectable: true,
                editable: true,
                placeholder: true,
                select: function(event){
                    
                    modalCreateCalendarEvent.style.display = 'flex';
                    fechaInicioEvento.value = event.startStr;
                    fechaFinEvento.value = event.endStr;

                    btnCreateEvent.addEventListener('click', () =>{
                        let nombreActividad = document.getElementById('nombreActividad').value;
                        let grupo = document.getElementById('grupo').value;
                        let responsable = document.getElementById('responsable').value;
                        let estado = document.getElementById('estado').value;
                        let prioridad = document.getElementById('prioridad').value;
                        
                        // let eventData = {
                        //     nombre: nombreActividad,
                        //     grupo: grupo,
                        //     responsable: responsable,
                        //     estado: estado,
                        //     prioridad: prioridad,
                        //     fecha_creacion: {{$fechaCreacion}},
                        //     fecha_inicio: event.start,
                        //     fecha_fin: event.end,
                        // }

                        // fetch('/registrar-evento', {
                        //     method: 'POST',
                        //     headers: {
                        //         'Content-Type': 'application/json',
                        //         'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        //     },
                        //     body: JSON.stringify(eventData)
                        // })
                        // .then(response => response.json())
                        // .then(data => {
                            
                        // })

                        // Agregar evento al calendario
                        calendar.addEvent({
                            title: nombreActividad,
                            start: fechaInicioEvento.value,
                            end: fechaFinEvento.value,
                            grupo: grupo,
                            responsable: responsable,
                            estado: estado,
                            prioridad: prioridad
                        });
                        
                        modalCreateCalendarEvent.style.display = 'none';
                        
                        // Limpiar campos
                        document.getElementById('nombreActividad').value = '';
                        document.getElementById('grupo').value = '';
                        document.getElementById('responsable').value = '';
                        document.getElementById('estado').value = '';
                        document
                    });
                }
            });

            calendar.render();
        });
    </script>
</body>
</html>