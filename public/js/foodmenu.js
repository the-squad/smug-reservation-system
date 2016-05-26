var tabID;

$(document).ready(function () {
    //Assiging first tab's id
    tabID = document.getElementsByTagName('a')[4].id.replace("T", "");

    /*
     When user adds or updates a food item
     */
    $('#confirm').on('click', function () {
        //Taking data from inputs
        var opertion;
        var file_data = $('#file').prop('files')[0];
        var form_data = new FormData();
        var name = $("#name-text").val();
        var price = $("#price-text").val();
        var description = $("#description-text").val();
        form_data.append('name', name); //Name
        form_data.append('price', price); //Price
        form_data.append('description', description); //Discription
        form_data.append('category', tabID); //Food category
        if ($("#confirm").text() == "Create") {
            opertion = "create";
        } else
        {
            opertion = "update";
            form_data.append('id', foodCardID.replace("f", ""));
            if (!file_data) {
                file_data = "nochange";
            }
        }
        //console.log(file_data);
        form_data.append('operation', opertion);
        //console.log(file_data);
        form_data.append('Image', file_data); //Picture
        //Hiding error messages
        hide(".error-message");
        hide("#price-error-message");

        //When the operation is creating a new food item

        //Sending data to the controller
        $.ajax({
            url: '?url=foodmenu/controlFood', dataType: 'text',
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (data) {
                //Converting array
                console.log(data);
                data = JSON.parse(data);


                //console.log(data);

                //Calling validation function
                validateInputs(data);
                if (opertion == "create") {
                    //When operation success
                    if (data['id'] && data['url']) {
                        //alert(data['url']);
                        //Creating a new food card
                        document.getElementById("P" + tabID).innerHTML +=
                                '<div class="food-card col-lg-4 col-md-5 col-sm-8 col-md-offset-1 col-sm-offset-2 col-xs-12" id="f' + data['id'] + '" onclick="fillFoodItemCard(this, this.id);">' +
                                '<div class="image" style="background-image: url(' + data['url'] + ');"></div>' +
                                '<div class="shape">' +
                                '<h1 class="name">' + $("#name-text").val() + '</h1>' +
                                '<p class="description">' +$("#description-text").val() +
                                '</p>' +
                                '<div class="stars">' +
                                '</div>' +
                                '</div>' +
                                '<div class="price">' +
                                '<span class="number">' + $("#price-text").val() + '</span>' +
                                '<span class="currency">L.E</span>' +
                                '</div>' +
                                '</div>';

                        //Hiding the food card and background
                        hide("#food-item-card");
                        hide(background);

                        //Showing the notifications
                        showNotification();
                    }

                } else
                    window.location = "?url=foodmenu";
            }
        });
    });
    $("#Confirm-button").click(function()
    {
        $.post("?url=foodmenu/deleteFood",{idfood :foodCardID.replace("f", "")});

        $("#" + foodCardID).remove();
        hide(".alert-message");
        hide(background);
    });
});

/*
 Check inputs for validation
 */
function validateInputs(data) {
    //Showing error messages
    if (data['file'])
        show("#picture-error-message");

    if (data['name'])
        show("#name-error-message");

    if (data['price'])
        show("#price-error-message");

    if (data['description'])
        show("#description-error-message");
}

var foodCardID;

//Fill food item data
function fillFoodItemCard(cardData, foodCardId) {
    //Making all fields in view mode
    $("#food-item-card div").removeClass("edit").addClass("view");
    $("#amount").removeClass("view").addClass("edit");

    //Making the name field bigger
    $("#food-name").css("width", "80%");

    //Controlling what elements shows to admin
    if (document.getElementById("add-food-item")) {
        $("#priceDiv").css("margin-top", "30px");
        $("#priceDiv").css("margin-left", "42.5%");
        $("#priceDiv").css("margin-bottom", "0px");
        $("#priceDiv").css("width", "15%");

        show("#stars-div");
        show(updateButton);
        show(deleteButton);
        hide(confirmButton);
    }

    //Clearing card fields
    clearFoodItemData();
    $("#amount-text").val(0);
    $("#order").prop('disabled', true); //Disabling the order button

    //Showing the food card and background
    show("#food-item-card");
    show(".background");
    hide("#image-picker");

    //Filling data from the food card
    $("#name-text").val(cardData.getElementsByClassName('name')[0].innerHTML);
    $("#description-text").val(cardData.getElementsByClassName('description')[0].innerText);
    $("#price-text").val(cardData.getElementsByClassName('number')[0].innerText);

    //Getting stars from card to the pop-up
    document.getElementById("stars-div").innerHTML = cardData.getElementsByClassName('stars')[0].innerHTML;

    //Applying photo as background
    var image = $("#" + foodCardId + " .image").css('background-image');
    $(".food-picture").css('background-image', image);

    //Changing confirm button text
    $("#confirm").text("Confirm");
    foodCardID = foodCardId;
}

//Updating food item
function updateFoodItem() {
    //Changing to edit mode
    $("#food-item-card div").removeClass("view").addClass("edit");

    //Customizing the style
    $("#food-name").css("width", "40%");
    $("#price").css("margin-top", "-206px");
    $("#price").css("margin-bottom", "170px");
    $("#price").css("margin-left", "55%");

    //Hiding and showing stuff
    hide("#stars-div");
    hide(updateButton);
    hide(deleteButton);
    show(confirmButton);
    show("#image-picker");
}

function confirmFoodItem() {
    $("#food-item-card div").removeClass("edit").addClass("view");
    $("#food-name").css("width", "80%");

    $("#price").css("margin-top", "30px");
    $("#price").css("margin-left", "42.5%");
    $("#price").css("margin-bottom", "0px");

    show("#stars-div");
    show(updateButton);
    show(deleteButton);
    hide(confirmButton);
    hide("#image-picker");
    showNotification();
}

//Taking the photo from file uploader and preview it
function previewFile() {
    var file = document.querySelector('input[type=file]').files[0];
    var reader = new FileReader();

    reader.addEventListener("load", function () {
        $(".food-picture").css('background-image', "url(" + reader.result + ")");
    }, false);

    if (file) {
        reader.readAsDataURL(file);
    }
}

//When deleteing a food item
function deleteFoodItem() {
    //Showing confirm message
    show(alertMessage);
    hide("#food-item-card");

    $("#reservation-cancel-message").css("height", "200px");
}

//Clears food card fields
function clearFoodItemData() {
    //Clearing fields and picture background
    $("#name-text").val("");
    $("#description-text").val("");
    $("#price-text").val("");

    document.getElementById("stars-div").innerHTML = "";
    $(".food-picture").css('background-image', "");
}

//Taking the current tab's id
function currentActiveTab(tabId) {
    tabID = tabId.replace("T", "");
}

//When he clicks on the add food button
function addFoodItem() {
    //Clears the fields
    clearFoodItemData();

    //Changing button's text
    $("#confirm").text("Create");

    //Showing the food card and background
    show("#food-item-card");
    show(background);

    //Changing to edit mode
    $("#food-item-card div").removeClass("view").addClass("edit");

    //Customizing style
    $("#food-name").css("width", "40%");
    $("#priceDiv").css("width", "50%");
    $("#priceDiv").css("margin-top", "40px");
    $("#priceDiv").css("margin-left", "10%");
    $("#priceDiv").css("margin-bottom", "0px");

    //Hiding the stars div and some buttons
    hide("#stars-div");
    hide(updateButton);
    hide(deleteButton);
    show(confirmButton);
    show("#image-picker");
}

//Closing the alert message
function discard() {
    //Hiding the alert message and showing back the reservation card or food card
    hide(alertMessage);
    show("#food-item-card");
}

/*
    Shopping array
    0 => Food name
    1 => Food Amount
    2 => Food Price
*/
var shoppingCart = [];

//Adds items to the shopping cart
function addToCart() {
    var itemExist = false;
    /*
        If he he adds an existing item, it won't be added as a new item instead it
        will increses the amount of the item
    */
    for (counter = 0; counter < shoppingCart.length; counter++) {
        if ($("#food-item-card #name-text").val() == shoppingCart[counter][0]) {
            shoppingCart[counter][1] = parseInt($("#food-item-card #amount-text").val()) + parseInt(shoppingCart[counter][1]);
            itemExist = true;
            break;
        }
    }

    //When he adds a new item it will be added to the array
    if (itemExist == false) {
        shoppingCart[shoppingCart.length] = [];
        shoppingCart[shoppingCart.length - 1][0] = $("#food-item-card #name-text").val();
        shoppingCart[shoppingCart.length - 1][1] = $("#food-item-card #amount-text").val();
        shoppingCart[shoppingCart.length - 1][2] = $("#food-item-card #price-text").val();
    }

    //Showing the shopping card button
    if (shoppingCart.length == 1)
        show("#make-order-button");

    updateShoppingCartNumber();
    //Clsoing the food card
    closePopUpWindow("#food-item-card");
}

//Shows the invoice
function showInvoice() {
    show("#invoice-card");
    show(background);

    printItemInCart();
}

//Updates shopping cart items number and controls number design
function updateShoppingCartNumber() {
    document.getElementById("items-number").innerText = shoppingCart.length;
    if (shoppingCart.length > 9)
        $("#items-number").css("padding-left", "4.9px");

    if (shoppingCart.length == 0)
        hide("#make-order-button");
}

//Showing shopping card items in the table
function printItemInCart() {
    $("tbody").html(" ");

    var counter;
    for (counter = 0; counter < shoppingCart.length; counter++) {
        document.getElementById('invoice-item-table').innerHTML += '<tr id="' + counter + '"><td id="name">' + shoppingCart[counter][0] + '</td><td>' + shoppingCart[counter][1] + '</td><td>' + (shoppingCart[counter][1] * shoppingCart[counter][2]) + '</td><td><span class="glyphicon glyphicon-remove delete-item-icon" aria-hidden="true" onclick="removeItem(' + counter + ');"></span></td></tr>';
    }
}

//Enabling order button only when amount > 0
function enableOrderButton() {
    $("#order").prop('disabled', false);
    if ($("#amount-text").val() <= 0)
        $("#order").prop('disabled', true);
}

//Deleting an item from the shopping cart
function removeItem(itemNumber) {
    $("#" + itemNumber).fadeOut();
    shoppingCart.splice(itemNumber, 1);

    printItemInCart();
    updateShoppingCartNumber();

    if (shoppingCart.length == 0)
        closePopUpWindow("#invoice-card");
}

//Showing more payment fields
function paymentMethodContorl() {
    if ($("#payment-method-select").val() != "Cash") {
        show("#credit-card-number-div");
        show("#cvc-div");
        show("#expire-date-div");
    } else {
        hide("#credit-card-number-div");
        hide("#cvc-div");
        hide("#expire-date-div");
    }
}

//Search food items
function searchFood(keyword) {
    var foodcards = document.getElementsByClassName("food-card");
    keyword = keyword.toLowerCase();
    for(var i = 0; i < foodcards.length; i++){
        if(!foodcards[i].getElementsByTagName("h1")[0].innerHTML.toLowerCase().includes(keyword)){
            foodcards[i].setAttribute("style", "display:none");
        }else{
            foodcards[i].setAttribute("style", "display:block");
        }
    }
}
