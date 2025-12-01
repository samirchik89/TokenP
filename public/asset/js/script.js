function myFunction() {
	var copyText = document.getElementById('address');
	  copyText.select();
  	document.execCommand("copy");
  	alert("Copied the text: " + copyText.value);
}


/*
$(".regCheckBtn").click(function(){
  $("#regFrom").removeClass('d-none').addClass("d-block");

  $("#regCheck").addClass('d-none').removeClass("d-block");

});*/


/*$('.sto-list').slick({
		infinite: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 1500,
        arrows: true,
        dots: false,
        pauseOnHover: false,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    infinite: true,
                    arrows: true,
                    // dots: true
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    arrows: true,
                    // dots: true
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    arrows: true,
                    autoplaySpeed: 1000,
                    // speed: 2500
                }
            },
            {
                breakpoint: 450,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplaySpeed: 1000,
                    infinite: true,
                    arrows: true,
                    // speed: 1500
                }
            },
            {
                breakpoint: 400,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplaySpeed: 1000,
                    infinite: true,
                    arrows: true,

                }
            }

        ]
    });*/

    function myFunction() {
        var copyText = document.getElementById("myInput");
        copyText.select();
        document.execCommand("copy");
        alert("Copied the text: " + copyText.value);
    }   
    	
    
	  var loadFile = function(event) {
	    var proof_identity = document.getElementById('proof_identity');
	    proof_identity.src = URL.createObjectURL(event.target.files[0]);
	  };
	
      var loadFile_1 = function(event) {
        var resident_address = document.getElementById('resident_address');
        resident_address.src = URL.createObjectURL(event.target.files[0]);
      };
    
      var loadFile_2 = function(event) {
        var human_verify = document.getElementById('human_verify');
        human_verify.src = URL.createObjectURL(event.target.files[0]);
      };
    
      var loadFile_3 = function(event) {
        var add_team = document.getElementById('add_team');
        add_team.src = URL.createObjectURL(event.target.files[0]);
      };
   
        function copyToClipboard(element) {
          var $temp = $("<input>");
          $("body").append($temp);
          $temp.val($(element).text()).select();
          document.execCommand("copy");
          $temp.remove();
        }
   
    $(document).ready(function() {

        $('.dataTable').DataTable({
            responsive: true,
            fixedHeader: true
        });

        $("#company-investor-submit").click(function() {
            $(".company-investor-verification").hide();
            $("#cperson").show();
            $("#companyinvestor-submit").click(function(){
                $("#cperson").hide();
                $("#company-investor-verification").show();
            });
        });
    
        $('.edit_btn input').click(function(){
            $('.edit-profile').slideToggle();
        });
    });