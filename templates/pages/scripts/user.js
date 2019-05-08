var User = function () {
    
    var usersTable;

    var getFilterParams = function () {
        return {
            faculty : $(':input[name="faculty"]', '#users-table').val(),
            name    : $(':input[name="name-user"]', '#users-table').val(),
            show_deleted : $(':input[name="show_deleted"]', '#users-table').val(),
        };
    };
  
    var updateUser = function () {
        var form = $('#update-user-form'), button = Ladda.create(this);

        form.validate({
            rules: {
                'User[name]'            : 'required',
                'User[surname]'         : 'required',
                'User[email]'           : 'required',
                'User[date_of_birth]'   : 'required',
                'User[gender]'          : 'required',
                'User[role]'            : 'required',
                'User[faculty_id]'      : 'required',
                'User[faculty_id]'      : 'required',
                'User[speciality_id]'   : 'required',
                'User[repeat_password]' : {
                    equalTo             : "#user-password"
                }
            },
            messages: {
                'User[name]'            : t('Введите имя'),
                'User[surname]'         : t('Введите фамилию'),
                'User[email]'           : t('Введите телефон'),
                'User[date_of_birth]'   : t('Укажите дату рождения'),
                'User[gender]'          : t('Укажите пол'),
                'User[role]'            : t('Выберите роль'),
                'User[faculty_id]'      : t('Выберите факультета'),
                'User[speciality_id]'   : t('Выберите специальности'),
                'User[username]'        : t('Введите логин'),
                'User[repeat_password]' : {
                    equalTo             : t('Пароль не совподают')
                }
            }
        });

        if (form.valid()) {
            button.start();

            $.ajax({
                url: '/user/ajax?command=update',
                type: 'POST',
                dataType: 'json',
                data: form.serialize()
            }).done(function (result) {
                if (result.code == 1) {
                    $('#update-user-modal').modal('hide');

                    toastr.success(t('Данные успешно изменены'));
                    usersTable.ajax.reload();
                } else {
                    var message = result.message ? result.message : t('Невозможно изменить данные');
                    toastr.error(message);
                }
            }).always(function () {
                button.stop();
            });
        }
    };
    
    var deleteUser = function () {
        var id = $(this).data('id');

        bootbox.confirm(t('Вы действительно хотите выполнить эту действию?'), function (confirm) {
            if (confirm) {
                $.ajax({
                    url: '/user/ajax?command=delete',
                    type: 'POST',
                    dataType: 'json',
                    data: { id: id }
                }).done(function (result) {
                    if (result.code == 1) {
                        toastr.success(t('Операция успешна завершина'));
                        usersTable.ajax.reload();
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
            
            usersTable = $('#users-table').DataTable({
                pageLength: 25,
                autoWidth: false,
                columns: [
                    { data: 'name' },
                    { data: 'faculty' },
                    { data: 'speciality' },
                    { data: 'email' },
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
                        url: '/user/ajax?command=list',
                        type: 'POST',
                        dataType: 'json',
                        data: $.extend(data, getFilterParams())
                    }).done(function (result) {
                        $('#users-table').tableHeadFixer({ head: false, left: 0 });
                        callback(result);
                    });
                },
                rowCallback: function(row, data, index) {
                    var btn = $('<button>').addClass('btn btn-xs'), editBtn, deleteBtn;

                    editBtn = btn.clone().attr('title', t('Редактировать')).addClass('btn-default disabled').append($('<i>').addClass('fa fa-fw fa-pencil'));
                    if (userCan('updateUser')) {
                        editBtn
                            .attr('data-id', data.id)
                            .attr('data-toggle', 'modal')
                            .attr('data-target', '#update-user-modal')
                            .removeClass('disabled');
                    }

                    deleteBtn = btn.clone().attr('title', t('Запретить доступ')).addClass('btn-danger disabled');
                    if (userCan('deleteUser')) {
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
            
            $('#update-user-modal')
                .on('shown.bs.modal', function (e) {
                    var id = $(e.relatedTarget).data('id');
            
                    $('#update-user-form')
                        .html('Пожалуйста подождите ...')
                        .load('/user/aux?command=update-user', { id: id }, function () {
                            $('.date-picker', this).asCalendar();
                        });
                })
                .on('hide.bs.modal', function () {
                    $('#update-user-form').empty();
                });

            $('#update-user')
                .on('click', updateUser);

            $('#users-table')
                .on('change', '.filter', function () {
                    usersTable.ajax.reload();
                })
                .on('click', '.delete', deleteUser);
        }
    };
}();

$(document).ready(function() {
    User.init();
});
