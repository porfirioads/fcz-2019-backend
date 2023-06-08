$(document).ready(function () {
    var dateTimePickers = $('.datetimepicker-input');
    var dateTimeValues = [];

    dateTimePickers.each(function (index, datetimePicker) {
        dateTimeValues.push($(datetimePicker).val());
    });

    console.log(`datetimepickers old values: ${dateTimeValues}`);

    dateTimePickers.datetimepicker({
        locale: 'es-us',
        format: 'YYYY-MM-DD HH:mm:ss',
        date: moment(),
    });

    dateTimePickers.each(function (index, datetimePicker) {
        $(datetimePicker).val(dateTimeValues[index]);
    });
});
