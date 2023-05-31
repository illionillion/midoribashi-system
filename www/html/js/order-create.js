(() => {

    let rowCount = 0;
    let dataArray = []; // セル内のinputなどをバインドさせる？

    const addRow = () => {
        // テンプレコピー
        // template要素を取得
        const template = document.getElementById('table-row-template');

        // template要素の内容を複製
        const clone = template.content.cloneNode(true);

        // 行内の各列にイベント付与する処理をしたい
        clone.querySelector("tr > td:nth-child(1)").innerHTML = rowCount + 1;
        for (let i = 2; i <= 6; i++) {
            clone.querySelector(`tr`).dataset.rowNum = rowCount;
            clone.querySelector(`tr > td:nth-child(${i}) > input`).dataset.rowNum = rowCount;
            clone.querySelector(`tr > td:nth-child(${i}) > input`).addEventListener("change", onChangeInput);
        }

        dataArray[rowCount] = {
            "name": "",
            "count": "1",
            "unit-price": "0",
            "application": "",
            "checkbox": false
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

    }

    const onLoad = () => {
        document.getElementById("add-row-button").addEventListener("click", addRow)
        document.getElementById("remove-row-button").addEventListener("click", removeRow)
    }

    window.addEventListener('load', onLoad)

})()