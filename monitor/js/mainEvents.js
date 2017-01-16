/*
 * js que maneja todos las conexiones ajaxs de cada evento
 */

//

//para iniciar la tabla bien
function dataTable_init() {
    $('.dataTables-example').DataTable({
        pageLength: 10,
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            {extend: 'copy'},
            {extend: 'csv'},
            {extend: 'excel', title: 'Asistentes'},
            {extend: 'pdf', title: 'Asistentess'},

            {extend: 'print',
                customize: function (win) {
                    $(win.document.body).addClass('white-bg');
                    $(win.document.body).css('font-size', '10px');

                    $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                }
            }
        ]
    });
}




$(document).ready(function(){
//    $(".evento").click(function(){
//        var id= $(this).attr("id").split("_")[1];
//        $.ajax({
//            url:'inc/leads.php',
//            method:'POST',
//            data:{"id": id},            
//            success:function(response){
//                $("#tabla-leads").text("");
//                response = JSON.parse(response);
//                console.log(response.status);
//                leads = response.leads;
//                $(leads).each(function(indice){
//                    console.log(this);
//                    var lead= $("#fila-leads").clone();
//                    lead.removeAttr("id");
//                    lead.find(".nombre").text(this.nombre);
//                    lead.find(".apellidos").text(this.apellidos);
//                    lead.find(".email").text(this.email);
//                    lead.find(".dni").text(this.dni);
//                    lead.find(".empresa").text(this.empresa);
//                    lead.find(".telefono").text(this.telefono);
//                    
//                    lead.removeClass("hidden").appendTo("#tabla-leads");
//                })
//            },
//            error:function(response){
//                response = JSON.parse(response);
//                console.log(response.status);
//            }
//        });
//    });
            
    
    dataTable_init();
});




