/* SQL Brand name */
SELECT name FROM brands;

/* SQL Outlet name, address, longitude, latitude */
SELECT name,address,longitude,latitude FROM outlets;

/* SQL Total product */
SELECT count(id) AS total_product FROM products;

/* SQL Distance Outlet position from Monas Jakarta in Kilometers */
/* Monas jakarta longitude: 106.827153 latitude: -6.175392 */
/* Since ST_Distance_Sphere calculate in meters then we need to convert it to KM (divide by 1000)
   and round it with 2 number behind comma */
SELECT name, ROUND(
            ST_Distance_Sphere(
                    point(106.827153, -6.175392),
                    point(longitude, latitude)
                ) / 1000, 2) AS distance_from_monas_in_km
FROM outlets;

/* SQL all required data in 1 query */
/* and sort by closest from Monas*/
SELECT
    b.name as brand_name,
    o.name as outlet_name,
    o.address as address,
    o.longitude,
    o.latitude,
    ROUND(
        ST_Distance_Sphere(
            point(106.827153, -6.175392),
            point(o.longitude, o.latitude)
        ) / 1000, 2
    ) AS distance_from_monas_in_km,
    (SELECT count(id) FROM products WHERE brand_id = b.id) AS total_product_by_brand
FROM brands as b
JOIN outlets as o on o.brand_id = b.id
ORDER BY distance_from_monas_in_km ASC;
