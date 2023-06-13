(() => {

    let rowCount = 0;
    let dataArray = []; // セル内のinputなどをバインドさせる？
    let totalAmount = 0;
    let mode = "create";

    const addRow = (data) => {
        // テンプレコピー
        // template要素を取得
        const template = document.getElementById('table-row-template');

        // template要素の内容を複製
        const clone = template.content.cloneNode(true);

        // 行内の各列にイベント付与する処理をしたい
        clone.querySelector("tr > td:nth-child(1)").innerHTML = rowCount + 1;
        for (let i = 2; i <= 6; i++) {
            clone.querySelector(`tr`).dataset.rowNum = rowCount;
            console.log(mode);
            if (mode === "edit" && i === 6) {
                clone.querySelector(`tr > td:nth-child(${i + 1}) > input`).dataset.rowNum = rowCount;
                clone.querySelector(`tr > td:nth-child(${i + 1}) > input`).addEventListener("change", onChangeInput);
            } else {
                clone.querySelector(`tr > td:nth-child(${i}) > input`).dataset.rowNum = rowCount;
                clone.querySelector(`tr > td:nth-child(${i}) > input`).addEventListener("change", onChangeInput);
            }
        }
        // console.log(data);
        if (data && !(data instanceof Event)) { // 更新画面の時
            clone.querySelector(`tr > td > input[data-col="name"]`).value = data["name"];
            clone.querySelector(`tr > td > input[data-col="count"]`).value = data["count"];
            clone.querySelector(`tr > td > input[data-col="unit-price"]`).value = data["unit-price"];
            clone.querySelector(`tr > td > input[data-col="application"]`).value = data["application"];
        }

        // ここも変えるべき？
        dataArray[rowCount] = {
            "name": "",
            "count": "1",
            "unit-price": "0",
            "application": "",
            "checkbox": false,
            "isDelivery": false
        };

        // div(id="container")の中に追加
        document.getElementById('table-body').appendChild(clone);


        document.getElementById("table-data").value = JSON.stringify(dataArray);

        rowCount++;
    }

    const removeRow = () => {
        // フィルター使わないように変える？
        dataArray.forEach((item, index) => {
            if (item !== undefined && item.checkbox) {
                dataArray[index] = undefined
                const childEle = document.getElementById("table-body").querySelector(`tr[data-row-num="${index}"]`)
                console.log(index, childEle);
                document.getElementById("table-body").removeChild(childEle);
            }
        });
        document.getElementById("table-data").value = JSON.stringify(dataArray.filter(Boolean)); // ここでnull削除
        calcAmount()
        // dataArray = dataArray.filter((item, index) => {
        //     if (!item.checkbox) {
        //         return true
        //     } else {
        //         const childEle = document.getElementById("table-body").querySelector(`tr[data-row-num="${index}"]`)
        //         console.log(index, childEle);
        //         document.getElementById("table-body").removeChild(childEle);
        //         return false
        //     }
        // })
    }

    const onChangeInput = (e) => {
        const colName = e.target.dataset.col
        const rowNum = e.target.dataset.rowNum

        dataArray[rowNum][colName] = colName !== "checkbox" ? e.target.value : e.target.checked

        console.log(dataArray);
        document.getElementById("table-data").value = JSON.stringify(dataArray);

        if (["count", "unit-price"].includes(colName)) calcAmount()

    }

    const calcAmount = () => {
        let amount = 0;
        for (let i = 0; i < dataArray.length; i++) {
            if (typeof dataArray[i] !== "undefined") amount += dataArray[i]["count"] * dataArray[i]["unit-price"]
        }
        totalAmount = amount
        document.querySelector(".total-amount-view>span:nth-child(2)").textContent = totalAmount
        document.getElementById("total-amount").value = totalAmount

    }

    const handlingSubmit = e => {
        const result = window.confirm('注文書を作成しますか？');
        if (!result) e.preventDefault(); // 「いいえ」の時は送信しない
        document.getElementById("table-data").value = JSON.stringify(dataArray.filter(Boolean)); // ここでnull削除

    }
    const handlingCancel = e => {
        const result = window.confirm('注文書を破棄しますか？');
        if (!result) e.preventDefault(); // 「いいえ」の時は送信しない
    }
    const handlingDelete = () => {
        const result = window.confirm('本当に注文書を取り消しますか？');
        if (!result) return; // 「いいえ」の時は送信しない

        // formを生成して送信
        // フォームの生成と送信処理
        // フォーム要素を作成
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/api/order-delete.php';

        // パラメーターの設定
        const orderId = document.createElement('input');
        orderId.type = 'hidden';
        orderId.name = 'order-id';
        orderId.value = document.getElementById('order-id').value; // 削除する注文のID

        // フォームにパラメーターを追加
        form.appendChild(orderId);

        // フォームを一時的にDOMに追加
        document.body.appendChild(form);

        // フォームを送信
        form.submit();

        // 送信後、フォームを削除
        document.body.removeChild(form);
    }
    const handlingDelivery = () => {
        const result = window.confirm('納品書を作成しますか？（変更がある場合は更新ボタンを押してください）');
        if (!result) return; // 「いいえ」の時は送信しない

        // 納品書を画面上で作成して表示？
        // PDFビューワー？
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/create-delivery.php';

        // パラメーターの設定
        const orderId = document.createElement('input');
        orderId.type = 'hidden';
        orderId.name = 'order-id';
        orderId.value = document.getElementById('order-id').value; // 削除する注文のID

        // フォームにパラメーターを追加
        form.appendChild(orderId);

        // フォームを一時的にDOMに追加
        document.body.appendChild(form);

        // フォームを送信
        form.submit();

        // 送信後、フォームを削除
        document.body.removeChild(form);
    }

    const onLoad = () => {
        document.getElementById("add-row-button")?.addEventListener("click", addRow)
        document.getElementById("remove-row-button")?.addEventListener("click", removeRow)
        document.getElementById("form-submit")?.addEventListener("click", handlingSubmit)
        document.getElementById("form-cancel")?.addEventListener("click", handlingCancel)
        document.getElementById("order-delete")?.addEventListener("click", handlingDelete)
        document.getElementById("order-delivery")?.addEventListener("click", handlingDelivery)

        if (document.querySelector("#header-contents > h1").textContent === "注文書内容") {
            mode = "edit";
        }

        const tableData = document.getElementById('table-data').value
        if (tableData !== "") {
            // console.log("データあり、テーブル作成");
            // console.log(tableData);
            const data_arr = JSON.parse(tableData)
            for (let i = 0; i < data_arr.length; i++) {
                // console.log(data_arr[i]);
                addRow(data_arr[i])
            }
            dataArray = data_arr;
        }
        const totalAmountStr = document.getElementById('total-amount').value
        if (totalAmountStr !== "") {
            totalAmount = parseInt(totalAmountStr);
        }
    }


    window.addEventListener('load', onLoad)

})()