$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('form').on('submit',function(event){
  event.preventDefault();
  uploadImage();
});

function selectFile(){
	$('#imgInp').click();
}

function showModal(event,img_src)
{
	event.stopPropagation();
    var modal = document.getElementById("modal_image");
    modal.style.display = "block";
    $('#imgModal').attr('src',img_src);
}

function hideModal(){
  var modal = document.getElementById("modal_image");
  modal.style.display = "none";
}


function deleteImage(event, div_id, image)
{
	event.stopPropagation();
	let url = $("#"+div_id).children('a').attr('data-url');
	Swal.fire({
      title: "you want to delete this ?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: "cancel",
      confirmButtonText: "yes"
  }).then((result) => {
    if (result.value) {
      if (url != '') {
        $.ajax({
          method: 'DELETE',
          url: url,
          data:{
        	  image: image
          },
          success: function (response) {
              console.log(response);
          },
          error: function (err) {
              console.log(err);
          }
        });
      }
      document.getElementById(div_id).remove();
      let file_length = filesToUpload.length;
      for (var i = 0; i < file_length; ++i) {
        if (filesToUpload[i].id == div_id){
           filesToUpload.splice(i, 1);
        }
      }
      file_length = filesToUpload.length;
      if(file_length == 0){
    	  change = false;
    	  $('a#submit').text("continue");
    	  prompt = false;
      }
      changeDisplayIcon()
    };
  });

}

var filesToUpload = new Array();
function imagesPreview(input, placeToInsertImagePreview) {
  var validExtensions = ['jpg','png','jpeg']; //array of valid extensions
  if (input.files) {
    var filesAmount = input.files.length;
    var k = $(".gallery").children('div:last-child').attr('id');
    if (typeof k == "undefined" ) {k = 0}
    for (g = 0; g < filesAmount; g++)
    {
      k++;
      var file= input.files[g];
      var name = input.files[g].name;
      var fileNameExt = name.substr(name.lastIndexOf('.') + 1);
      var FileSize = input.files[g].size / 1024 / 1024; // in MB
      if (FileSize > 40) {
        Swal.fire(error_image);
        break;
      }
      if ($.inArray(fileNameExt, validExtensions) == -1) {
        input.value = '';
        Swal.fire(format_file+validExtensions.join(', '));
        break;
      }
      filesToUpload.push({
          id: k,
          file: file
      });
      readerFileImages(k,placeToInsertImagePreview,file);
    }
  }
  input.value = '';

}

function readerFileImages(k,placeToInsertImagePreview,file){
  var reader = new FileReader();
  reader.onload = function(event)
  {
      var markup1 = "<div class='col-sm-3' id="+k+"><img src="+event.target.result+" style='height:150px;width:100%;border:1px solid #428bcaa3' onclick='showModal(event, \""+event.target.result+"\")'> <a href='javascript:;' data-url='' onclick='deleteImage(event ,"+k+", null)' class='deleteImage'><p style='text-align: center;padding-top:5px'><em class='fa fa-trash' style='font-size:1.5em'></em> Xoá </p></a></div>";
      $('#'+placeToInsertImagePreview).append(markup1);
      changeDisplayIcon()
  };
  reader.readAsDataURL(file);
}

function uploadImage(){
      let form_data = new FormData();

      for (let i = 0, len = filesToUpload.length; i < len; i++) {
          form_data.append("images[]", filesToUpload[i].file);
      }
      let method = $('input[name="_method"]').val();
      if(typeof method != 'undefined'){
    	  form_data.append('_method', method);
          // console.log(method);
      }
      var action = $("#form_image").attr('action');
      $.ajax({
          method: "POST",
          url: action,
          data: form_data,
          cache: false,
          contentType: false,
          processData: false,
          success: function (res) {
              filesToUpload = [];
              if(res.results.success == true){
            	  if(!$('.modal').hasClass('js-preview')){
						$('.content-wrapper').html(res.view);
					}else {
						$("#modal_preview").modal('hide');
						window.location.href = $(location).attr("href");
					}
              }else{
                  Swal.fire({
                  icon: 'error',
                  title: 'Sever errors',
                  text: 'Something went wrong!',
                  })
              }
          },
          error: function (err) {
        	  console.log(err);
          }
      });
  }

function changeDisplayIcon(){
	let count_image = $('#general').children().length
	if(count_image >= 1){
		$('.center-parent').css('display', 'none');
	}else{
		$('.center-parent').css('display', 'block');
	}
}
