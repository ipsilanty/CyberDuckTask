$(document).ready(function () {
    /* *** Sidebar Nav url *** */
    var pathArray = window.location.pathname.split( '/' );
    var segment_1 = pathArray[1];

    $("ul.sidebar-menu li a").each(function() {
        var $this = $(this);
        var url = $this.data("url");
        if(url == segment_1) {
            $(this).parent().removeClass().addClass("active");
        } else if(segment_1 == "dashboard") {
            $("#default").addClass("active");
        }
    });
});

/* *** Ask user befeore delete company *** */
$(".delete_company").on("submit", function(){
    return confirm("Do you want to delete this item?");
});

/* *** Ask user befeore delete employee *** */
$(".delete_employee").on("submit", function(){
    return confirm("Do you want to delete this item?");
});
  
$(function () {
    /* *** Set dataTable for employees *** */
    $('#employees').DataTable({
        'paging'      : false,
        'lengthChange': false,
        'searching'   : false,
        'info'        : false,
        'autoWidth'   : false,
        language: {
            emptyTable: "No employees found!"
        },
        order: [],
        columnDefs: [
            { orderable: false, targets: [1,2,3,4] }
        ]
    });

    /* *** Set dataTable for companies *** */
    $('#companies').DataTable({
        'paging'      : false,
        'lengthChange': false,
        'searching'   : false,
        'info'        : false,
        'autoWidth'   : false,
        language: {
            emptyTable: "No companies found!"
        },
        order: [],
        columnDefs: [
            { orderable: false, targets: [1,2,4] }
        ]
    });
});