var takePicture = document.querySelector("#find_image"),
showPicture = document.createElement("img");
Result = document.querySelector("#textbit");
var canvas = document.getElementById("img_to_search");
var ctx = canvas.getContext("2d");

JOB.Init();
JOB.SetImageCallback(function (result) {
	if (result.length > 0){
		var tempArray = [];
		for (var i = 0; i < result.length; i++) {
			tempArray.push(result[i].Format+" : "+result[i].Value);
		}
		Result.innerHTML = tempArray.join("<br />");
		$('.s-input').val(result[0].Value);
	} else {
		if (result.length === 0) {
			Result.innerHTML = "Decoding failed.";
			$('.s-input').val('');
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


function loadMore (bookLink) {
	$('#rv_local').load(MAIN_URL+'/book/'+bookLink+' .book-info>.col-lg-3', function () {
		$(this).children('.col-lg-3').removeClass('col-lg-3');
	});
	$('.s-buy').load(MAIN_URL+'/book/'+bookLink+' .book-advanced');
	$.get(MAIN_URL+'/box?mode=search&key='+bookLink+'&temp=withjs', function (data) {
		$('.more-boxes').prepend('<h3>#bookStop</h3>');
		$('.other_boxes').html(data);
	})
}

$(document).ready(function () {
//	console.log(encodeURIComponent('9XQjO47Nv0CxK+6ZIAvaS3oePd7Ux8CuwkEDO3RJCD7MPILCfxJ2BmNCvMGLqEEEbXdWWJ/V9N85ZffznwGcHw=='));
	find_image = new Image();
	find_image.onload = function () {
		canvas.height = canvas.width * (find_image.height / find_image.width);
		/// step 1
		var oc = document.createElement('canvas'),
			octx = oc.getContext('2d');

		oc.width = find_image.width * 0.5;
		oc.height = find_image.height * 0.5;
		octx.drawImage(find_image, 0, 0, oc.width, oc.height);

		/// step 2
		octx.drawImage(oc, 0, 0, oc.width * 0.5, oc.height * 0.5);

		canvas.className = "";
		ctx.drawImage(oc, 0, 0, oc.width * 0.5, oc.height * 0.5,
		0, 0, canvas.width, canvas.height);
	}
	find_image.src = $('#find_image').attr('src');

	$('.s-form').submit(function () {
		$('#result').show().html(loading);
		goToByScroll('result');
		$.ajax({
/*			url: '?do=search&temp=true',
			type: 'post',
			data: 'key='+$('[name="key"]').val(),
*/			url: '?p=feed&temp=true&key='+$('[name="key"]').val(),
			success: function (data) {
				if (data) {
//					data = JSON.parse(data);
//					console.log(data);
					$('#result').html(data);
					var bookLink = $('.bookLink').val();
					loadMore(bookLink);
				}
			}
		})
		return false
	})
})
