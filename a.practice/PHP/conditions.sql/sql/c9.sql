-- 1. priceが500円以上から1,000円以下の商品データを取得する

select *
from
  products
where
  price between 500 and 1000

select *
from
  products
where
  price >= 500
  and price <= 1000


-- 2. idが3以上で、priceが500円以上の商品データを取得する

select *
from
  products
where
  id >= 3
  and price >= 500


-- 3. priceが1,500円以下で、「傘」を除く商品データを取得する

select *
from
  products
where
  price <= 1500
  and name != '傘'

