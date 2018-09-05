$(document).ready(() => {
    const doc = document;

    const convertDateToFull = (year, month, day) => {
        const months = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December',
        ];
        console.log(parseInt(month, 10))
        return `${months[parseInt(month, 10) - 1]} ${day}, ${year}`;
    };

    //date time pickers
    if ($('.datetime-picker').length) {
        $('.datetime-picker').flatpickr();
    }

    if ($('.spinner').length) {
        $('.spinner').spinner();
    }

    if ($('.full-date').length) {
        const arrDateVal = Array.prototype.slice.call(
            doc.getElementsByClassName('full-date')
        );

        for (let index = 0; index < arrDateVal.length; index++) {
            const element = arrDateVal[index];
            const val = element.innerHTML.split('-');
            const date = convertDateToFull(val[0], val[1], val[2]);

            element.innerHTML = `${date}`;
        }
    }
});
