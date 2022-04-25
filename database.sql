CREATE TABLE IF NOT EXISTS `kind`
(
    `id_k` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name_k` varchar(255) NOT NULL
);

INSERT INTO `kind` (`name_k`) VALUES
    ('coffee'),
    ('macchiato'),
    ('tea'),
    ('smoothy'),
    ('cake');

CREATE TABLE IF NOT EXISTS `product`
(
    `id_p` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name_p` varchar(255) NOT NULL,
    `pic` varchar(255) NOT NULL,
    `ingredient` varchar(255),
    `price` float(10) NOT NULL,
    `id_k` int(10) NOT NULL,
    FOREIGN KEY (id_k) REFERENCES kind(id_k)
);

INSERT INTO `product` (`id_p`, `name_p`, `pic`, `ingredient`, `price`, `id_k`) VALUES
    ('1', 'Black Coffee Ice', 'https://product.hstatic.net/1000075078/product/ca-phe-den-da_6e25255ae31c4f3bbbb502f77e2c100d_large.jpg', 'Coffee' , '29000','1'),
    ('2', 'Milk Coffee Ice', 'https://product.hstatic.net/1000075078/product/ca-phe-sua-da_b00c53d18cd84144a164790323106a2f_large.jpg', 'Coffee, milk' , '32000','1'),
    ('3', 'Coffee Fresh With Milk Ice', 'https://product.hstatic.net/1000075078/product/bac-siu-da_9bf82220a1a54847aa7357de541e7552_large.jpg','Coffee, milk, condensed milk' ,'32000','1'),
    ('4', 'Caramel Macchiato Ice', 'https://product.hstatic.net/1000075078/product/caramel-macchiato-da_fa2503073e5c4f7a98516f1c9d39253b_large.jpg','Espresso, milk foam, milk' ,'49000','2'),
    ('5', 'Latte Ice', 'https://product.hstatic.net/1000075078/product/latte-da_438410_400x400_a48fbcd0a33f4ceba1803acbbe1292f4_large.jpg', 'Espresso, milk' ,'49000','1'),
    ('6', 'Logan Lotus Tea' , 'https://product.hstatic.net/1000075078/product/tra-sen-nhan_f58fc9ad254847b1beb3cdfbaa1bd6b5_large.jpg', 'Tea, logan, lotus' ,'58000','3'),
    ('7', 'Orange Peach tea', 'https://product.hstatic.net/1000075078/product/tra-dao-cam-xa_668678_400x400_207c526c987c4026877ebae748c62afd_large.jpg','Tea, orange, peach','45000','3'),
    ('8', 'Smoothy Matcha', 'https://product.hstatic.net/1000075078/product/matchadaxay_622077_400x400_5c617ff524e64e638ad7c868613a832b_large.jpg','Matcha, milk, cream', '58000','4'),
    ('9', 'Smoothy Blueberry Peach', 'https://product.hstatic.net/1000075078/product/daovietquat_033985_400x400_20bfc56b971c47dca8734514a4765675_large.jpg','Blueberry, peach, cream' ,'58000','4'),
    ('10', 'Smoothy Blueberry', 'https://product.hstatic.net/1000075078/product/sinh-to-viet-quoc_145138_400x400_ab271b0cd8be42089cd7e25f985c273e_large.jpg', 'Blueberry, milk, cream' ,'58000','4'),
    ('11', 'Mousse Tiramasu', 'https://product.hstatic.net/1000075078/product/mousse-tiramisu_d396a927d9ba4af284450066bd391148_large.jpg', '' ,'32000','5'),
    ('12', 'Mousse Passion Cheese', 'https://product.hstatic.net/1000075078/product/5d92fbc79e12b47db8cabbd0_chanh-day_994413_400x400_333c9a63c0f74d41a11333c637127328_large.jpg', '' ,'32000','5'),
    ('13', 'Milk Tea Macadamia', 'https://product.hstatic.net/1000075078/product/tra-sua-mac-ca_377522_400x400_123ab6b1593d4e5c83776a54f6862bbd_large.jpg', 'Tea, macadamia milk, white pearl' ,'49000','3'),
    ('14', 'Black Tea Latte Macchiato', 'https://file.hstatic.net/1000075078/file/hong_tra_latte_macchiato_2e591eb8b5c544bbbfd2d33b708ca0aa.jpeg', 'Black tea, milk, milk foam', '54000','2');


CREATE TABLE IF NOT EXISTS `order_customer` 
(
    `id_order` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `number_customer` varchar(10) NOT NULL,
    `name_customer` varchar(255) NOT NULL,
    `date_order` datetime NOT NULL,
    `address_customer` varchar(255) NOT NULL,
    `card_customer` varchar(12) NOT NULL,
    `total` float(11) NOT NULL
);

CREATE TABLE IF NOT EXISTS `detail_order`
(
    `name_product` varchar(255) NOT NULL,
    `quantity` int(11) NOT NULL,
    `price_product` int(11) NOT NULL,
    `id_order` int(11) NOT NULL,
    FOREIGN KEY (id_order) REFERENCES order_customer(id_order),
    `id_p` int(10) NOT NULL,
    FOREIGN KEY (id_p) REFERENCES product(id_p)
);