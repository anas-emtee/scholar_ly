<script src="js/vendor/jquery-2.2.4.min.js"></script>
<script src="js/jquery.colorbox.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/jquery.ajaxchimp.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/main.js"></script>
<script>
  var saveItem = function(item, item_type, save_type, user){
    alert(item);
    $.ajax({
        url: "system_user_act.php",
        data: {
            "save": save_type,
            "item_type": item_type,
            "item": item,
            "user": user
        },
        cache: false,
        type: "POST",
        success: function(response) {
          //alert("success");
          document.getElementById("ws"+item).innerHTML = "Saved";
          document.getElementById("ws"+item).removeAttribute("onclick");;
        },
        error: function(xhr) {
          alert("fail");
        }
    });
  }
</script>
