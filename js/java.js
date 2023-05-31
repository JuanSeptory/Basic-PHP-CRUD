//live search dengan menggunakan jquery

$(document).ready(function(){

//hilangkan tombol cari
$('#tombolcari').hide();

//event ketika keyword ditulis
$('#keyword').on('keyup', function(){
//menggunakan ajax dengan jquery

//memunculkan gambar loading
$('.loader').show();

		//menggunakan fungsi load
		//cukup memanggil fungsi load
			//$('#container').load('ajax/DaftarPemain.php?keyword=' + $('#keyword').val());
		//});

		$.get('ajax/DaftarPemain.php?keyword=' + $('#keyword').val(), function(data) {

			$('#container').html(data);
			$('.loader').hide();
		});

});

});