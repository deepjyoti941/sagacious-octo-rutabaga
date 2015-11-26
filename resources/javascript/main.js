(function () {
  'use strict';

  var counter = 1;
  $('#addReportsRow').click(function () {
    $('#reportTable').append('<tr><td><input type="text" name="test[' + counter + '][name]" value="" required class="form-control"/></td><td><input type="number" step="any" name="test[' + counter + '][measurement]" value="" required class="form-control"/></td><td><a class="deleteLink btn btn-default"><i class="fa fa-times"></i> Remove</a></td></tr>');
    counter = counter + 1;
  });

  $("#reportTable").on("click", ".deleteLink", function() {
    var tr = $(this).closest('tr');
    console.log(tr);
    tr.css("background-color","rgb(240, 125, 93)");
    tr.fadeOut("slow", function(){
      tr.remove();
    });
  });

  $("#username").keyup(function(e) {
    e.preventDefault();
    var $this = $(this),
      keyword = $this.val(),
      user_type = $(".user_type").val();
    if(keyword.length > 3) {
      $.ajax({
        type: "POST",
        url: "http://localhost/pathology-lab/list-usernames",
        data: {
          keyword: keyword,
          user_type: user_type
        },
        dataType: "json",
        success: function (data) {
          if (data.length > 0) {
            $('#dropdownUsername').empty();
            $this.attr("data-toggle", "dropdown");
            $('#dropdownUsername').dropdown('toggle');
          } else if(data.length == 0){
            $this.attr("data-toggle", "");
          }
          //console.log(data);
          $.each(data, function (key,value) {
            if (data.length >= 0)
              $('#dropdownUsername').append('<li class="list-group-item suggestionList" ><a>' + value['username'] + '</a></li>');
          });
        }
      });
    }
  });

  $('ul.usernameList').on('click', 'li a', function () {
    $('#username').val($(this).text());
  });

}());
