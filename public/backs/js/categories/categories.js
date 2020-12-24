$(window).bind('load',function () {
    sortDiv();
});
function addNewProperty() {
    let max = 0;
    let c = $('.general:last').attr('id');
    $('.properties').find('.general').each((ind,val) => {
            if(val.getAttribute('id') > max)
                max = val.getAttribute('id');
        }
    );
    c = max;
    if (typeof c === 'undefined')
    {
        c = 0;
    }
    c++;
    let new_property = `<div class="row general" id="${c}">
                <div class="col-1 text-center">
                    <p><i class="fa fa-plus"></i></p>
                </div>
                <div class="col-5">
                    <input name="properties[${c}][name]" type="text" class="form-control" id="name_${c}">
                </div>
                <div class="col-5">
                    <input name="properties[${c}][value]" type="text" class="form-control" id="value_${c}">
                </div>
                <div class="col-1">
                    <p class="btn btn-danger" onclick="deleteProperty(this,null)"><i class="fa fa-trash-alt"></i></p>
                </div>
            </div>`;

    $(".properties").append(new_property);
}

function sortDiv()
{
    $(".properties").sortable({
        cancel: ":input",
        items: ".general",
        start: function( event, ui ) {

        },
        stop: function( event, ui ) {

        }
    });
}

function deleteProperty(e, id) {
    Swal.fire({
        title: 'Are you sure?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.value) {
            if (id != null) {
                $(e).parents('#'+id).remove();
            } else {
                $(e).parents('.general').remove();
            }
        }
    });
}

