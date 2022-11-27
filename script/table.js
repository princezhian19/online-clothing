const tbl = {
    clear: (key) => {
        $('#'+key).empty();
    },
    addRow: (id, item) => {
        var table = document.getElementById(id);
        var row = table.insertRow(0);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);
        var cell6 = row.insertCell(5);
        var cell7 = row.insertCell(6);
        var cell8 = row.insertCell(7);
        cell1.innerHTML = item.unit;
        cell2.innerHTML = item.size;
        cell3.innerHTML = item.color;
        cell4.innerHTML = item.quantity;
        cell5.innerHTML = item.name;
        cell6.innerHTML = item.cost;
        cell7.innerHTML = item.total;
        cell8.innerHTML = `<button name="delete_SupplierItem" id="b-${item.item_id}" type="button" class="btn btn-sm btn-danger deleteProduct" onclick='tbl.removeRow(${JSON.stringify(item)})'>Delete</button>`;
    },
    removeRow: (item) => {
        $(`#b-${item.item_id}`).closest("tr").remove();
        storage.removeItem('tableItems',item);
    }
}