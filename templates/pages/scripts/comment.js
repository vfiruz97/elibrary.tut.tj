var User = function () {
    
    var commentsTable;

    var getFilterParams = function () {
        return {
            name    : $(':input[name="name-user"]', '#comments-table').val(),
        };
    };
  
 
    var accessComment = function () {
        var id = $(this).data('id');

        bootbox.confirm(t('Вы действительно хотите выполнить эту действию?'), function (confirm) {
            if (confirm) {
                $.ajax({
                    url: '/comment/ajax?command=access',
                    type: 'POST',
                    dataType: 'json',
                    data: { id: id }
                }).done(function (result) {
                    if (result.code == 1) {
                        toastr.success(t('Операция успешна завершина'));
                        commentsTable.ajax.reload();
                    } else {
                        var message = result.message ? result.message : t('Невозможно завершить операцию');
                        toastr.error(message);
                    }
                });
            }
        });
    };
    var deleteComment = function () {
        var id = $(this).data('id');

        bootbox.confirm(t('Вы действительно хотите выполнить эту действию?'), function (confirm) {
            if (confirm) {
                $.ajax({
                    url: '/comment/ajax?command=delete',
                    type: 'POST',
                    dataType: 'json',
                    data: { id: id }
                }).done(function (result) {
                    if (result.code == 1) {
                        toastr.success(t('Операция успешна завершина'));
                        commentsTable.ajax.reload();
                    } else {
                        var message = result.message ? result.message : t('Невозможно завершить операцию');
                        toastr.error(message);
                    }
                });
            }
        });
    };
    
    return {
        init: function () {
            if (!jQuery().DataTable) {
                return;
            }
            
            commentsTable = $('#comments-table').DataTable({
                pageLength: 25,
                autoWidth: false,
                columns: [
                    { data: 'username' },
                    { data: 'comment' },
                    { data: null, defaultContent: '', orderable: false }
                ],
                order: [[ 0, 'asc' ]],
                orderClasses: false,
                orderCellsTop: true,
                searching: false,
                processing: true,
                serverSide: true,
                ajax: function(data, callback, settings) {
                    $.ajax({
                        url: '/comment/ajax?command=list',
                        type: 'POST',
                        dataType: 'json',
                        data: $.extend(data, getFilterParams())
                    }).done(function (result) {
                        $('#comments-table').tableHeadFixer({ head: false, left: 0 });
                        callback(result);
                    });
                },
                rowCallback: function(row, data, index) {
                    var btn = $('<button>').addClass('btn btn-xs'), accessBtn, deleteBtn;
                    
                    accessBtn = btn.clone().attr('title', t('Дать доступ')).addClass('btn-success disabled').append($('<i>').addClass('fa fa-fw fa-check'));
                    if (userCan('deleteComment')) {
                        accessBtn
                            .attr('data-id', data.id)
                            .removeClass('disabled')
                            .addClass('access');
                    }

           

                    deleteBtn = btn.clone().attr('title', t('Удалить')).addClass('btn-danger disabled').append($('<i>').addClass('fa fa-fw fa-trash-o'));
                    if (userCan('deleteComment')) {
                        deleteBtn
                            .attr('data-id', data.id)
                            .removeClass('disabled')
                            .addClass('delete');
                    }

                    $('td:last', row).addClass('text-center')
                        .empty()
                        .append(accessBtn)
                        .append('&nbsp;')
                        .append(deleteBtn);
                        
                }
            });
            
           

            $('#comments-table')
                .on('change', '.filter', function () {
                    commentsTable.ajax.reload();
                })
                .on('click', '.access', accessComment)
                .on('click', '.delete', deleteComment);
                
        }
    };
}();

$(document).ready(function() {
    User.init();
});
