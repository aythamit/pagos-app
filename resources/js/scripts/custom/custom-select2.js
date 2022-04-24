function initSelect2(id, options = null) {
    //Inicializa select como select2
    const select = $('#' + id);

    const lang = options != null && checkValueIsValid(options.lang) ? options.lang : 'es';
    const placeholder = options != null && checkValueIsValid(options.placeholder) ? options.placeholder : select2.placeholder;
    const minimumInputLength = options != null && checkValueIsValid(options.minimumInputLength) ? options.minimumInputLength : -1;
    const inputTooShort = options != null && checkValueIsValid(options.inputTooShort) ? options.inputTooShort : select2.inputTooShort_1 + ' ' +  minimumInputLength + ' ' + select2.inputTooShort_2;
    const inputTooLong = options != null && checkValueIsValid(options.inputTooLong) ? options.inputTooLong : select2.inputTooLong;
    const noResults = options != null && checkValueIsValid(options.noResults) ? options.noResults : select2.noResults;
    const disabled = options != null && options.disabled;

    select.wrap('<div class="position-relative"></div>').select2({
        dropdownParent: select.parent(),
        placeholder: placeholder,
        minimumInputLength: minimumInputLength,
        language: lang,
        disabled: disabled,
        language: {
            inputTooShort: function (args) {
                // args.minimum is the minimum required length
                // args.input is the user-typed text
                return inputTooShort;
            },
            inputTooLong: function (args) {
                // args.maximum is the maximum allowed length
                // args.input is the user-typed text
                return inputTooLong;
            },
            noResults: function () {
                return noResults;
            },
        },
    });
}

function initSelect2Ajax(id, url, options = null) {
    const select = $('#' + id);

    const lang = options != null && checkValueIsValid(options.lang) ? options.lang : 'es';
    const placeholder = options != null && checkValueIsValid(options.placeholder) ? options.placeholder : select2.placeholder;
    const minimumInputLength = options != null && checkValueIsValid(options.minimumInputLength) ? options.minimumInputLength : 1;
    const inputTooShort = options != null && checkValueIsValid(options.inputTooShort) ? options.inputTooShort : select2.inputTooShort_1 + ' ' +  minimumInputLength + ' ' + select2.inputTooShort_2;
    const inputTooLong = options != null && checkValueIsValid(options.inputTooLong) ? options.inputTooLong : select2.inputTooLong;
    const errorLoading = options != null && checkValueIsValid(options.errorLoading) ? options.errorLoading : select2.errorLoading;
    const loadingMore = options != null && checkValueIsValid(options.loadingMore) ? options.loadingMore : errorLoading;
    const noResults = options != null && checkValueIsValid(options.noResults) ? options.noResults : select2.noResults;
    const searching = options != null && checkValueIsValid(options.searching) ? options.searching : select2.searching;
    const maximumSelected = options != null && checkValueIsValid(options.maximumSelected) ? options.maximumSelected : select2.maximumSelected;
    const disabled = options != null && options.disabled;

    select.wrap('<div class="position-relative"></div>').select2({
        language: lang,
        dropdownAutoWidth: true,
        dropdownParent: select.parent(),
        width: '100%',
        minimumInputLength: minimumInputLength,
        disabled: disabled,
        language: {
            inputTooShort: function (args) {
                // args.minimum is the minimum required length
                // args.input is the user-typed text
                return inputTooShort;
            },
            inputTooLong: function (args) {
                // args.maximum is the maximum allowed length
                // args.input is the user-typed text
                return inputTooLong;
            },
            errorLoading: function () {
                return errorLoading;
            },
            loadingMore: function () {
                return loadingMore;
            },
            noResults: function () {
                return noResults;
            },
            searching: function () {
                return searching;
            },
            maximumSelected: function (args) {
                // args.maximum is the maximum number of items the user may select
                return maximumSelected;
            }
        },
        ajax: {
            url: url,
            dataType: 'JSON',
            method: 'POST',
            delay: 250,
            data: function (params) {
                return {
                    term: params.term, // search term
                    page: params.page
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.text,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        },
        placeholder: placeholder,
        escapeMarkup: function (markup) {
            return markup;
        },
        // let our custom formatter work
        // templateResult: userTemplate,
        // templateSelection: userTemplate,
    });
}

function checkValueIsValid(value) {
    return value !== undefined && value !== null && value !== '';
}