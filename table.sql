CREATE TABLE `drink_master` (
  `drink_id` int(11) NOT NULL,
  `drink_name` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `create_datetime` datetime DEFAULT NULL,
  `update_datetime` datetime DEFAULT NULL
) ;

ALTER TABLE `drink_master`
 ADD PRIMARY KEY (`drink_id`);

ALTER TABLE `drink_master`
MODIFY `drink_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;


CREATE TABLE `drink_stock` (
  `drink_id` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `create_datetime` datetime DEFAULT NULL,
  `update_datetime` datetime DEFAULT NULL
);

ALTER TABLE `drink_stock`
 ADD PRIMARY KEY (`drink_id`);

CREATE TABLE `drink_history` (
  `history_id` int(11) DEFAULT NULL,
  `drink_id` int(11) DEFAULT NULL,
  `create_datetime` datetime DEFAULT NULL
);

ALTER TABLE `drink_history`
 ADD PRIMARY KEY (`history_id`);

ALTER TABLE `drink_history`
MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
