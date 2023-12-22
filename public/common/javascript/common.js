const COMMON = (function () {
    let modules = {};

    modules.showValidateMessage = function (formId, xhr) {
        let res = xhr.responseJSON.errors;
        let elmError = `<div class="text-sm error-msg"></div>`;

        $.each(res, function (key, value) {
            if (key.slice(-4) == 'dish') { // Check validation step 3
                key = 'dish_' + (Number(key.slice(-6).slice(0, 1)) + 1); // convert key step 3
            }

            $(formId).find(`input[name="${key}"]`).after($(elmError).text(value[0]));
            $(formId).find(`select[name="${key}"]`).after($(elmError).text(value[0]));
        })
    };

    modules.clearValidate = function (formId) {
        $(formId).find('.error-msg').remove();
    };

    modules.clearForm = function (form) {
        form.get(0).reset();
        form.find(`select`).removeAttr('disabled')
    };

    modules.clearOptionSelected = function (elm) {
        $(`#${elm} option`).remove();
    }

    modules.addOptionSelected = function (data, elm) {
        $.each(data, function (key, value) {
            elm.append(`<option value="${value}">${value}</option>`);
        })
    }

    return modules;
})();

export { COMMON };
