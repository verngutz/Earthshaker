CREATE TABLE staff
(
	staffid INT NOT NULL AUTO_INCREMENT,
	stafflastname VARCHAR(20) NOT NULL, 
	stafffirstname VARCHAR(20) NOT NULL, 
	CONSTRAINT staff_pk PRIMARY KEY(staffid)
);

ALTER TABLE staff AUTO_INCREMENT = 10000000;

CREATE TABLE delivery
(
	deliveryid INT NOT NULL AUTO_INCREMENT, 
	deliverydate DATE NOT NULL,
	deliverytime TIME NOT NULL,
	staffid INT NOT NULL, 
	supplier VARCHAR(20) NOT NULL, 
	CONSTRAINT delivery_pk PRIMARY KEY(deliveryid), 
	CONSTRAINT delivery_fk_staff FOREIGN KEY(staffid) REFERENCES staff(staffid)
);

ALTER TABLE delivery AUTO_INCREMENT = 20000000;

CREATE TABLE clients
(
	clientid INT NOT NULL AUTO_INCREMENT, 
	clientname VARCHAR(20) NOT NULL, 
	CONSTRAINT client_pk PRIMARY KEY(clientid)
);

ALTER TABLE client AUTO_INCREMENT = 30000000;

CREATE TABLE salesagent
(
	agentid INT NOT NULL AUTO_INCREMENT, 
	agentlastname VARCHAR(20) NOT NULL, 
	agentfirstname VARCHAR(20) NOT NULL,
	clientid INT,
	CONSTRAINT agent_pk PRIMARY KEY(agentid), 
	CONSTRAINT agent_fk_client FOREIGN KEY(clientid) REFERENCES client(clientid)
);

ALTER TABLE salesagent AUTO_INCREMENT = 40000000;

CREATE TABLE invoice
(
	invoiceno INT NOT NULL AUTO_INCREMENT, 
	invoicedate DATE NOT NULL, 
	agentid INT NOT NULL, 
	CONSTRAINT invoice_pk PRIMARY KEY(invoiceno), 
	CONSTRAINT invoice_fk FOREIGN KEY (agentid) REFERENCES salesagent(agentid)
);

ALTER TABLE invoice AUTO_INCREMENT = 50000000;

CREATE TABLE batch
(
	batchno INT NOT NULL AUTO_INCREMENT, 
	batchdate DATE NOT NULL, 
	agentid INT NOT NULL, 
	issuer VARCHAR(20) NOT NULL, 
	CONSTRAINT batch_pk PRIMARY KEY(batchno), 
	CONSTRAINT batch_fk_agent FOREIGN KEY(agentid) REFERENCES salesagent(agentid)
);

ALTER TABLE batch AUTO_INCREMENT = 60000000;

CREATE TABLE item
(
	itemcode INT NOT NULL AUTO_INCREMENT, 
	description VARCHAR(100), 
	srp DECIMAL(7,2),
	CONSTRAINT item_pk PRIMARY KEY(itemcode)
);

ALTER TABLE item AUTO_INCREMENT = 70000000;

CREATE TABLE discount
(
	clientid INT NOT NULL, 
	itemcode INT NOT NULL,
	amount DECIMAL(2,2) NOT NULL,
	CONSTRAINT discount_pk PRIMARY KEY(clientid, itemcode), 
	CONSTRAINT discount_fk_client FOREIGN KEY(clientid) REFERENCES client(clientid), 
	CONSTRAINT discount_fk_item FOREIGN KEY(itemcode) REFERENCES item(itemcode)
);

CREATE TABLE deliveryxitem
(
	deliveryid INT NOT NULL, 
	itemcode INT NOT NULL,
	cost DECIMAL(7,2) NOT NULL,
	quantity INT NOT NULL, 
	CONSTRAINT di_pk PRIMARY KEY(deliveryid, itemcode), 
	CONSTRAINT di_fk_del FOREIGN KEY(deliveryid) REFERENCES delivery(deliveryid), 
	CONSTRAINT di_fk_item FOREIGN KEY(itemcode) REFERENCES item(itemcode)
);

CREATE TABLE itemxinvoice
(
	itemcode INT NOT NULL, 
	invoiceno INT NOT NULL, 
	quantity INT NOT NULL,
	cost DECIMAL(7,2) NOT NULL,
	CONSTRAINT ii_pk PRIMARY KEY(itemcode, invoiceno), 
	CONSTRAINT ii_fk_item FOREIGN KEY(itemcode) REFERENCES item(itemcode), 
	CONSTRAINT ii_fk_invoice FOREIGN KEY(invoiceno) REFERENCES invoice(invoiceno)
);

CREATE TABLE itemxbatch
(
	itemcode INT NOT NULL, 
	batchno INT NOT NULL, 
	quantity INT NOT NULL, 
	CONSTRAINT ib_pk PRIMARY KEY(itemcode, batchno), 
	CONSTRAINT ib_fk_item FOREIGN KEY(itemcode) REFERENCES item(itemcode), 
	CONSTRAINT ib_fk_batch FOREIGN KEY(batchno) REFERENCES batch(batchno)
);

CREATE TABLE itemreturn
(
	batchno INT NOT NULL, 
	returndate DATE NOT NULL, 
	CONSTRAINT itemreturn_pk PRIMARY KEY (batchno), 
	CONSTRAINT itemreturn_fk FOREIGN KEY(batchno) REFERENCES batch(batchno)
);

CREATE TABLE transfer
(
	transferno INT NOT NULL AUTO_INCREMENT, 
	sourcebatch INT NOT NULL, 
	desbatch INT NOT NULL, 
	transferdate DATE NOT NULL, 
	itemcode INT NOT NULL, 
	quantity INT NOT NULL, 
	CONSTRAINT transfer_pk PRIMARY KEY(transferno), 
	CONSTRAINT transfer_fk_sourceb FOREIGN KEY(sourcebatch) REFERENCES batch(batchno), 
	CONSTRAINT transfer_fk_desb FOREIGN KEY(desbatch) REFERENCES batch(batchno), 
	CONSTRAINT transfer_fk_item FOREIGN KEY(itemcode) REFERENCES item(itemcode)
);

ALTER TABLE transfer AUTO_INCREMENT = 80000000;

CREATE TABLE manager
(
	managerid INT NOT NULL AUTO_INCREMENT,
	managerlastname VARCHAR(20) NOT NULL,
	managerfirstname VARCHAR(20) NOT NULL,
	CONSTRAINT manager_pk PRIMARY KEY(managerid)
);

ALTER TABLE manager AUTO_INCREMENT = 90000000;

INSERT INTO manager (managerlastname, managerfirstname) VALUES('Vitug', 'Fernando');
INSERT INTO staff (stafflastname, stafffirstname) VALUES('Anupol', 'Robin');
INSERT INTO salesagent (agentlastname, agentfirstname, clientid) VALUES('Chua', 'Janine', NULL);