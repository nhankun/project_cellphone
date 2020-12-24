function validationFormatImage(input)
{
    let valid_extensions = ['jpg','png','jpeg']; //array of valid extensions
    if (input.files) {
        let file_length = input.files.length;
        for (let g = 0; g < file_length; g++)
        {
            let file = input.files[g];
            let name = input.files[g].name;
            let file_name_ext = name.substr(name.lastIndexOf('.') + 1);
            let file_size = input.files[g].size / 1024 / 1024; // in MB
            if (file_size > 40) {
                Swal.fire(error_image);
                input.value = '';
                return false;
            }
            if ($.inArray(file_name_ext, valid_extensions) == -1) {
                input.value = '';
                Swal.fire('image_file' + valid_extensions.join(', '));
                return false;
            }
        }
    }
    return true;
}
function readerFileImages(input){
    let validation = validationFormatImage(input);
    if(validation){
        let reader = new FileReader();
        let file = input.files[0];
        let makeup;
        reader.onload = function(event)
        {
            makeup = "<img class='profile-user-img img-fluid img-circle' src='"+event.target.result+"' alt='User profile picture' style='width: 80px;height: 80px;'>";
            $("label[for='icon']").html('');
            $("label[for='icon']").append(makeup)
        };
        reader.readAsDataURL(file);
    }
}
