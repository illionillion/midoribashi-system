# ER図

```:mermaid
erDiagram

employees {
    varchar(255) employee_id PK "従業員ID"
    varchar(255) employee_name "従業員名"
    varchar(255) phone_number "電話番号"
    varchar(255) email "メールアドレス"
    varchar(255) password "パスワード"
    datetime created_at "登録日"
    datetime updated_at "更新日"
    int(11) role "権限（0：管理者, 1：一般）"
}

orders {
    int(11) order_id PK "注文ID"
    int customer_id FK "顧客ID"
    varchar(255) remarks "概要" 
    longtext table_data "注文商品データ"
    varchar(255) employee_id FK "従業員ID（登録者）"
    decimal total_amount "合計金額"
    date create_date "登録日"
    date update_date "更新日"
}

customers {
    int customer_id PK "顧客ID"
    varchar(255) customer_name "顧客名"
    varchar(255) post_code "郵便番号"
    varchar(255) address "住所"
    varchar(255) phone_number "電話番号"
    varchar(255) fax_number "FAX番号"
    varchar(255) email "メールアドレス"
}

table_data {
    string name "商品名"
    int count "個数"
    int unit-price "商品価格"
    string application "概要"
    date order-date "注文日"
    date delivery-date "納品日"
    boolean isDelivery "納品・未納品"
}

delivery_history {
    int delivery_id PK "納品ID"
    int order_id FK "注文ID"
    int customer_id FK "顧客ID"
    int employee_id FK "従業員ID"
    date delivery_date "納品日"
    longtext delivery_table "納品商品データ（table_dataと同じ）"
    decimal total_amount "合計金額"
}

employees ||--o{ customers : "1名の従業員は0名以上の顧客データを登録できる"
customers ||--|| orders : "1名の顧客は1つの注文データを持つ"
orders ||--|| table_data : "1つの注文は1つの注文商品データを持つ"
orders ||--o{ delivery_history : "1つの注文データは0以上の納品履歴を持つ"

```