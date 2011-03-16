CREATE TABLE staff
(staffid int not null, stafflname varchar(20) not null, stafffname varchar(20) not null, constraint staffkey primary key(staffid));

CREATE TABLE delivery
(deliveryid int not null, deliverydate DATE not null, deliverytime time not null, staffid int not null, supplier varchar(20) not null, constraint delivery_pk primary key(deliveryid), constraint delivery_fk_staff foreign key(staffid) REFERENCES staff(staffid));

CREATE TABLE invoice
(invoiceno int not null, invoicedate DATE not null, constraint invoicekey primary key(invoiceno));

CREATE TABLE client
(clientid int not null, clientname varchar(20) not null, constraint client_pk primary key(clientid));

CREATE TABLE salesagent
(agentid int not null, agentlastname varchar(20) not null, agentfirstname varchar(20) not null, clientid int not null, constraint agent_pk primary key(agentid), constraint agent_fk_client foreign key(clientid) references client(clientid));

CREATE TABLE batch
(batchno int not null, batchdate DATE not null, agentid int not null, issuer varchar(20) not null, constraint batch_pk primary key(batchno), constraint batch_fk_agent foreign key(agentid) REFERENCES salesagent(agentid));

CREATE TABLE item
(itemcode int not null, description varchar(100), srp decimal(7,2), constraint item_pk primary key(itemcode));

CREATE TABLE discount
(clientid int not null, itemcode int not null, amount decimal(2,2) not null, constraint discount_pk primary key(clientid, itemcode), constraint discount_fk_client foreign key(clientid) references client(clientid), constraint discount_fk_item foreign key(itemcode) references item(itemcode));

CREATE TABLE deliveryxitem
(deliveryid int not null, itemcode int not null, cost decimal(7,2) not null, quantity int not null, constraint di_pk primary key(deliveryid, itemcode), constraint di_fk_del foreign key(deliveryid) REFERENCES delivery(deliveryid), constraint di_fk_item foreign key(itemcode) REFERENCES item(itemcode));

CREATE TABLE itemxinvoice
(itemcode int not null, invoiceno int not null, quantity int not null, cost decimal(7,2) not null, constraint ii_pk primary key(itemcode, invoiceno), constraint ii_fk_item foreign key(itemcode) REFERENCES item(itemcode), constraint ii_fk_invoice foreign key(invoiceno) REFERENCES invoice(invoiceno));

CREATE TABLE itemxbatch
(itemcode int not null, batchno int not null, quantity int not null, constraint ib_pk primary key(itemcode, batchno), constraint ib_fk_item foreign key(itemcode) REFERENCES item(itemcode), constraint ib_fk_batch foreign key(batchno) REFERENCES batch(batchno));

CREATE TABLE itemreturn
(batchno int not null, returndate DATE not null, constraint itemreturn_pk primary key (batchno), constraint itemreturn_fk foreign key(batchno) REFERENCES batch(batchno));

CREATE TABLE transfer
(transferno int not null, sourcebatch int not null, desbatch int not null, transferdate DATE not null, itemcode int not null, quantity int not null, constraint transfer_pk primary key(transferno), constraint transfer_fk_sourceb foreign key(sourcebatch) REFERENCES batch(batchno), constraint transfer_fk_desb foreign key(desbatch) REFERENCES batch(batchno), constraint transfer_fk_item foreign key(itemcode) REFERENCES item(itemcode));