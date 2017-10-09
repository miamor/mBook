var takePicture = document.querySelector("#getBarcode"),
showPicture = document.createElement("img");
Result = document.querySelector("#textbit");
var canvas = document.getElementById("back_picture");
var ctx = canvas.getContext("2d");

JOB.Init();
JOB.SetImageCallback(function (result) {
	if (result.length > 0){
		var tempArray = [];
		for (var i = 0; i < result.length; i++) {
			tempArray.push(result[i].Format+" : "+result[i].Value);
		}
		Result.innerHTML = tempArray.join("<br />");
		$('#barcode').val(result[0].Value);
	} else {
		if (result.length === 0) {
			Result.innerHTML = "Decoding failed.";
			$('#barcode').val('');
		}
	}
});
JOB.PostOrientation = true;
JOB.OrientationCallback = function (result) {
	canvas.width = result.width;
	canvas.height = result.height;
	var data = ctx.getImageData(0, 0, canvas.width, 480);
	for (var i = 0; i < data.data.length; i++) {
		data.data[i] = result.data[i];
	}
	ctx.putImageData(data,0,0);
	canvas.style.visibility = "visible";
	canvas.className = "";
};
JOB.SwitchLocalizationFeedback(true);
JOB.SetLocalizationCallback(function (result) {
	ctx.beginPath();
	ctx.lineWIdth = "2";
	ctx.strokeStyle="red";
	for (var i = 0; i < result.length; i++) {
		ctx.rect(result[i].x,result[i].y,result[i].width,result[i].height); 
	}
	ctx.stroke();
});
if (takePicture && showPicture) {
	takePicture.onchange = function (event) {
		var files = event.target.files;
		if (files && files.length > 0) {
			file = files[0];
			try {
				var URL = window.URL || window.webkitURL;
				showPicture.onload = function (event) {
					Result.innerHTML="";
					JOB.DecodeImage(showPicture);
					URL.revokeObjectURL(showPicture.src);
				};
				showPicture.src = URL.createObjectURL(file);
			}
			catch (e) {
				try {
					var fileReader = new FileReader();
					fileReader.onload = function (event) {
						showPicture.onload = function (event) {
							Result.innerHTML = "";
							JOB.DecodeImage(showPicture);
						};
						showPicture.src = event.target.result;
					};
					fileReader.readAsDataURL(file);
				}
				catch (e) {
					Result.innerHTML = "Neither createObjectURL or FileReader are supported";
				}
			}
		}
	};
}

$(document).ready(function () {
	back_image = new Image();
	back_image.onload = function () {
		canvas.height = canvas.width * (back_image.height / back_image.width);
		/// step 1
		var oc = document.createElement('canvas'),
			octx = oc.getContext('2d');

		oc.width = back_image.width * 0.5;
		oc.height = back_image.height * 0.5;
		octx.drawImage(back_image, 0, 0, oc.width, oc.height);

		/// step 2
		octx.drawImage(oc, 0, 0, oc.width * 0.5, oc.height * 0.5);

		canvas.className = "";
		ctx.drawImage(oc, 0, 0, oc.width * 0.5, oc.height * 0.5,
		0, 0, canvas.width, canvas.height);
	}
	back_image.src = $('#back_image').attr('src');

	$('.book-select').change(function () {
		val = $(this).val();
		var txt = (val > 0) ? $(this).find('option:selected').text() : '';
		$('input[name="title"]').val(txt);
	});
	$('input[name="title"]').keydown(function () {
		$('.book-select').val('').trigger('chosen:updated');
	});

$("#coverIMG").on('change', function () {
	// Get count of selected files
	var countFiles = $(this)[0].files.length;

	var imgPath = $(this)[0].value;
	var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
	var image_holder = $("#cover_picture");
	image_holder.empty();

	if (extn == "png" || extn == "jpg" || extn == "jpeg") {
		if (typeof (FileReader) != "undefined") {
			 //loop for each file selected for uploaded.
			for (var i = 0; i < countFiles; i++) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$("<img />", {
						"width": 300,
						"height": 450,
						"src": e.target.result,
						"class": "thumb-image",
						"id": "cover_image"
					}).appendTo(image_holder);
				}

				image_holder.show();
				reader.readAsDataURL($(this)[0].files[i]);
			}

		} else {
			alert("This browser does not support FileReader.");
		}
	} else {
		console.log("Please select only images");
	}
});
})
