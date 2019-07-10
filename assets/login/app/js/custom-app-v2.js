$(window).on('scroll', function(){
	var top = $(window).scrollTop();
	if (top > 80) {
		$('#main-nav').addClass('navbar-default');
	} else {
		$('#main-nav').removeClass('navbar-default');
	}

	// jika scroll lebih dari 800px
	if (top > 800) {
		$('#product-1 .img-responsive').css('transform', 'translateY(0)');
		$('#product-1 .img-responsive').css('opacity', 1);
		$('#product-1 h2').css('transform', 'translateY(0)');
		$('#product-1 h2').css('opacity', 1);
		$('#product-1 p').css('transform', 'translateY(0)');
		$('#product-1 p').css('opacity', 1);
		$('#product-1 .line').css('width', '160px');
	}

	// jika scroll lebih dari 1300px
	if (top > 1300) {
		$('#product-2 .img-responsive').css('transform', 'translateY(0)');
		$('#product-2 .img-responsive').css('opacity', 1);
		$('#product-2 h2').css('transform', 'translateY(0)');
		$('#product-2 h2').css('opacity', 1);
		$('#product-2 p').css('transform', 'translateY(0)');
		$('#product-2 p').css('opacity', 1);
		$('#product-2 .line').css('width', '160px');
	}
});

$(document).ready(function(){
  // Add smooth scrolling to all links
  $("a").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){

        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });


	/*------------------------------------------------------
	* -- Form Validation  --
	*------------------------------------------------------*/

	$('button.btn-signin').prop("disabled",true);
	$('button#daftar-mitra').prop("disabled",false);
	$('button#mitra-login').prop("disabled",false);
	var username  = $("#username").val(),
		email  = $("#email").val(),
		password = $("#password").val(),
		konfirmasi = $("#konfirmasi").val(),
		telp = $("#telp").val(),
		fax = $("#fax").val(),
		alamat = $("#alamat").val(),
		paket = $("#paket").val();

	$("#validate").click(function(e){

		if(password !== konfirmasi){
			$('#form-error').append('<p id="info-konfirmasi">Password Konfirmasi Tidak Sama </p>')
		}
	});

	  var EmailFormat = /^[ ]*([^@\s]+)@((?:[-a-z0-9]+\.)+[a-z]{2,})[ ]*$/i;
      $('input#username').bind('input propertychange', function() {
        if (EmailFormat.test($(this).val())){
           $(this).css({ 'border':'1px solid green'});
           $('button.btn-signin').prop("disabled",false);
		   $('#info-email').remove();
         } else {
           $(this).css({ 'border':'2px solid red'});
           $('button.btn-signin').prop("disabled",true);
		   $('#info-email').remove();
		   $('#form-error').append('<p id="info-email">Format email tidak valid! </p>')
         }
       });

	   $('input#email').bind('input propertychange', function() {
		    var email = $(this).val();
			if (EmailFormat.test($(this).val())){
			   $(this).css({ 'border':'1px solid green'});
			   $('button.btn-signin').prop("disabled",false);

			   if((email.indexOf('google') !== -1) || (email.indexOf('yahoo') !== -1) || (email.indexOf('bing') !== -1)){
				    $(this).css({ 'border':'2px solid red'});
					$('#info-email').remove();
					$('#form-error').append('<p id="info-email">Harus menggunakan email perusahaan! </p>');
						$('button.btn-signin').prop("disabled",true);
			   } else {
				   $('#info-email').remove();
				   $(this).css({ 'border':'1px solid green'});
				   	$('button.btn-signin').prop("disabled",false);
			   }

			 } else {
			   $(this).css({ 'border':'2px solid red'});
			   $('button.btn-signin').prop("disabled",true);
			 }
       });

	   $('input#konfirmasi').bind('input propertychange', function(){
			var password = $("#password").val();
			if(password !== $(this).val()){
				$('#info-konfirmasi').remove();
				$('#form-error').append('<p id="info-konfirmasi">Password Konfirmasi Tidak Sama </p>');
			} else {
				$('#info-konfirmasi').remove();
			}
	   });
        if(paket === null){
			$('button.btn-signin').prop("disabled",true);
		}
		/*------------------------------------------------------
		* -- Redirect halaman registrasi mitra  --
		*------------------------------------------------------*/

	   $('#daftar-mitra').click(function(e){
		   e.preventDefault();
		   window.location.href = base_url+"mitra/registrasi";
	   });


});
