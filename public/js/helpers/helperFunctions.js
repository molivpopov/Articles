function sendFields(args) {

    const url = args.url;
    const fields = args.data;
    const successMsg = (typeof args.successMsg !== 'undefined')
        ? args.successMsg
        : false; // must be sweetAlert object
    const elToDisable = (typeof args.elToDisable !== 'undefined')
        ? args.elToDisable
        : false; // must be jquery object
    const processData = (typeof args.processData !== 'undefined')
        ? args.processData
        : true;
    const contentType = (typeof args.contentType !== 'undefined')
        ? args.contentType
        : $.ajax.contentType;
    const afterSuccess = (typeof args.afterSuccess !== 'undefined')
        ? args.afterSuccess
        : false;
    const progress = (typeof args.progress !== 'undefined')
        ? args.progress
        : $.ajax.xhr;
    const method = (typeof args.method !== 'undefined')
        ? args.method
        : 'POST';

    if (elToDisable) {
        elToDisable.prop('disabled', 'true');
    }

    $.ajax({
        url: url,
        type: method,
        data: fields,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        xhr:progress,

        processData: processData,
        contentType: contentType,

        success: function (arg) {

            if (elToDisable) {
                elToDisable.removeAttr('disabled');
            }

            if (successMsg) {
                swal.fire(successMsg)
                    .then(function () {

                        let sw = {};

                        if (((sw = ajxEnd(arg)) || sw == null) && afterSuccess) {
                            afterSuccess(sw);
                        }

                    });
            } else {

                let sw = {};

                if (((sw = ajxEnd(arg)) || sw == null) && afterSuccess) {
                    afterSuccess(sw);
                }

            }

        },

        error: function (arg) {

            if (elToDisable) {
                elToDisable.removeAttr('disabled');
            }

            showErr(arg);

        }
    });

}

function showErr(xhr) {

    if (xhr.status == 422) {

        let err = JSON.parse(xhr.responseText).errors;

        if (!$("[id*='inv-text']").length) {
            swal.fire({
                title: 'VALIDATION_ERR',
                text: err[Object.keys(err)[0]][0],
                icon: "error",
            });

        } else {
            Object.keys(err).forEach(function (x) {
                $('#inv-text-' + x).text(err[x]);
                $('#' + x).addClass('is-invalid');
            });
        }

    } else {

        swal.fire("ERROR! " + xhr.statusText, xhr.responseJSON.message, "error");

    }
}

function ajxEnd(xhr) {

    let sw = Object.keys(xhr)[0];

    if (typeof sw == 'undefined') return null;

    switch (sw) {

        case 'redirect':
            window.location.href = xhr[sw];
            break;
        case 'reload':
            window.location.reload();
            break;
        case 'redirectBack':
            window.history.go(xhr[sw]);
            break;
        case 'OK':
            return;
        default :
            return xhr;
    }
}
