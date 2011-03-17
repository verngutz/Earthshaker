CREATE TABLE staff
(
	staffid INT NOT NULL AUTO_INCREMENT, 
	stafflname VARCHAR(20) NOT NULL, 
	stafffname VARCHAR(20) NOT NULL, 
	CONSTRAINT staffkey PRIMARY KEY(staffid)
);

CREATE TABLE delivery
(
	deliveryid INT NOT NULL AUTO_INCREMENT, 
	deliverydate DATE NOT NULL, 
	deliverytime time NOT NULL, 
	staffid INT NOT NULL, 
	supplier VARCHAR(20) NOT NULL, 
	CONSTRAINT delivery_pk PRIMARY KEY(deliveryid), 
	CONSTRAINT delivery_fk_staff FOREIGN KEY(staffid) REFERENCES staff(staffid)
);

CREATE TABLE client
(
	clientid INT NOT NULL AUTO_INCREMENT, 
	clientname VARCHAR(20) NOT NULL, 
	CONSTRAINT client_pk PRIMARY KEY(clientid)
);

CREATE TABLE salesagent
(
	agentid INT NOT NULL AUTO_INCREMENT, 
	agentlastname VARCHAR(20) NOT NULL, 
	agentfirstname VARCHAR(20) NOT NULL, 
	clientid INT NOT NULL, 
	CONSTRAINT agent_pk PRIMARY KEY(agentid), 
	CONSTRAINT agent_fk_client FOREIGN KEY(clientid) REFERENCES client(clientid)
);

CREATE TABLE invoice
(
	invoiceno INT NOT NULL AUTO_INCREMENT, 
	invoicedate DATE NOT NULL, 
	agentid INT NOT NULL, 
	CONSTRAINT invoice_pk PRIMARY KEY(invoiceno), 
	CONSTRAINT invoice_fk FOREIGN KEY (agentid) REFERENCES salesagent(agentid)
);

CREATE TABLE batch
(
	batchno INT NOT NULL AUTO_INCREMENT, 
	batchdate DATE NOT NULL, 
	agentid INT NOT NULL, 
	issuer VARCHAR(20) NOT NULL, 
	CONSTRAINT batch_pk PRIMARY KEY(batchno), 
	CONSTRAINT batch_fk_agent FOREIGN KEY(agentid) REFERENCES salesagent(agentid)
);

CREATE TABLE item
(
	itemcode INT NOT NULL, 
	description VARCHAR(100), 
	srp DEC(7,2), 
	CONSTRAINT item_pk PRIMARY KEY(itemcode)
);

CREATE TABLE discount
(
	clientid INT NOT NULL, 
	itemcode INT NOT NULL, 
	amount DEC(2,2) NOT NULL, 
	CONSTRAINT discount_pk PRIMARY KEY(clientid, itemcode), 
	CONSTRAINT discount_fk_client FOREIGN KEY(clientid) REFERENCES client(clientid), 
	CONSTRAINT discount_fk_item FOREIGN KEY(itemcode) REFERENCES item(itemcode)
);

CREATE TABLE deliveryxitem
(
	deliveryid INT NOT NULL, 
	itemcode INT NOT NULL, 
	cost DEC(7,2) NOT NULL, 
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
	cost DEC(7,2) NOT NULL, 
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

CREATE TABLE manager
(
	managerid INT NOT NULL,
	CONSTRAINT manager_pk PRIMARY KEY(managerid)
);

ALTER TABLE staff AUTO_INCREMENT=10000;
ALTER TABLE delivery AUTO_INCREMENT=20000;
ALTER TABLE client AUTO_INCREMENT=30000;
ALTER TABLE salesagent AUTO_INCREMENT=40000;
ALTER TABLE invoice AUTO_INCREMENT=50000;
ALTER TABLE batch AUTO_INCREMENT=60000;
ALTER TABLE transfer AUTO_INCREMENT=70000;

INSERT INTO item VALUES (12345, 'COFFEE', 50);