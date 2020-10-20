'use strict';
$(document).ready(function () {

  $('#example1').DataTable({
        responsive: true,
		language: {
			"sEmptyTable":     "هیچ داده ای در جدول وجود ندارد",
			"sInfo":           "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
			"sInfoEmpty":      "نمایش 0 تا 0 از 0 رکورد",
			"sInfoFiltered":   "(فیلتر شده از _MAX_ رکورد)",
			"sInfoPostFix":    "",
			"sInfoThousands":  ",",
			"sLengthMenu":     "نمایش _MENU_ رکورد",
			"sLoadingRecords": "در حال بارگزاری...",
			"sProcessing":     "در حال پردازش...",
			"sSearch":         "جستجو:",
			"sZeroRecords":    "رکوردی با این مشخصات پیدا نشد",
			"oPaginate": {
				"sFirst":    "ابتدا",
				"sLast":     "انتها",
				"sNext":     "بعدی",
				"sPrevious": "قبلی"
			},
			"oAria": {
				"sSortAscending":  ": فعال سازی نمایش به صورت صعودی",
				"sSortDescending": ": فعال سازی نمایش به صورت نزولی"
			}
		}
    });

 var table = $("#music-table").DataTable({
     responsive: true,
     language: {
         sEmptyTable: "هیچ داده ای در جدول وجود ندارد",
         sInfo: "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
         sInfoEmpty: "نمایش 0 تا 0 از 0 رکورد",
         sInfoFiltered: "(فیلتر شده از _MAX_ رکورد)",
         sInfoPostFix: "",
         sInfoThousands: ",",
         sLengthMenu: "نمایش _MENU_ رکورد",
         sLoadingRecords: "در حال بارگزاری...",
         sProcessing: "در حال پردازش...",
         sSearch: "جستجو:",
         sZeroRecords: "رکوردی با این مشخصات پیدا نشد",
         oPaginate: {
             sFirst: "ابتدا",
             sLast: "انتها",
             sNext: "بعدی",
             sPrevious: "قبلی"
         },
         oAria: {
             sSortAscending: ": فعال سازی نمایش به صورت صعودی",
             sSortDescending: ": فعال سازی نمایش به صورت نزولی"
         }
     }
 });

	$('#example2').DataTable({
        "scrollY": "400px",
        "scrollCollapse": true,
		"paging": false,
		"language": {
			"sEmptyTable":     "هیچ داده ای در جدول وجود ندارد",
			"sInfo":           "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
			"sInfoEmpty":      "نمایش 0 تا 0 از 0 رکورد",
			"sInfoFiltered":   "(فیلتر شده از _MAX_ رکورد)",
			"sInfoPostFix":    "",
			"sInfoThousands":  ",",
			"sLengthMenu":     "نمایش _MENU_ رکورد",
			"sLoadingRecords": "در حال بارگزاری...",
			"sProcessing":     "در حال پردازش...",
			"sSearch":         "جستجو:",
			"sZeroRecords":    "رکوردی با این مشخصات پیدا نشد",
			"oPaginate": {
				"sFirst":    "ابتدا",
				"sLast":     "انتها",
				"sNext":     "بعدی",
				"sPrevious": "قبلی"
			},
			"oAria": {
				"sSortAscending":  ": فعال سازی نمایش به صورت صعودی",
				"sSortDescending": ": فعال سازی نمایش به صورت نزولی"
			}
		}
	});
	
	$("#music-table thead tr")
        .clone(true)
        .appendTo("#music-table thead");
    $("#music-table thead tr:eq(1) th").each(function(i) {
        var title = $(this).text();
        if (i != 0 && i !== 3 && i !== 5  && i !== 7 && i !== 8) {
            $(this).html(
                '<input type="text" placeholder="Search ' + title + '" />'
            );
        }

        $("input", this).on("keyup change", function() {
            if (table.column(i).search() !== this.value) {
                table
                    .column(i)
                    .search(this.value)
                    .draw();
            }
        });
    });
});