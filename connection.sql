
CREATE TABLE IF NOT EXISTS `progress` (
  `id` int NOT NULL AUTO_INCREMENT,
  `player_id` int,
  `room_id` int,
  `dialogue` text,
  PRIMARY KEY (`id`)
);
