var Book = function () {
    
    var booksTable;

    var getFilterParams = function () {
        return {
            category : $(':input[name="category"]', '#book-table').val(),
            name    : $(':input[name="name-user"]', '#book-table').val(),
            show_deleted : $(':input[name="show_deleted"]', '#book-table').val(),
        };
    };
     
    var deleteBook = function () {
        var id = $(this).data('id');

        bootbox.confirm(t('Вы действительно хотите выполнить эту действию?'), function (confirm) {
            if (confirm) {
                $.ajax({
                    url: '/book/ajax?command=delete',
                    type: 'POST',
                    dataType: 'json',
                    data: { id: id }
                }).done(function (result) {
                    if (result.code == 1) {
                        toastr.success(t('Операция успешна завершина'));
                        booksTable.ajax.reload();
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
            
            booksTable = $('#book-table').DataTable({
                pageLength: 25,
                autoWidth: false,
                columns: [
                    { data: 'name_book' },
                    { data: 'category_ru' },
                    { data: 'author' },
                    { data: null, defaultContent: '', orderable: false }
                ],
                order: [[ 1, 'asc' ]],
                orderClasses: false,
                orderCellsTop: true,
                searching: false,
                processing: true,
                serverSide: true,
                ajax: function(data, callback, settings) {
                    $.ajax({
                        url: '/book/ajax?command=list',
                        type: 'POST',
                        dataType: 'json',
                        data: $.extend(data, getFilterParams())
                    }).done(function (result) {
                        $('#book-table').tableHeadFixer({ head: false, left: 0 });
                        callback(result);
                    });
                },
                rowCallback: function(row, data, index) {
                    var btn = $('<button>').addClass('btn btn-xs'), editBtn, deleteBtn;

                    editBtn = "<a href='update?id="+ data.id  +"' class='btn btn-xs btn-info' title='Редактировать'><i class='fa fa-fw fa-pencil'></i></a>";
                    

                    deleteBtn = btn.clone().attr('title', t('Запретить доступ')).addClass('btn-danger disabled');
                    if (userCan('deleteBook')) {
                        deleteBtn
                            .attr('data-id', data.id)
                            .removeClass('disabled')
                            .addClass('delete');
                    }

                    $('td:last', row).addClass('text-center')
                        .empty()
                        .append(editBtn)
                        .append('&nbsp;')
                        .append(deleteBtn);
                        
                        // Mark deleted row
                        if (data.status == 0) {
                            $(row).addClass('danger');
                             deleteBtn.append($('<i>').addClass('fa fa-fw fa-unlock-alt'));
                        }
                        else
                            deleteBtn.append($('<i>').addClass('fa fa-fw fa-unlock'));
                }
            });
            
            

            $('#book-table')
                .on('change', '.filter', function () {
                    booksTable.ajax.reload();
                })
                .on('click', '.delete', deleteBook);
        }
    };
}();

$(document).ready(function() {
    Book.init();
});
