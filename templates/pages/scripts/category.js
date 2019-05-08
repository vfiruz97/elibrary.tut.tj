var Category = function () {

    var categoryTable;
    var subcategoryTable;

    var getFilterParams = function () {
        var table = $('#category-table');

        return {
            show_deleted : $(':input[name="show_deleted"]', '#category-table').val(),
            show_deleted : $(':input[name="show_deleted"]', '#subcategory-table').val(),
            category : $(':input[name="category"]', '#subcategory-table').val(),
        };
    }; 

    var categoryInfo = function () {
        var categoryId = $(this).data('id');

        var modal = App.getSimpleModal(t('Информация о категорий'));
        modal.modal('show');

        modal
            .on('shown.bs.modal', function (e) {
                var modalBody = $('.modal-body', this);
                    modalBody.html(t('Пожалуйста подождите ...'));

                $.post('/category/aux?command=info', { id: categoryId }, function (result) {
                    modalBody.replaceWith(result);
                });
            });
    };

    var createСategory = function () {
        var form = $('#create-category-form'), button = Ladda.create(this);

        form.validate({
            ignore: [],
            rules: {
                'Category[name_ru]'   : 'required',
                'Category[name_tj]'   : 'required',
            },
            messages: {
                'Category[name_ru]'   : t('Введите поле'),
                'Category[name_tj]'   : t('Введите поле'),
            }
        });

        if (form.valid()) {
            button.start();

            $.ajax({
                url: '/category/ajax?command=create',
                type: 'POST',
                dataType: 'json',
                data: form.serialize()
            }).done(function (result) {
                if (result.code == 1) {
                    $('#create-category-modal').modal('hide');

                    toastr.success(t('Данные успешно добавлены'));
                    categoryTable.ajax.reload();
                } else {
                    var message = result.message ? result.message : t('Невозможно добавить данные');
                    toastr.error(message);
                }
            }).always(function () {
                button.stop();
            });
        }
    };
    
    var createSubcategory = function () {
        var form = $('#create-subcategory-form'), button = Ladda.create(this);

        form.validate({
            ignore: [],
            rules: {
                'Subcategory[name_ru]'      : 'required',
                'Subcategory[name_tj]'      : 'required',
                'Subcategory[category_id]'  : 'required',
            },
            messages: {
                'Subcategory[name_ru]'      : t('Введите поле'),
                'Subcategory[name_tj]'      : t('Введите поле'),
                'Subcategory[category_id]'  : t('Введите поле'),
            }
        });

        if (form.valid()) {
            button.start();

            $.ajax({
                url: '/category/ajax?command=create-subcategory',
                type: 'POST',
                dataType: 'json',
                data: form.serialize()
            }).done(function (result) {
                if (result.code == 1) {
                    $('#create-subcategory-modal').modal('hide');

                    toastr.success(t('Данные успешно добавлены'));
                    subcategoryTable.ajax.reload();
                } else {
                    var message = result.message ? result.message : t('Невозможно добавить данные');
                    toastr.error(message);
                }
            }).always(function () {
                button.stop();
            });
        }
    };

    var updateСategory = function () {
        var form = $('#update-category-form'), button = Ladda.create(this);

        form.validate({
            ignore: [],
            rules: {
                'Category[name_ru]'         : 'required',
                'Category[name_tj]'         : 'required',
                'Subcategory[category_id]'  : t('Введите поле'),
            },
            messages: {
                'Category[name_ru]'   : t('Введите поле'),
                'Category[name_tj]'   : t('Введите поле'),
            }
        });

        if (form.valid()) {
            button.start();

            $.ajax({
                url: '/category/ajax?command=update',
                type: 'POST',
                dataType: 'json',
                data: form.serialize()
            }).done(function (result) {
                if (result.code == 1) {
                    $('#update-category-modal').modal('hide');

                    toastr.success(t(t('Данные успешно изменены')));
                    categoryTable.ajax.reload();
                } else {
                    var message = result.message ? result.message : t(t('Невозможно изменить данные'));
                    toastr.error(message);
                }
            }).always(function () {
                button.stop();
            });
        }
    };
    
    var updateSubcategory = function () {
        var form = $('#update-subcategory-form'), button = Ladda.create(this);

        form.validate({
            ignore: [],
            rules: {
                'Subcategory[name_ru]'      : 'required',
                'Subcategory[name_tj]'      : 'required',
                'Subcategory[category_id]'  : 'required',
            },
            messages: {
                'Subcategory[name_ru]'      : t('Введите поле'),
                'Subcategory[name_tj]'      : t('Введите поле'),
                'Subcategory[category_id]'  : t('Введите поле'),
            }
        });

        if (form.valid()) {
            button.start();

            $.ajax({
                url: '/category/ajax?command=update-subcategory',
                type: 'POST',
                dataType: 'json',
                data: form.serialize()
            }).done(function (result) {
                if (result.code == 1) {
                    $('#update-subcategory-modal').modal('hide');

                    toastr.success(t('Данные успешно изменены'));
                    subcategoryTable.ajax.reload();
                } else {
                    var message = result.message ? result.message : t('Невозможно изменить данные');
                    toastr.error(message);
                }
            }).always(function () {
                button.stop();
            });
        }
    };

    var deleteСategory = function () {
        var id = $(this).data('id');

        bootbox.confirm(t('Вы действительно хотите удалить данные о категорий?'), function (confirm) {
            if (confirm) {
                $.ajax({
                    url: '/category/ajax?command=delete',
                    type: 'POST',
                    dataType: 'json',
                    data: { id: id }
                }).done(function (result) {
                    if (result.code == 1) {
                        toastr.success(t('Данные успешно удалены'));
                        categoryTable.ajax.reload();
                    } else {
                        var message = result.message ? result.message : t('Невозможно удалить данные о категорий');
                        toastr.error(message);
                    }
                });
            }
        });
    };
    
    var deleteSubcategory = function () {
        var id = $(this).data('id');

        bootbox.confirm(t('Вы действительно хотите удалить данные о подкатегорий?'), function (confirm) {
            if (confirm) {
                $.ajax({
                    url: '/category/ajax?command=delete-subcategory',
                    type: 'POST',
                    dataType: 'json',
                    data: { id: id }
                }).done(function (result) {
                    if (result.code == 1) {
                        toastr.success(t('Данные успешно удалены'));
                        subcategoryTable.ajax.reload();
                    } else {
                        var message = result.message ? result.message : t('Невозможно удалить данные о подкатегорий');
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

            categoryTable = $('#category-table').DataTable({
                pageLength: 25,
                autoWidth: false,
                columns: [
                    { data: 'id' },
                    { data: 'name_ru' },
                    { data: 'name_tj' },
                    { data: 'created_at' },
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
                        url: '/category/ajax?command=list',
                        type: 'POST',
                        dataType: 'json',
                        data: $.extend(data, getFilterParams())
                    }).done(function (result) {
                        $('#category-table').tableHeadFixer({ head: false, left: 0 });
                        callback(result);
                    });
                },
                rowCallback: function(row, data, index) {
                    var btn = $('<button>').addClass('btn btn-xs'), link = $('<a></a>'), infoBtn, editCommand, deleteCommand;

                    infoBtn = btn.clone().attr('data-id', data.id).attr('title', t('Информация')).addClass('btn-info info').append($('<i>').addClass('fa fa-fw fa-info'));
                    
                    editCommand = btn.clone().attr('data-id', data.id).attr('title', t('Редактировать')).attr('data-toggle', 'modal').attr('data-target', '#update-category-modal').addClass('btn-default').append($('<i>').addClass('fa fa-fw fa-pencil'));
                    
                    deleteCommand = btn.clone().attr('data-id', data.id).attr('title', t('Удалить')).addClass('btn-danger delete').append($('<i>'));   

                    $('td:last', row).addClass('text-center')
                        .empty()
                        .append(infoBtn)
                        .append('&nbsp;') 
                        .append(editCommand)
                        .append('&nbsp;')
                        .append(deleteCommand);
                        
                        // Mark deleted row
                        if (data.status == 0) {
                            $(row).addClass('danger');
                             deleteCommand.append($('<i>').addClass('fa fa-fw fa-unlock-alt'));
                        }
                        else
                            deleteCommand.append($('<i>').addClass('fa fa-fw fa-unlock'));                     
                }
            });
            
            subcategoryTable = $('#subcategory-table').DataTable({
                pageLength: 25,
                autoWidth: false,
                columns: [
                    { data: 'id' },
                    { data: 'category_ru' },
                    { data: 'name_ru' },
                    { data: 'name_tj' },
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
                        url: '/category/ajax?command=list-subcategory',
                        type: 'POST',
                        dataType: 'json',
                        data: $.extend(data, getFilterParams())
                    }).done(function (result) {
                        $('#subcategory-table').tableHeadFixer({ head: false, left: 0 });
                        callback(result);
                    });
                },
                rowCallback: function(row, data, index) {
                    var btn = $('<button>').addClass('btn btn-xs'), link = $('<a></a>'), infoBtn, editCommand, deleteCommand;
                    
                    editCommand = btn.clone().attr('data-id', data.id).attr('title', t('Редактировать')).attr('data-toggle', 'modal').attr('data-target', '#update-subcategory-modal').addClass('btn-default').append($('<i>').addClass('fa fa-fw fa-pencil'));
                    
                    deleteCommand = btn.clone().attr('data-id', data.id).attr('title', t('Удалить')).addClass('btn-danger delete').append($('<i>'));   

                    $('td:last', row).addClass('text-center')
                        .empty() 
                        .append(editCommand)
                        .append('&nbsp;')
                        .append(deleteCommand);
                        
                        // Mark deleted row
                        if (data.status == 0) {
                            $(row).addClass('danger');
                             deleteCommand.append($('<i>').addClass('fa fa-fw fa-unlock-alt'));
                        }
                        else
                            deleteCommand.append($('<i>').addClass('fa fa-fw fa-unlock'));                     
                }
            });

            $('#category-table')
                .on('change', '.filter', function () {
                    categoryTable.ajax.reload();
                })
                .on('click', '.info', categoryInfo)
                .on('click', '.delete', deleteСategory);
                    
            
             $('#subcategory-table')
                .on('change', '.filter', function () {
                    subcategoryTable.ajax.reload();
                })
                .on('click', '.delete', deleteSubcategory);
            
            $('#create-category-modal')
                .on('shown.bs.modal', function (e) {
                    $('#create-category-form')
                        .html(t('Пожалуйста подождите ...'))
                        .load('/category/aux?command=create-category');
                })
                .on('hide.bs.modal', function () {
                    $('#create-category-form').empty();
                });
                
            $('#create-subcategory-modal')
                .on('shown.bs.modal', function (e) {
                    $('#create-subcategory-form')
                        .html(t('Пожалуйста подождите ...'))
                        .load('/category/aux?command=create-subcategory');
                })
                .on('hide.bs.modal', function () {
                    $('#create-subcategory-form').empty();
                });
                

            $('#create-category')
                .on('click', createСategory);
                
            $('#create-subcategory')
                .on('click', createSubcategory);

            $('#update-category-modal')
                .on('shown.bs.modal', function (e) {
                    var id = $(e.relatedTarget).data('id');

                    $('#update-category-form')
                        .html(t('Пожалуйста подождите ...'))
                        .load('/category/aux?command=update-category', { id: id });
                })
                .on('hide.bs.modal', function () {
                    $('#update-category-form').empty();
                });
                
            $('#update-subcategory-modal')
                .on('shown.bs.modal', function (e) {
                    var id = $(e.relatedTarget).data('id');

                    $('#update-subcategory-form')
                        .html(t('Пожалуйста подождите ...'))
                        .load('/category/aux?command=update-subcategory', { id: id });
                })
                .on('hide.bs.modal', function () {
                    $('#update-subcategory-form').empty();
                });

            $('#update-category')
                .on('click', updateСategory);
                
           $('#update-subcategory')
                .on('click', updateSubcategory);

        }
    };
}();

$(document).ready(function() {
    Category.init();
});
