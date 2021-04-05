CREATE TABLE Product(
    prodId INT(4) NOT NULL AUTO_INCREMENT,
    prodName VARCHAR(30) NOT NULL,
    prodPicNameSmall VARCHAR(100) NOT NULL,
    prodPicNameLarge VARCHAR(100) NOT NULL,
    prodDescripShort VARCHAR(1000),
    prodDescripLong VARCHAR(3000),
    prodPrice DECIMAL(6,2) NOT NULL,
    prodQuantity INT(4) NOT NULL,

    CONSTRAINT pk_product PRIMARY KEY(prodID)
);

INSERT INTO Product(prodName,prodPicNameSmall,prodPicNameLarge,prodDescripShort,prodDescripLong,prodPrice,prodQuantity) VALUES
 ("Samsung Galaxy S21 5G ","oneSmall.jpg","oneLarge.jpg",
 "Samsung Galaxy S21 5G Smartphone with Wireless PowerShare, 8GB RAM, 6.2”, 5G, SIM Free, 128GB, Phantom Grey",
 "Created with an adaptive 120Hz, 6.2” Dynamic AMOLED, Infinity-O display, a 10MP selfie lens, along with rear 12MP Wide, 64MP Telephoto and 12MP Ultra Wide lenses, Samsung’s 5G enabled Galaxy S21 smartphone with GPS, NFC, enhanced Game Booster and Knox Vault, is filled with tech to provide a secure, pleasurable and premium user experience.",
 769.00,4),
 ("Samsung Galaxy S21 Ultra 5G","twoSmall.jpg","twoLarge.jpg",
 "Samsung Galaxy S21 Ultra 5G Smartphone with Wireless PowerShare, 12GB RAM, 6.8”, 5G, SIM Free, 128GB, Phantom Black",
 "Created with an adaptive 120Hz, 6.8”, WQHD+ Dynamic AMOLED, Infinity-O display, a 40MP selfie lens, along with rear 12MP Ultra Wide, 108MP Wide + 10MP Telephoto lenses, with Laser AF Time-of-Flight, Samsung’s 5G enabled Galaxy S21 Ultra smartphone with S Pen compatibility, GPS, NFC, enhanced Game Booster and Knox Vault, is filled with tech to provide a secure, pleasurable and premium user experience.",
 1149.00,5),
 ("Apple iPhone 11 Pro","threeSmall.jpg","threeLarge.jpg",
 "Apple iPhone 11 Pro, iOS, 5.8”, 4G LTE, SIM Free, 256GB, Midnight Green",
 "The iPhone 11 Pro has been created with a stainless steel and glass design, a 12MP triple‑camera system, great battery life, a superfast A13 Bionic chip and an OLED display. Get ready to capture even more of your special moments – like snapping ultra wide photos or shooting 4K video and then editing the footage directly on the iPhone 11 Pro itself.",
 899.00,10),
 ("Motorola G8 Power Lite","fourSmall.jpg","fourLarge.jpg",
 "Motorola G8 Power Lite Smartphone, Android, 4GB RAM, 6.5”, 4G LTE, SIM Free, 64GB, Arctic Blue",
 "The Motorola G8 Power Lite has been created with a huge 6.5” display, an 8MP selfie camera, along with a triple rear camera system, fingerprint recognition, GPS, a 3.5mm audio jack and a memory card slot.",
 119.95,3);

CREATE TABLE users (
  userId int(4) NOT NULL PRIMARY KEY,
  userType varchar(1) NOT NULL,
  userFName varchar(50) NOT NULL,
  userSName varchar(50) NOT NULL,
  userAddress varchar(50) NOT NULL,
  userPostCode varchar(50) NOT NULL,
  userTelNo varchar(50) NOT NULL,
  userEmail varchar(50) NOT NULL,
  userPassword varchar(50) NOT NULL
) ;

INSERT INTO users (userId, userType, userFName, userSName, userAddress, userPostCode, userTelNo, userEmail, userPassword) VALUES
(3, 'C', 'Master', 'Blaster', ' 43', '00130', '013812312393', 'sample@gmail.com', 'iit');

 CREATE TABLE orders(
	orderNo INT(4) PRIMARY KEY AUTO_INCREMENT,
    userId INT(4) NOT NULL,
    orderDateTime DATETIME NOT NULL,
    orderTotal decimal(8,2) DEFAULT 0.00,
    orderStatus VARCHAR(50) NOT NULL,
    FOREIGN KEY(userId) REFERENCES users(userId)
);

CREATE TABLE Order_Line(
	orderLineId INT(4) PRIMARY KEY AUTO_INCREMENT,
    orderNo INT(4) NOT NULL,
    prodId INT(4) NOT NULL,
    quantityOrdered INT(4) NOT NULL,
    subTotal decimal(8,2) DEFAULT 0.00,
    FOREIGN KEY(orderNo) REFERENCES orders(orderNO),
    FOREIGN KEY(prodId) REFERENCES product(prodId)
);