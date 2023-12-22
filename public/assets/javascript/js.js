import {COMMON} from "../../common/javascript/common.js";

const DISHES = (function () {
    let modules = {};

    modules.handle = function (form) {
        const formId = `#${form.attr('id')}`;
        const formData = new FormData(form.get(0));

        $.ajax({
            type: "POST",
            url: form.attr('action'),
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            beforeSend: function () {
                COMMON.clearValidate(formId);
            },
            success: function (res) {
                if (res.success) {
                    if (res.data.step != 'step-4') {
                        COMMON.clearOptionSelected(res.data.elm);
                        COMMON.addOptionSelected(res.data.data, $(`#${res.data.elm}`));
                    } else {
                        /**
                         * Show data step preview
                         */
                        let dataShow = res.data.data;
                        let listDishes = '';

                        $.map(dataShow, function (value, key){
                            $(`#show_${key}`).text(value);
                        })

                        $.map(dataShow.options, function (value) {
                            listDishes += `<p>${value.dish} - ${value.number_servings}</p>`;
                        });

                        $("#show_dishes").append(listDishes);
                        $("#submit_form").text('submit');
                    }

                    DISHES.setItemStep(res.data);
                }
            },
            error: function (xhr) {
                COMMON.showValidateMessage(formId, xhr);
            },
            complete: function (data) {
                // ...
            },
            statusCode: {
                500: function(xhr) {
                    let res = xhr.responseJSON;
                    $("#add-tab-3").after( `<div class="text-sm error-msg mt-2">${res.message}</div>`)
                }
            }
        });
    }

    modules.setItemStep = function (data) {
        // Change tab
        $(".tab").addClass("hidden");
        $(`#tab-${data.step.slice(-1)}`).removeClass("hidden");

        // Change step
        $(".step").removeClass("bg-blue-600");
        $(`#${data.step}`).addClass("bg-blue-600");

        // Change action form
        $('#handle-dishes').attr('action', data.urlStep);

        // Change element form
        if(data.step != 'step-1') {
            // If there is no #previous element, add it
            if (!$("#previous").length) {
                $('#submit_form').before('<button type="button" id="previous" class="px-2.5 border-solid border-2 border-black shadow-md shadow-black">Previous</button>');
                $('#submit_form').parent().removeClass('flex-end').addClass('justify-between');
            }
        } else {
            // In step 1, delete the #previous element
            $("#previous").remove();
            $('#submit_form').parent().removeClass('justify-between').addClass('flex-end');
        }

        // Set attribute id of step previous
        $("#previous").attr("data-id", data.step.slice(-1) - 1);
    }

    return modules;
})(window.jQuery, window, document);

$(document).ready(function () {
    $(document).on('click', '#submit_form', function (e) {
        e.preventDefault();
        DISHES.handle($("#handle-dishes"));
    });

    $(document).on('click', '#previous', function () {
        let id = $(this).attr("data-id");

        let itemPreStep = {
            "step": `step-${id}`,
            "urlStep": $('#handle-dishes').attr('action').slice(0, -1) + id
        }

        DISHES.setItemStep(itemPreStep);

        // Delete the live block in step 3
        $("#block-tab-3").find('.remove-block').remove();
        $("#block-tab-3 div:first").find(`select`).removeClass('pointer-events-none');
        // Clear show disher step preview
        $("#show_dishes p").remove();
        // Set text button next
        $("#submit_form").text('next');

        COMMON.clearForm($("#handle-dishes"));
    });

    $(document).on('click', '#add-tab-3', function () {
        // Get the number of blocks in step 3
        let lengthBlock = $("#block-tab-3 .grid").length;

        // If the number of blocks is less than the number of options generated from step 2, the block can be added
        if(lengthBlock < $("#dish_1 option").length) {
            let blockLast = $("#block-tab-3 div.grid:last"); // Get block last
            let elmClone = blockLast.clone(); // Clone block

            // Delete the option selected in the last block in the clone
            elmClone.find(`select`).find(`option[value="${blockLast.find(`select`).val()}"]`).remove();

            // Add a clone block to the main block
            elmClone.appendTo("#block-tab-3");

            // Disable the previously selected block
            $(`#dish_${lengthBlock}`).addClass("pointer-events-none");

            $("#block-tab-3").find('.grid').map((index,element) => {
                // Set element block clone
                $(element).find(`select`).attr({'name':`dish_${index + 1}`, 'id': `dish_${index + 1}`});
                $(element).find(`input[type="number"]`).attr({'name':`number_servings_${index + 1}`});

                // Delete attribute disabled of last block
                if (index == $("#block-tab-3").find('.grid').length - 1) {
                    $(element).find(`select`).removeClass("pointer-events-none");
                }

                // Add class remove block
                if (index != 0) {
                    $(element).addClass('remove-block');
                }
            })
        }
    });
});
