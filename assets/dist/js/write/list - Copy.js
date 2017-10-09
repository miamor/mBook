function filterData () {
	var filtObj = new Object();
	fields = $('#formFilter').serializeArray();
	$.each(fields, function (i, oneField) {
		filtObj[oneField['name']] = oneField['value'];
	});
    return filtObj;
}

var table = $('table#book-list').DataTable({
	"ajax": {
		"url": "?do=filter",
		"type": "POST",
		"data": function (d) {
			para = filterData();
			console.log(para);
			return para;
		}
	},
	"ordering": false,
//	"order": [[0, 'asc']], // order by time asc
	"pageLength": 24,
	"lengthMenu": [24, 60, 120, 240],
	"fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
		$(nRow).attr("class", "col-lg-3");
		return nRow;
	},
	"aoColumns": [
		{ "sClass": "hidden" },
		{ "sClass": "", "sValign": "top" }
	],
	"initComplete": function (settings, json) {
	}
});


$(document).ready(function () {
	$('#formFilter').submit(function () {
/*		$.ajax({
			url: "?do=filter",
			type: "POST",
			data: $('#formFilter').serialize(),
			success: function (data) {
				console.log(data);
			}
		});
*/		table.ajax.reload(null, false).draw();
		return false
	})
})