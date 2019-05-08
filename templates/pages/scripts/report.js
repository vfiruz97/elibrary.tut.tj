var Report = function () {

    var initBook = function () {
        var resetForm = function () {
            var form = $('#book-report-search-form');

            $(':input', form).removeAttr('disabled');
            form.get(0).reset();

            $('#book-report-result').empty();
        };

        var getReport = function () {
            var form = $('#book-report-search-form'), button = Ladda.create(this);

            button.start();

            $.ajax({
                url         : '/report/report-read-book',
                method      : 'POST',
                data        : form.serialize(),
                dataType    : 'html'
            }).done(function (result) {
                $('#book-report-result').html(result);
                $('#book-report-table').tableHeadFixer({ head: false, left: 0 });
            }).always(function () {
                button.stop();
            });
        };

        var export2Excel = function () {
            var form = $('#book-report-search-form');

            form.attr('action', $(this).data('target'));
            form.submit();
        };

        $('#book-report-search-form')
            .on('click', '.search', getReport)
            .on('click', '.reset', resetForm);

        $('#book-report-result')
            .on('click', '.book-report-export-to-excel', export2Excel);

        $('.date-picker', '#book-report-search-form').asCalendar();
    };

   var initDownload = function () {
        var resetForm = function () {
            var form = $('#download-report-search-form');

            $(':input', form).removeAttr('disabled');
            form.get(0).reset();

            $('#download-report-result').empty();
        };

        var getReport = function () {
            var form = $('#download-report-search-form'), button = Ladda.create(this);

            button.start();

            $.ajax({
                url         : '/report/download',
                method      : 'POST',
                data        : form.serialize(),
                dataType    : 'html'
            }).done(function (result) {
                $('#download-report-result').html(result);
                $('#download-report-table').tableHeadFixer({ head: false, left: 0 });
            }).always(function () {
                button.stop();
            });
        };

        var export2Excel = function () {
            var form = $('#download-report-search-form');

            form.attr('action', $(this).data('target'));
            form.submit();
        };

        $('#download-report-search-form')
            .on('click', '.search', getReport)
            .on('click', '.reset', resetForm);

        $('#download-report-result')
            .on('click', '.download-report-export-to-excel', export2Excel);

        $('.date-picker', '#download-report-search-form').asCalendar();
    };

   

    return {
        init: function () {
            initBook();
            initDownload();
        }
    };
}();

$(document).ready(function() {
    Report.init();
});
