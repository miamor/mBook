var table = $('table#r_comments').DataTable({
	"ajax": '?do=getComments',
	"ordering": false,
//	"order": [[0, 'asc']], // order by time asc
	"fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
		$(nRow).attr("id", aData[1]);
		return nRow;
	},
	"aoColumns": [
		{ "sClass": "hidden" },
		{ "sClass": "hidden" },
		{ "sClass": "one-comt", "sValign": "top" }
	],
	"initComplete": function (settings, json) {
//		console.log(json.data);
		if (json.data.length > 0) {
			$('.r-cmts').show();
			var p = window.location.href.split('#')[1];
			if (p) {
				table.row(Number(p)-1).scrollTo(false);
			}
			setInterval(function () {
				table.ajax.reload(function (json) {
					// do something?
				}, false);
			}, 100000);
		} else $('.r-cmts').hide();
	}
});

$(document).ready(function () {
	rate(".ratings-form");
})
