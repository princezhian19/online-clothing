const loadItems = () => {
    $.ajax({
        url:_base_url_+"api/supplier_items.php",
        cache: false,
        contentType: false,
        processData: false,
        method: 'GET',
        type: 'GET',
        dataType: 'json',
        success: (resp) => {
            localStorage.setItem('suppliers_items', JSON.stringify(resp.supplier_products))
            localStorage.setItem('suppliers', JSON.stringify(resp.suppliers))
        }
    })
}

const storage = {
    getItems: (key) => {
        const items = localStorage.getItem(key);
        if(!items) {
            return []
        }else {
            return JSON.parse(items);
        }
    },
    addItem: (key, item) => {
        const items = storage.getItems(key);
        if(!items) {
            localStorage.setItem(key, JSON.stringify([item]));
        }else {
            const existed = items.find(oldItem => {
                if(oldItem.item_id == item.item_id && oldItem.size == item.size && oldItem.color == item.color ) {
                    return true;
                }
                return false;
            });
            if(existed) {
                existed.quantity = Number(item.quantity) + Number(existed.quantity);
            }else {
                items.push(item)
            }
            localStorage.setItem(key, JSON.stringify(items));
        }
    },
    removeItem: (key, item) => {
        console.log(item);
        const items = storage.getItems(key);
        console.log(items);
        const newItems = items.filter(supItem => supItem.item_id != item.item_id);
        localStorage.setItem(key, JSON.stringify(newItems));
    },
    saveOrders: (key) => {
        var  formdata = new FormData();
        formdata.append('orders', JSON.stringify(storage.getItems('tableItems')));
        formdata.append('tax', 0);
        formdata.append('discount', 0);
        formdata.append('save_po', true);
        $.ajax({
            url:_base_url_+"api/purchaseorder/index.php",
            method: 'POST',
            processData: false,
            contentType: false,
            cache: false,
            type: 'POST',
            data: formdata,
            success: (resp) => {
                localStorage.setItem('tableItems', JSON.stringify([]));
                const currentOrders = storage.getItems('tableItems');
                tbl.clear('orders');
                currentOrders.map((item) => {
                    tbl.addRow('orders', {
                        item_id: item.item_id,
                        unit: item.unit, quantity: item.quantity, name: item.name, cost: item.cost, total: item.total
                    })
                })
            }
        })
    },
    loadTableItems: () => {
        const currentOrders = storage.getItems('tableItems');
        tbl.clear('orders');
        currentOrders.map((item) => {
            tbl.addRow('orders', {
                item_id: item.item_id,
                unit: item.unit, quantity: item.quantity, name: item.name, cost: item.cost, total: item.total, size: item.size, color: item.color
            })
        })
    },
    getItemNameById: (id) => {
       const item = storage.getItems('suppliers_items').find(si => si.id == id)
       if(item) return item;
       return '';                     
    },
    receiveOrders(code) {
        var  formdata = new FormData();
        formdata.append('receive', true);
        formdata.append('code', code);
        $.ajax({
            url:_base_url_+"api/purchaseorder/index.php",
            method: 'POST',
            processData: false,
            contentType: false,
            cache: false,
            type: 'POST',
            data: formdata,
            success: (resp) => {
                
            }
        })
    }
}

