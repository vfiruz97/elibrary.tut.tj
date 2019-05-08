var Silabus = function () {
    
    var silabussTable;

    var getFilterParams = function () {
        return {
            name    : $(':input[name="name"]', '#silabus-table').val(),
            show_deleted : $(':input[name="show_deleted"]', '#silabus-table').val(),
        };
    };
     
    var deleteSilabus = function () {
        var id = $(this).data('id');

        bootbox.confirm(t('Вы действительно хотите выполнить эту действию?'), function (confirm) {
            if (confirm) {
                $.ajax({
                    url: '/silabus/ajax?command=delete',
                    type: 'POST',
                    dataType: 'json',
                    data: { id: id }
                }).done(function (result) {
                    if (result.code == 1) {
                        toastr.success(t('Операция успешна завершина'));
                        silabussTable.ajax.reload();
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
            
            silabussTable = $('#silabus-table').DataTable({
                pageLength: 25,
                autoWidth: false,
                columns: [
                    { data: 'name_silabus' },
                    { data: 'course' },
                    { data: 'student' },
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
                        url: '/silabus/ajax?command=list',
                        type: 'POST',
                        dataType: 'json',
                        data: $.extend(data, getFilterParams())
                    }).done(function (result) {
                        $('#silabus-table').tableHeadFixer({ head: false, left: 0 });
                        callback(result);
                    });
                },
                rowCallback: function(row, data, index) {
                    var btn = $('<button>').addClass('btn btn-xs'), editBtn, deleteBtn;

                    editBtn = "<a href='update?id="+ data.id  +"' class='btn btn-xs btn-info' title='"+ t('Редактировать') +"'><i class='fa fa-fw fa-pencil'></i></a>";
                    

                    deleteBtn = btn.clone().attr('title', t('Запретить доступ')).addClass('btn-danger delete').attr('data-id', data.id);

                    $('td:last', row).addClass('text-center')
                        .empty()
                        .append(editBtn)
                        .append('&nbsp;')
                        .append(deleteBtn);
                        
                        // Add some text in row of student instead of number
                        $('td:eq(1)', row).addClass('text-center').append(' курс');
                        $('td:eq(2)', row).empty();
                        if (data.student == 1) {
                             $('td:eq(2)', row).append('cтудент');
                        }
                        else
                            $('td:eq(2)', row).append('магистра');
                        
                        // Mark deleted row
                        if (data.status == 0) {
                            $(row).addClass('danger');
                             deleteBtn.append($('<i>').addClass('fa fa-fw fa-unlock-alt'));
                        }
                        else
                            deleteBtn.append($('<i>').addClass('fa fa-fw fa-unlock'));
                }
            });
            
            

            $('#silabus-table')
                .on('change', '.filter', function () {
                    silabussTable.ajax.reload();
                })
                .on('click', '.delete', deleteSilabus);
        }
    };
}();

$(document).ready(function() {
    Silabus.init();
});
