$(document).ready(function () {

    $('#articles-list').click(function (ev) {
        swal.fire({
            text:'tape some tag:',
            input: 'text',
            showCancelButton: true,
        }).then(function (answer){
            let url = baseApiLink + $('#user-place').attr('user') + '/articles';
            if (answer.value){
                url += '?tag='+answer.value;
            }
            console.log(url);
            sendFields({
                url: url,
                data:'',
                method:'GET',
                afterSuccess:function (answer){
                    console.log(answer);
                }
            })
        })
    });

    $('#article-content').click(function (ev) {
        swal.fire({
            text:'изберете номер на статия',
            input: 'text',
            showCancelButton: true,
        }).then(function (answer){
            console.log(answer.value);
            if(answer.value){
                const url = baseApiLink + $('#user-place').attr('user') + '/article?id='+answer.value;
                console.log(url);
                sendFields({
                    url: url,
                    data:'',
                    method:'GET',
                    afterSuccess:function (answer){
                        console.log(answer);
                    }
                })
            }
        });

    });

    $('#article-comment').click(function (ev) {
        swal.fire({
            title:'comment - id, text',
            html:'<input id="swal-input1" class="swal2-input"><input id="swal-input2" class="swal2-input">',
            focusConfirm: false,
            showCancelButton: true,
            preConfirm: () => {
                return [
                    document.getElementById('swal-input1').value,
                    document.getElementById('swal-input2').value
                ]
            }
        }).then(function (answer){
            console.log(answer.value);
            if(answer.value){
                const url = baseApiLink +
                    $('#user-place').attr('user') +
                    '/comment?article_id='+answer.value[0] +
                    '&comment='+answer.value[1]
                ;
                console.log(url);
                sendFields({
                    url: url,
                    data:'',
                    method:'PUT',
                    afterSuccess:function (answer){
                        console.log(answer);
                    }
                })
            }
        });

    });

});

