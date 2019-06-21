$(document).ready(function() {
    var adjustSidebar = function() {
        $(".sidebar").slimScroll({
            height: document.documentElement.clientHeight - $(".navbar").outerHeight()
        });
    };

    adjustSidebar();

    $(window).resize(function() {
        adjustSidebar();
    });

    $(".sideMenuToggler").on("click", function() {
        $(".wrapper").toggleClass("active");
    });
});

$(".toggle-password").click(function() {

    $(this).toggleClass("fas fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
      input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
  });

  $('#detailsModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var title = button.data('heading'); 
    var details = button.data('details'); 
    var data = {"details" : details};
    jQuery.ajax({
      url: '/will/helper/details.php',
      type: 'POST',
      data: data,
      success: function(data){
          modal.find('.modal-title').text(title);
          modal.find('.modal-body').html(data);         
      },
      error: function(){
          alert("Sorry!, Something is wrong with the child options. ")
      },
    });
    var modal = $(this);
});


  function stateFunction(val) {
      if(val == "alive"){
        document.getElementById("state-form").style.display = "none";
        document.getElementById("oal").style.display = "block";
        document.getElementById("login-form").style.height = "68%";
        //alert("The input value has changed. The new value is: " + val);
      }else{
        document.getElementById("owners").style.display = "block";
      }
      
  }

  function ownersFunction(val2) {
    if(val2 != ""){
      url = "/will/tunde will/login.php?friend=" + val2;
      location.replace(url);
      document.getElementById("state-form").style.display = "none";
    }
  }

  function dollarFunction(val3) {
    $("#value").change(function(){
      var amount = jQuery('#value').val();
      if(val3 != ""){
        var spif = val3.split(","); 
        var c_rate = spif[1];
        var dollar = amount * c_rate;
        $('#dollars').val(dollar);
      }
    });
  }

  function loginFunction() {
    jQuery('#login-errors').html("");
    var uname = jQuery('#username').val();
    var pass = jQuery('#password').val();
    var error = '';

    if(uname == '' || pass == ''){
      error += '<p class="text-center alert alert-success">All Fiels Are Required.</p>';
      jQuery('#login-errors').html(error);
      return;
    }
    else if(pass.length < 6){
      error += '<p class="text-center alert alert-success">Password to small.</p>';
      jQuery('#login-errors').html(error);
      return;
    }else{
      var data = {"username" : uname, "password" : pass};
      jQuery.ajax({
          url: '/will/helper/submit.php',
          type: 'POST',
          data: data,
          success: function(data){
            jQuery('#login-errors').html(data);              
          },
          error: function(){
            alert("Sorry!, Something is wrong with the child options. ")
          },
      });
      $("#oal")[0].reset();
      }    
    } 

    function friendsLoginFunction() {
      var fArray = [];
      jQuery('#login-errors').html("");
      var uname2 = jQuery('#friend_username').val();
      var pass2 = jQuery('#friend_password').val();
      var error2 = '';

      if(uname2 == '' || pass2 == ''){
        error2 += '<p class="text-center alert alert-success">All Fiels Are Required.</p>';
        jQuery('#login-errors').html(error2);
        return;
      }
      else if(pass2.length < 6){
        error2 += '<p class="text-center alert alert-success">Password to small.</p>';
        jQuery('#login-errors').html(error2);
        return;
      }else{
          var nums = document.getElementById("flist");
          var listItem = nums.getElementsByTagName("li");

          for(var i = 1; i <= listItem.length; i++){
            var f = $(".lit" +i).attr('id');
            var cy = f.split("-"); 
            var st = cy[1];
            fArray.push(parseInt(st));
          }
          var data = {"username" : uname2, "password" : pass2};
          jQuery.ajax({
              url: '/will/helper/submit.php',
              type: 'POST',
              data: data,
              success: function(data){
                var egg = data.split("-"); 
                var fruid = egg[0];
                var muid = egg[1];
                if(fArray.includes(parseInt(fruid))){
                  $("#customlist-" +fruid).removeClass("text-info");
                  $("#customlist-" +fruid).addClass("text-danger");
                  $("#customicon" +fruid).attr('class', 'fas fa-check');
                  var nivi = $('.fa-check').length;
                  if(nivi == fArray.length){
                    // var url9 = "/will/tunde will/login.php?muids=" + muid+ "&fruid=" + fruid;
                    // location.replace(url);
                    document.getElementById("friend-form").style.display = "none";
                    document.getElementById("proceed").style.display = "block";
                    $('#fruid').val("F");
                  }
                }else{
                  jQuery('#login-errors').html(data);
                }
                              
              },
              error: function(){
                alert("Sorry!, Something is wrong with the child options. ")
              },
          });
          $("#friend")[0].reset();
      }    
    } 

    function deleteFunction(dal){
      var data = {"parameters" : dal}
      jQuery.ajax({
        url: '/will/helper/delete.php',
        type: 'POST',
        data: data,
        success: function(){
            location.reload();         
        },
        error: function(){
            alert("Sorry!, Something is wrong with the child options. ")
        },
      });
    }