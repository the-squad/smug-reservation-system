var foodRowID;

function fillInvoiceData(rowData, rowId) {
    //Assigning row's id
    foodRowID = rowId;

    //Showing invoce card and background
    show("#invoice-card");
    show(background);

    //Deleting elements
    $("#delete-row").remove()
    $("#checkout").remove();
}
