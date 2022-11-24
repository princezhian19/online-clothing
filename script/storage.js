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
            const existed = items.find(oldItem => oldItem.item_id == item.item_id);
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
        $.ajax({
            url:_base_url_+"api/purchaseorder/index.php",
            method: 'POST',
            type: 'POST',
            data: {
                orders: storage.getItems('tableItems'),
                tax: 0,
                discount: 0,
                save_po: true
            },
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
                unit: item.unit, quantity: item.quantity, name: item.name, cost: item.cost, total: item.total
            })
        })
    }
}