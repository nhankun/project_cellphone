
function loadForm(tag)
{
    $('#edit_tabs li').css('pointer-events','');
    var url = $(tag).data('url');
    if(url != '')
    {
        $.ajax({
            url: $(tag).data('url'),
            method: 'GET',
            success: (res) => {
                let view = $(res).find('.form-edit').children();
                $('.form-edit').html(view);
                $('#edit_tabs .active').css('pointer-events','none');
            },
            error: (err) => {
                Swal.fire({
                    icon: 'error',
                    title: 'Sever errors',
                    text: 'Something went wrong!',
                })
            }
        })
    }
}
