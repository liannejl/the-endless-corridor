CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` text,
  `password` text,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `choices` (
  `id` int,
  `choice` text,
  `goesTo_id` int,
  PRIMARY KEY (`id`)
);
INSERT INTO `choices`
  (`id`, `choice`, `goesTo_id`)
VALUES
  (1, 'first door', 2),
  (2, 'second door', 3),

  (3, 'stars', 4),
  (4, 'flames', 5),

  (5, 'join', 9),
  (6, 'stay', 10),

  (7, 'spare', 11),
  (8, 'kill', 1),

  (9, 'attic', 6),
  (10, 'basement', 7),

  (11, 'help', 12),
  (12, 'leave', 13),

  (13, 'immortality', 14),
  (14, 'give soul', 15);


CREATE TABLE IF NOT EXISTS `room` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` text,
  `description` text,
  `choice1_id` int,
  `choice2_id` int,
  PRIMARY KEY (`id`)
);
INSERT INTO `room`
  (`name`, `description`, `choice1_id`, `choice2_id`)
VALUES
  -- 1
  ('starting',
    "You wake up to find yourself in a dark hallway. The only thing you can
    see are the many identical doors in front of you. You're not sure what you
    want to do next until you look around into the dark abyss around you.
    Although you don't sense any danger, there is an ominous aura that puts
    you on edge. You decide you want to leave through one of the many doors in
    the corridor. You narrow your choices to the two plain doors in front of you,
    the first door and the second door.", 1, 2
  ),

  -- 2
  ('foggy',
    "You decided to go through the first door. As you enter the door, you see
    streams of light coming from seemingly nowhere. The light allows the fog
    floating around the room become visible. Your vision is continuously
    getting more hazy as if you were in a dream. You start sweating accompanied
    by chills. You find yourself in another corridor with more doors to choose
    from just like the last ones except these doors are subtly different with
    symbols on them. You feel a sense of urgency to leave this hallway as you
    start to feel you are losing sense of reality. You stumble towards the
    first two doors you see. One door has star symbols and the other has flame
    symbols.", 3, 4
  ),

  -- 3
  ('calming',
    "You decided to go through the second door. You instantly find yourself in a
    calming and familiar living room. Your uneasiness goes away as you take in the new,
    relaxing environment. In this living room, you see couches, a rug, and a table in
    front of you accompanied with two doors to the basement and attic. You decide you want
    to explore the new environment a little.", 9, 10
  ),

  -- 4
  ('space floating',
    "You clumsily go towards the star door. As you enter, you find yourself in space, floating.
     You start to get a grip of reality again. As you start to look around in relief at the
     beautiful spacescape filled with stars and light, you find yourself facing an out-of-world
     creature. It doesn't look threatening but there is nothing comforting about it either. It starts
     pointing towards its spacecraft gesturing for you to join it.", 5, 6
  ),

  -- 5
  ('heat',
    "You clumsily rush towards the flame door. As you open the door, you feel a blast of heat as you
     enter a room full of fire and smoke. As you start to get a grip on reality again, you feel the
     effects of smoke getting to you. Suddenly, a figure emerges from the fire in front of you. It's
     three times the size of you with long arms and legs with claws and has the figure of a bear. It
     definitely looks like it has the ability to kill but it stands there motionless and docile.", 7, 8
  ),

  -- 6
  ('teddy bear',
    "You decide to go to the attic to explore. There, you find a teddy bear. Just as you are about to
    pick it up, it speaks.'Help, please. I don't want to live here forever. The only way I can leave is
    if you take me! The only way out here is for you to fly. I can give you that ability but every time you fly,
    that amount of time is taken away from your life span. Will you accept and help me please?' the bear pleads.
    You're not sure if the bear was telling the truth since what it just said was quite unusual.", 11, 12
  ),

  -- 7
  ('talking smoke',
    "You decide to head towards the basement. As you walk down the stairs, you feel a chill go down your spine.
    The stairs are squeaky and unstable as you put weight on them. Making you feel uneasy, you speed up your pace.
    When you get to the basement, you see a floating ball of black smoke. The aura it gives off makes you feel uneasy.
    You start to approach the smoke without knowing you started to move your legs. The next thing you know, the
    smoke starts to speak to you through your mind. 'You're the first in eons to stumble upon me. I must be lucky
    to finally have a meal. the ball of smoke says. How about this, I'll give you a choice, would you like to become
    immortal and keep living in this cruel world or will you be willing to give your soul to me?'", 13, 14
  ),

  -- 8
  ('kill monster',
    "Out of fear, you try to find something to defend yourself with. Seeing that the creature seems to be made of mainly fire,
     you take out your water bottle from your bag and pour it on the creature. The creature starts whimpering and eventually
     disappears into the mist. Now that the immediate threat is gone, you realize the danger of being surrounded by flames.
     Looking around, you see a hole in the ground created by the burning caused by the fire.", 0, 0
  ),

  -- 9
  ('Ending 1',
    "Ending 1:
    You decide to join the alien and head towards its ship. As you enter the ship, you see a bunch of high tech electronics you've
     never seen before. There are many lights and compartments that seem to have the resting aliens. You see a bunch of other kinds
     of aliens and even a human. Your curiosity and red flags start to go up as you are told to get into one of the resting chambers.
     Before you could react, you get pushed in. Instead of panicking like you expected you would, you started to feel calm and have a
     sense of security as you fall asleep. You wake up to the opening of the chambers. There is a bunch of murmuring as the other aliens
     woke up as well. You find yourself on another planet very similar to Earth with water and land except the color scheme of the land
     and water is slightly different. Play again?", 0, 0
  ),

  -- 10
  ('Ending 2',
    "Ending 2:
    You choose to ignore the alien and started to float away. Once you started to float, you didn't stop for a long time. You soon started
     to lose hope and realized that you might have ignored your only way out of this endless abyss of space. Eventually, after countless days,
     weeks, or even months floating, you landed on a small planet. It was a self sufficient planet with only plants and a couple of organisms.
     Everything looked weird but you assumed that they still functioned like earth. You continued to live off of this planet until you used all
     of its resources. Play again?", 0, 0
  ),

  -- 11
  ('Ending 3',
    "Ending 3:
    You decide there is no reason to take away another living creature's life. You start to slowly approach the creature cautiously. Something
     told you that the monster wouldn't hurt you. As you get closer, the creature looks at you and starts towards you too. You freeze until you
     realize what the creature is trying to do. It's trying to shield you from the fire. You make your way to another door with the help of the
     creature. The door leads outside to what seems like a tundra. As you leave, you instantly feel the biting cold of the tundra even though you
     just came from a boiling hot room. The creature followed you and sensing your chills, it snuggles with you to keep you warm. You and this
     creature stay together and become best friends as you try to find your way back to civilization. Play again?", 0, 0
  ),

  -- 12
  ('Ending 4',
    "Ending 4:
    You decide you want to help the bear as you can't imagine being stuck in an attic for eternity. Immediately after you decided, you started
     floating with the bear in your arms. You float through the ceiling and appear in an unknown city. While you make your way home, you start getting
     to know the bear better. Although unusual, the talking bear became your best friend with a lot in common with you. Play again?", 0, 0
  ),

  -- 13
  ('Ending 5',
    "Ending 5:
    You start walking away willing to leave the bear because of how skeptical you were of it. You return to the living room to see if it was true
     that there was no other exit. Looking all around, you realize there were no other doors besides the attic and basement doors. Desperate to leave
     at this point, you return to the attic to accept the bear's offer but the bear disappeared. You accept that you would have to live in this room
     for the rest of your life. You're not sure whether you're satisfied because of the comforting feeling the room gives or if you were disappointed
     because you want more freedom than that one room. Play again?", 0, 0
  ),

  -- 14
  ('Ending 6',
    "Ending 6:
    You decided the best choice in this situation would be immortality as you would like to keep your soul. As you told the ball of smoke, it started
     to laugh. 'Thank you. This would be plenty of food for eternity the black smoke said.' Still confused and trying to process what the ball said,
     you suddenly got teleported back home something wasn't right. The black smoke ball was still with you. 'Oh, did I forget to tell you? I get to
     haunt you for eternity to eat the souls of those who die around you the smoke ball said happily.' You continued to live watching people's souls
     become part of the black smoke ball. Play again?", 0, 0
   ),

   -- 15
   ('Ending 7',
     "Ending 7: You decide you would rather lose your soul than live forever. 'Very well.', the smoke says. You start to feel sleepy and eventually lose
     consciousness. You wake up again eventually but you don't feel normal. You look at yourself and you see that you don't have a body, but ,
     you're a small ball of black smoke. You now understand how the black smoke exists. You feel hungry and realize that the only thing you could
      eat is other people's souls. You suddenly have empathy for the ball of smoke who took your soul. Play again?", 0, 0
    );
