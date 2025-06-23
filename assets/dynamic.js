function addRow() {
    var tableRows = document.getElementById('Rows');

    var content = `
    <tr class="border-0">
        <td class="border-0 align-middle">
            <input type="text" name="item_name[]"
                id="item"
                class="item border rounded-1 form-control input-field w-100"
                placeholder="Description of Item / Service..">
        </td>
        <td class="border-0 align-middle">
            <input type="number"
                name="item_quantity[]" id="qty"
                class="qty text-end form-control border rounded-1 input-field w-100"
                value="1">
        </td>
        <td class="border-0 align-middle">
            <div
                class="input-group border rounded-1">
                    <span
                        class="input-group-text border-0 bg-light currency_sign">₹</span>
                    <input type="number"
                                                                                                name="item_amount[]"
                                                                                                id="rate"
                                                                                                class="rate border-0 text-end form-control input-field"
                                                                                                value="0">
                                                                                </div>
                                                                        </td>
                                                                        <td class="border-0 text-center align-middle">
                                                                                <span class="currency_sign">₹</span>
                                                                                <input class="item-total input-item-total" value="0.00" readonly>
                                                                                </span>
                                                                        </td>
                                                                </tr>
        `;

    tableRow
}

