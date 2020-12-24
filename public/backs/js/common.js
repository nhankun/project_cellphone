
var common = (function () {
    var ajaxC = function (that, target, verb, template, errorAjax) {
        $.ajax({
            url: target,
            type: verb
        })
            .done(function () {
                doneC(that, template)
            })
            .fail(function () {
                    failC(errorAjax)
                }
            )
    }
    var failC = function (errorAjax) {
        swal.fire({
            title: errorAjax,
            type: 'warning'
        })
    }

    var doneC = function (that, template) {
        Swal.fire({
            type: 'success',
            title: 'Success',
            showConfirmButton: false,
            timer: 3000
        }).then((result)=>{
            $(that).parent().html(template)
        })
    }

    var approved = function (that, target, verb, template, errorAjax) {
        swal.fire({
            title: "Are you sure?",
            type: 'warning',
            text: "You won't be able to revert this!",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: "Cancel",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.value) {
                ajaxC(that, target, verb, template, errorAjax)
            }
        })
    };

    var cancel = function (that, id, url_cancel) {
        swal.fire({
            title: "Are you sure?",
            type: 'warning',
            text: "You won't be able to revert this!",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: "Cancel",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    method: "POST",
                    url: url_cancel.replace("category",id),
                    success: function (response) {
                        if(response.success == true){
                            Swal.fire({
                                type: 'success',
                                title: 'cancel success',
                                showConfirmButton: false,
                                timer: 3000
                            }).then((result)=>{
                                $(that).parent().html(`<button class="mb-2 mr-2 btn btn-danger" onclick="approved(this,${id})"><i class="fa fa-ban"></i>`)
                            })
                        }else {
                            Swal.fire({
                                type: 'error',
                                title: 'cancel fails',
                                showConfirmButton: false,
                                timer: 3000
                            })
                        }
                    },
                    error: function (err) {
                        console.log(err);
                    }
                });
            }
        })
    };

    return {
        approved: approved,
        cancel: cancel
    }
})();
