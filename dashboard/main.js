$(document).ready(function(){
    tablabecarios = $("#tablabecarios").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"  
       }],
        
        //Para cambiar el lenguaje a español
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });
    
$("#btnNuevo").click(function(){
    $("#formbecarios").trigger("reset");
    $(".modal-header").css("background-color", "#28a745");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nueva Persona");            
    $("#modalCRUD").modal("show");        
    id=null;
    opcion = 1; //alta
});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    Becario = fila.find('td:eq(1)').text();
    Actividad = fila.find('td:eq(2)').text();
    Estado = fila.find('td:eq(3)').text();
    Fecha = fila.find('td:eq(4)').text();
    Hora_de_entrada = fila.find('td:eq(5)').text();
    Hora_de_salida = fila.find('td:eq(6)').text();
    
    $("#Becario").val(Becario);
    $("#Actividad").val(Actividad);
    $("#Estado").val(Estado);
    $("#Fecha").val(Fecha);
    $("#Hora_de_entrada").val(Hora_de_entrada);
    $("#Hora_de_salida").val(Hora_de_salida);
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Persona");            
    $("#modalCRUD").modal("show");  
    
});

//botón BORRAR
$(document).on("click", ".btnBorrar", function(){    
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+id+"?");
    if(respuesta){
        $.ajax({
            url: "bd/crud.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function(){
                tablabecarios.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});
    
$("#formbecarios").submit(function(e){
    e.preventDefault();    
    Becario = $.trim($("#Becario").val());
    Actividad = $.trim($("#Actividad").val());
    Estado = $.trim($("#Estado").val()); 
    Fecha = $.trim($("#Fecha").val());
    Hora_de_entrada = $.trim($("#Hora_de_entrada").val());
    Hora_de_salida = $.trim($("#Hora_de_salida").val()); 
    $.ajax({
        url: "bd/crud.php",
        type: "POST",
        dataType: "json",
        data: {Becario:Becario, Actividad:Actividad, Estado:Estado, Fecha:Fecha, Hora_de_entrada:Hora_de_entrada, Hora_de_salida:Hora_de_salida, id:id, opcion:opcion},
        success: function(data){  
            console.log(data);
            id = data[0].id;            
            Becario = data[0].Becario;
            Actividad = data[0].Actividad;
            Estado = data[0].Estado;
            Fecha = data[0].Fecha;
            Hora_de_entrada = data[0].Hora_de_entrada;
            Hora_de_salida = data[0].Hora_de_salida;
            if(opcion == 1){tablabecarios.row.add([id,Becario, Actividad, Estado, Fecha, Hora_de_entrada, Hora_de_salida]).draw();}
            else{tablabecarios.row(fila).data([id,Becario, Actividad, Estado, Fecha, Hora_de_entrada, Hora_de_salida]).draw();}            
        }        
    });
    $("#modalCRUD").modal("hide");    
    
});    
    
});