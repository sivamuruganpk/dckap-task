let errorFlag = true;

function getAllProduct(page = null) {
    var page_per_page = $("#page_per_page").val();
    $.ajax({
        url: 'product_list.php',
        type: 'POST',
        data: {
            'limit': page,
            'page_per_page': page_per_page
        },
        success: function(data) {

            $("#product_lists").html(data);

        }
    })
}

getAllProduct();

function ProductAdd() {

    $("#product_modal").modal();
    $("#product_info").load("product_add.php");
}

function productCreate() {

    errorFlag = true;

    $('.mandatory-field').each(function() {

        let fieldElement = $(this);

        let fieldValue = fieldElement.val();

        let fieldId = $(this).attr('id');



        if (fieldValue == '') {

            $("#" + fieldId).css("border-color", "red");

            $("." + fieldId + "_mandatory").css("display", "block");

            errorFlag = false;

        } else {

            console.log(fieldId);

            if (fieldId == 'product_sku') {

                productSku = document.getElementById(fieldId);

                checkSkuUnique(productSku);

            } else if (fieldId == 'product_image') {

                console.log("xxxxxxxxxx")

                productImage = document.getElementById(fieldId);

                console.log(productImage);

                fileValidate(productImage);

            } else {
                $("#" + fieldId).css("border-color", "");

                $("." + fieldId + "_mandatory").css("display", "none");

            }



        }




    });

    console.log(errorFlag);
    if (errorFlag) {
        var form_data = new FormData($('form')[0]);
        $.ajax({
            url: 'product_insert.php',
            type: 'POST',
            data: form_data,
            processData: false,
            contentType: false,
            success: function(data) {
                var result = JSON.parse(data);

                if (result.status) {
                    alert(result.message);
location.reload();
                } else {
                    alert(result.message);
                }
            }
        })
    } else {
        alert('Please check highlighted fields');
    }
}

function productEdit(productId) {
    $("#product_title").html("Edit Product")
    $("#product_modal").modal();
    $("#product_info").load("product_edit.php", {
        product_id: productId
    });
}

function productUpdate(productId) {

    errorFlag = true;

    $('.mandatory-field').each(function() {

        let fieldElement = $(this);

        let fieldValue = fieldElement.val();

        let fieldId = $(this).attr('id');



        if (fieldValue == '') {

            $("#" + fieldId).css("border-color", "red");

            $("." + fieldId + "_mandatory").css("display", "block");

            errorFlag = false;

        } else {

            if (fieldId == 'product_sku') {

                productSku = document.getElementById(fieldId);

                checkSkuUnique(productSku, productId);

            } else if (fieldId == 'product_image') {

                productImage = document.getElementById(fieldId);

                fileValidate(productImage);

            } else {
                $("#" + fieldId).css("border-color", "");

                $("." + fieldId + "_mandatory").css("display", "none");

            }



        }




    });

    if (errorFlag) {
        var form_data = new FormData($('form')[0]);
        $.ajax({
            url: 'product_update.php',
            type: 'POST',
            data: form_data,
            processData: false,
            contentType: false,
            success: function(data) {
                var result = JSON.parse(data);

                if (result.status) {
                    alert(result.message);
location.reload();
                } else {
                    alert(result.message);
                }
            }
        })
    } else {
        alert('Please check highlighted fields');
    }


}

function productDelete(productId) {
    var productDelete = confirm("Are sure want to delete?");

    if (productDelete) {
        $.ajax({
            url: 'product_delete.php',
            type: 'POST',
            data: {
                product_id: productId
            },
            success: function(data) {
                var result = JSON.parse(data);
                if (result.status) {
location.reload();
                } else {
                    alert(result.message);
                }
            }
        })
    }
}

function checkSkuUnique(Skuinput, productId = null) {
    $.ajax({
        url: 'product_sku_check_unique.php',
        type: 'POST',
        data: {
            product_sku: Skuinput.value,
            product_id: productId
        },
        success: function(data) {

            if (!data) {

                $("#product_sku_mandatory").css("display", "block");

                errorFlag = false;

                $("#product_sku").css("border-color", "red");

            } else {

                $("#product_sku_mandatory").css("display", "none");
                $("#product_sku").css("border-color", "");


            }

        }
    })
}

function fileValidate(fileInput) {
    var file = fileInput.files[0];

    var fileType = file["type"];
    var validImageTypes = ["image/jpeg", "image/png"];
    if ($.inArray(fileType, validImageTypes) < 0) {
        console.log("1");
        $("#product_image_file_type").css("display", "block");

        errorFlag = false;

        $("#product_image").css("border-color", "red");
    } else {
        console.log("2");

        $("#product_image_file_type").css("display", "none");

        $("#product_image").css("border-color", "");

        var reader = new FileReader();

        reader.onload = function() {
            console.log(reader.result);
            $("#edit_image_show").attr("src", reader.result);
        }
        reader.readAsDataURL(file);



    }
}

function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!regex.test(email)) {
        return false;
    } else {
        return true;
    }
}