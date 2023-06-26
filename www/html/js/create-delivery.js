(() => {

    let dataArray = [];
    let rowCount = 0;
    let totalAmount = 0;
    let totalAmountDiff = 0;

    const getCurrentDate = () => {
        const date = new Date();

        const yyyy = date.getFullYear();
        const mm = ("0" + (date.getMonth() + 1)).slice(-2);
        const dd = ("0" + date.getDate()).slice(-2);

        return yyyy + '-' + mm + '-' + dd;
    }

    const addRow = (data, index) => {
        if(data["isDelivery"]) {
            rowCount++;
            return
        }
        // template要素を取得
        const template = document.getElementById('table-row-template');

        // template要素の内容を複製
        const clone = template.content.cloneNode(true);

        // 行内の各列にイベント付与する処理をしたい
        clone.querySelector("tr > td:nth-child(1)").innerHTML = rowCount + 1;
        for (let i = 2; i <= 7; i++) {
            clone.querySelector(`tr`).dataset.rowNum = rowCount;
            clone.querySelector(`tr > td:nth-child(${i}) > :first-child`).dataset.rowNum = rowCount;
            if(i===7) clone.querySelector(`tr > td:nth-child(${i}) > input`).addEventListener("change", onChangeInput);
        }
        // console.log(data);
        if (data && !(data instanceof Event)) { // 更新画面の時
            clone.querySelector(`tr > td > p[data-col="name"]`).textContent = data["name"];
            clone.querySelector(`tr > td > p[data-col="count"]`).textContent = data["count"];
            clone.querySelector(`tr > td > p[data-col="unit-price"]`).textContent = data["unit-price"];
            clone.querySelector(`tr > td > p[data-col="application"]`).textContent = data["application"];
            clone.querySelector(`tr > td > p[data-col="order-date"]`).textContent = data["order-date"].replaceAll('-', '/');
            // if(data["isDelivery"]) {
            //     clone.querySelector(`tr`).style.display = 'none'
            // }
        }

        // dataArray[rowCount] = {
        //     "name": "",
        //     "count": "1",
        //     "unit-price": "0",
        //     "application": "",
        //     "checkbox": false
        // };

        // div(id="container")の中に追加
        document.getElementById('table-body').appendChild(clone);


        document.getElementById("table-data").value = JSON.stringify(dataArray);

        rowCount++;
    }

    const onChangeInput = (e) => {
        const colName = e.target.dataset.col
        const rowNum = e.target.dataset.rowNum

        // dataArray[rowNum][colName] = colName !== "isDelivery" ? e.target.value : e.target.checked
        dataArray[rowNum]["isDelivery"] = e.target.checked
        dataArray[rowNum]["delivery-date"] = e.target.checked ? getCurrentDate() : "";

        console.log(dataArray);
        document.getElementById("table-data").value = JSON.stringify(dataArray);

        calcAmount()

        // if (["count", "unit-price"].includes(colName)) calcAmount()

    }

    const calcAmount = () => {
        let amount = 0;
        for (let i = 0; i < dataArray.length; i++) {
            if (typeof dataArray[i] !== "undefined" && dataArray[i]["isDelivery"]) amount += dataArray[i]["count"] * dataArray[i]["unit-price"]
        }
        console.log(totalAmountDiff);
        totalAmount = amount - totalAmountDiff
        document.querySelector(".total-amount-view>span:nth-child(2)").textContent = totalAmount
        document.getElementById("completed-amount").value = totalAmount
    }
    const calcAmountDiff = () => {
        let amount = 0;
        for (let i = 0; i < dataArray.length; i++) {
            if (typeof dataArray[i] !== "undefined" && dataArray[i]["isDelivery"]) amount += dataArray[i]["count"] * dataArray[i]["unit-price"]
        }
        console.log(amount);
        totalAmountDiff = amount
    }

    const handlingSubmit = e => {
        const result = window.confirm('納品書を作成しますか？');
        if (!result) e.preventDefault(); // 「いいえ」の時は送信しない
    }
    const handlingCancel = e => {
        const result = window.confirm('納品書を破棄しますか？');
        if (!result) e.preventDefault(); // 「いいえ」の時は送信しない
    }

    const onLoad = () => {
        document.getElementById("form-submit")?.addEventListener("click", handlingSubmit)
        document.getElementById("form-cancel")?.addEventListener("click", handlingCancel)

        const tableData = document.getElementById('table-data').value
        console.log(tableData);
        if (tableData !== "") {
            // console.log("データあり、テーブル作成");
            // console.log(tableData);
            const data_arr = JSON.parse(tableData)
            dataArray = data_arr;
            calcAmountDiff()
            for (let i = 0; i < data_arr.length; i++) {
                // console.log(data_arr[i]);
                addRow(data_arr[i], i)
            }
        }
        // const totalAmountStr = document.getElementById('total-amount').value
        // if (totalAmountStr !== "") {
        //     totalAmount = parseInt(totalAmountStr);
        // }
    }
    window.addEventListener('load', onLoad)
})()