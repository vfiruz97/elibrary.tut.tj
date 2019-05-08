var App = function () {
    
    var initAjax = function () {
        $.ajaxSetup ({
            // Disable caching of AJAX responses
            cache: false
        });
    };

    var initDataTables = function () {
        if (jQuery().DataTable) {
            $.extend(true, $.fn.dataTable.defaults, {
                language: {
                    processing: t('Подождите...'),
                    search: t('Поиск:'),
                    lengthMenu: t('Показать _MENU_ записей'),
                    info: t('Записи с _START_ до _END_ из _TOTAL_ записей'),
                    infoEmpty: t('Записи с 0 до 0 из 0 записей'),
                    infoFiltered: t('(отфильтровано из _MAX_ записей)'),
                    infoPostFix: '',
                    loadingRecords: t('Загрузка записей...'),
                    zeroRecords: t('Записи отсутствуют.'),
                    emptyTable: t('В таблице отсутствуют данные'),
                    paginate: {
                        first: t('Первая'),
                        previous: t('Предыдущая'),
                        next: t('Следующая'),
                        last: t('Последняя')
                    },
                    aria: {
                        sortAscending: t(': активировать для сортировки столбца по возрастанию'),
                        sortDescending: t(': активировать для сортировки столбца по убыванию')
                    }
                }
            });
        }
    };
    
    var initValidation = function () {
        $.validator.setDefaults({
            highlight: function(element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function(element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function(error, element) {
                if(element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            }
        });
    };
    
    var initNotifications = function () {
        toastr.options.closeButton = true;
        toastr.options.positionClass = 'toast-top-center';
    };

    return {
        init: function () {
            initAjax();
            initDataTables();
         //   initValidation();
            initNotifications();

            jQuery.fn.asCalendar = function(options) {
                if (jQuery().datetimepicker) {
                    var settings = $.extend({
                        // These are the defaults.
                        format: 'YYYY-MM-DD',
                        useCurrent: false,
                        ignoreReadonly: true,
                        showClear: true
                    }, options );

                    $(this).datetimepicker(settings);
                }
            };
        },

        getSimpleModal: function (title) {
            return $(
                '<div class="modal fade" tabindex="-1" role="dialog">' +
                '   <div class="modal-dialog modal-lg" role="document">' +
                '       <div class="modal-content">' +
                '           <div class="modal-header">' +
                '               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                '               <h4 class="modal-title">' + title + '</h4>' +
                '           </div>' +
                '           <div class="modal-body"></div>' +
                '           <div class="modal-footer">' +
                '               <button type="button" class="btn btn-default" data-dismiss="modal">'+ t('Закрыть') +'</button>' +
                '           </div>' +
                '       </div>' +
                '   </div>' +
                '</div>'
            );
        }
    };    
}();


$(document).ready(function() {
    App.init();
});
