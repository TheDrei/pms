ORIGINAL
CREATE OR REPLACE VIEW viewequipment AS
SELECT
	a.*,
	b.subclass_id,
	b.class_id,
	b.subclass_description,
	b.class_description,
	(SELECT COUNT(id) FROM employee__equipments WHERE equip_id = a.id AND equip_status NOT IN(3,4) ) AS total_quantity,
	(b.subclass_description) AS subcat_desc
FROM
	equipment AS a,
	viewclassification AS b
WHERE
	a.prop_cat = b.class_id
AND 
    a.prop_subcat = b.subclass_id




NEW
CREATE OR REPLACE VIEW viewequipmentnew AS
SELECT
	e.component_name,
	e.serial_num,
	a.*,
	d.equip_id,
	d.prop_val,
	d.equip_issued_to,
	(SELECT COUNT(id) FROM equipment__histories WHERE equip_id = a.id AND equip_status NOT IN(3,4) ) AS total_quantity,
	(b.subclass_description) AS subcat_desc
FROM
	equipment AS a,
	viewclassification AS b,
	equipment__histories AS c,
	equipment_sets AS d, 
	equipment_sets_components AS e
WHERE
	a.prop_cat = b.class_description
AND 
    a.prop_subcat = b.subclass_description
AND 
    a.id = d.equip_id
AND 
    d.id = e.set_id
AND
    a.id = c.employee_equipment_id


CREATE OR REPLACE VIEW viewequipmentemployees AS
SELECT
	a.*,
	(b.id) AS empequip_id,b.equip_serial_num,b.equip_quantity,b.equip_status,b.equip_date_acquired,b.equip_remarks,
	c.name,c.fullname,
	d.status_desc
FROM
	viewequipmentnew AS a,
	employee__equipments AS b,
	dts.users AS c,
	statuses AS d,
	equipment_sets AS e
WHERE
	a.id = b.equip_id
	AND
	c.name = b.user_empcode
	AND
	b.equip_status = d.id


NEW viewequipmentemployees
CREATE OR REPLACE VIEW viewequipmentemployees AS
SELECT
	a.*,
	b.status_desc
FROM
	equipment__histories AS a,
	statuses AS b
WHERE
    a.equip_status = b.id
    
ENDOF NEW


CREATE VIEW viewcategory AS
SELECT
	(b.id) AS subcat_id,
	b._desc,
	(a.id) AS cat_id,
	a.cat_desc
FROM
	categories AS a,
	subcategories AS b
WHERE
	a.id = b.cat_id




CREATE VIEW viewclassification AS
SELECT
	(b.classification_id) AS subclass_id,
	b.description AS subclass_description,
	(a.subtype_id) AS class_id,
	a.description AS class_description
FROM
	item_subtype_lib AS a,
	item_classification_lib AS b
WHERE
	a.subtype_id = b.subtype_id


CREATE VIEW viewcategories AS
SELECT
	a.id,a.cat_desc,
	(SELECT SUM(total_quantity) FROM viewequipment WHERE cat_id = a.id)  AS total_cat
FROM
	categories AS a
