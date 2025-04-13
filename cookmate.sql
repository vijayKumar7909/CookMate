-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2024 at 06:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cookmate`
--

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `ingredients` text NOT NULL,
  `steps` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `cuisine` varchar(50) DEFAULT NULL,
  `cook_time` int(11) DEFAULT NULL,
  `diet_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `name`, `ingredients`, `steps`, `image`, `cuisine`, `cook_time`, `diet_type`) VALUES
(1, 'Pancakes', '1.Flour,\r\n2.Eggs,\r\n3.Milk,\r\n4.Sugar', '1. Mix the dry ingredients: Combine flour, sugar, baking powder, baking soda, and salt in a large bowl.\r\n\r\n2. Mix the wet ingredients: Beat the buttermilk, milk, eggs, and melted butter together in a separate bowl. Do not combine the wet and dry ingredients until right before you cook the pancakes.\r\n\r\n3. Make the pancakes: Add the wet ingredients to the dry ingredients and mix with a wooden spoon or fork until the mixtures are just-blended. Scoop the batter onto a hot, oiled griddle and cook until the pancake is bubbly on the top. Flip with a spatula and cook until both sides are brown.', 'images/pancakes.jpg', 'American', 15, 'Vegetarian'),
(2, 'Pasta', '1.Pasta,\r\n2.Tomatoes, \r\n3.Garlic, \r\n4.Olive Oil', '1.Gather the ingredients.\r\n\r\n2.Heat olive oil in a large saucepan over medium heat. Add onion, celery, garlic, parsley, Italian seasoning, pepper flakes, and salt; cook and stir until onion is translucent, about 5 minutes.\r\n\r\n3.Stir in chicken broth, tomato sauce, and tomatoes. Reduce the heat to low and simmer for 15 to 20 minutes.\r\n\r\n4.Add pasta and cook until tender, about 10 minutes.\r\n\r\n5.Stir in undrained beans and cook until heated through, 3 to 4 minutes.', 'images/pasta.jpg', 'Italian', 30, 'Vegetarian'),
(3, 'Chicken Curry', '1.Chicken, \r\n2.Spices, \r\n3.Onions, \r\n4.Tomatoes', '1.Heat olive oil in a skillet over medium heat. Sauté onion until lightly browned.\r\n\r\n2.Stir in garlic, curry powder, cinnamon, paprika, bay leaf, ginger, sugar, and salt. Continue stirring for 2 minutes.\r\n\r\n3.Add chicken pieces, tomato paste, yogurt, and coconut milk. Bring to a boil, reduce heat, and simmer for 20 to 25 minutes\r\n\r\n4.Remove bay leaf, and stir in lemon juice and cayenne pepper. Simmer 5 more minutes.\r\n\r\n5.Serve hot and enjoy!\r\n\r\n', 'images/chicken.jpg', 'Indian', 40, 'Non-Vegetarian'),
(4, 'Butter Chicken', '1.Chicken, \r\n2.Butter, \r\n3.Tomatoes, \r\n4.Cream, \r\n5.Spices', '1.Heat 1 tablespoon oil in a large saucepan over medium-high heat. Sauté shallot and onion until soft and translucent, about 5 minutes\r\n\r\n2.Stir in butter, ginger-garlic paste, lemon juice, 1 teaspoon garam masala, chili powder, cumin, and bay leaf. Cook and stir for 1 minute. Add tomato sauce, and cook for 2 minutes, continuing to frequently stir\r\n\r\n3.Stir in half-and-half and yogurt. Reduce heat to low, and simmer for 10 minutes, frequently stirring. Season with salt and pepper. Remove from heat and set aside.\r\n\r\n4.Heat remaining 1 tablespoon oil in a large heavy skillet over medium heat. Cook chicken until lightly browned, about 10 minutes.\r\n\r\n5.Reduce heat, and season with remaining 1 teaspoon garam masala and cayenne. Stir in a few spoonfuls of sauce, and simmer until liquid has reduced, and chicken is no longer pink. Add cooked chicken into sauce and stir together.\r\n\r\n6.Dissolve cornstarch into water, then mix into the sauce. Cook for 5 to 10 minutes, or until thickened.\r\n', 'images/butter_chicken.jpg', 'Indian', 45, 'Non-Vegetarian'),
(5, 'Palak Paneer', '1.Spinach, \r\n2.Paneer, \r\n3.Garlic, \r\n4.Spices, \r\n5.Cream', '1.Heat 1 tablespoon olive oil in a skillet over medium heat; cook and stir onion in hot oil until slightly tender, about 5 minutes. Add garlic, coriander, turmeric, garam masala, red pepper flakes, curry powder, cumin, and salt; cook and stir until fragrant, about 1 minute.\r\n\r\n2.Mix spinach, tomatoes, water, and ginger into onion mixture; simmer for 20 minutes. Remove from heat and cool slightly, about 5 minutes.\r\n\r\n3.Transfer spinach mixture to a blender and blend until smooth. Set aside.\r\n\r\n4.Heat remaining 1 tablespoon olive oil in the same skillet over medium heat; cook and stir paneer in hot oil until lightly browned, about 5 minutes. Stir in puréed spinach mixture and cook until heated through, 3 to 5 minutes.\r\n', 'images/palak_paneer.jpg', 'Indian', 30, 'Vegetarian'),
(6, 'Rajma Chawal', '1.Kidney Beans, \r\n2.Rice, \r\n3.Tomatoes, \r\n4.Spices', '1.Melt shortening in a skillet over medium heat. Cook and stir onion, bell pepper, and garlic in hot shortening until tender, 5 to 7 minutes.\r\n\r\n2.Combine water, red beans, and ham hock in a large pot; bring to a boil. Stir onion mixture into the pot; add smoked sausage and celery. Return to a boil. Stir bay leaves, Creole seasoning, thyme, and sage into boiling water. Reduce heat to low, cover the pot, and simmer until beans are tender, about 5 hours.\r\n\r\n3.Remove and discard ham hock and bay leaves; stir in hot pepper sauce and serve over white rice.', 'images/rajma_chawal1.jpeg', 'Indian', 40, 'Vegetarian'),
(7, 'Chole Bhature', '1.Chickpeas, \r\n2.Flour, \r\n3.Yogurt, \r\n4.Spices', '1.Place 2 cups water, tea bag, and bay leaf into a pot and bring water to a boil. Reserving about 1/2 cup garbanzo beans, stir beans into boiling water. When beans are heated through, discard tea bag and bay leaf. Remove from heat. Drain beans, reserving water, and set aside.\r\n\r\n2.Heat 2 teaspoons oil in a skillet over medium heat and sauté sliced onion until tender. Remove from heat, cool, and mix in reserved garbanzo beans, 1 tomato, and 1/2 the cilantro leaves. Set aside.\r\n\r\n3.Heat remaining oil in a skillet over medium heat. Blend in coriander, cumin seeds, ginger, and garlic. Cook and stir for 15 to 20 seconds, until lightly browned. Mix in turmeric. Stir chopped onion into the skillet and cook until tender. Mix in remaining tomatoes. Season with salt, cayenne pepper, and garam masala. Bring tomato liquid to a boil and cook about 5 minutes. Stir in boiled garbanzo beans, sliced onion mixture, and enough of the reserved water to attain a thick, gravy-like consistency. Continue to cook and stir 5 minutes. Garnish with remaining cilantro leaves to serve.', 'images/chole_bhature.jpg', 'Indian', 50, 'Vegetarian'),
(8, 'Tandoori Chicken', '1.Chicken, \r\n2.Yogurt, \r\n3.Spices', '1.Remove and discard skin from chicken pieces. Cut slits into meat and place into a shallow dish. Season chicken on both sides with lemon juice and salt. Let sit for 20 minutes.\r\n\r\n2.Mix yogurt, onion, garlic, garam masala, ginger, and cayenne pepper together in a medium bowl until smooth, then stir in food coloring.\r\n\r\n3.Spread yogurt mixture over chicken, cover, and refrigerate for 6 to 24 hours (the longer the better)\r\n\r\n4.When ready to cook, preheat an outdoor grill for medium-high heat and lightly oil the grate. Remove chicken from marinade. Discard remaining marinade.\r\n\r\n5.Cook chicken on the preheated grill until no longer pink and the juices run clear. An instant-read thermometer inserted near the bone should read 165 degrees F (74 degrees C).', 'images/tandoori_chicken.jpg', 'Indian', 40, 'Non-Vegetarian'),
(9, 'Masala Dosa', '1.Rice, \r\n2.Lentils, \r\n3.Potatoes, \r\n4.Spices', '1.Prepare the Batter:\r\nSoak 2 cups of rice and 1 cup of urad dal (black gram) separately for 4-6 hours. Grind them into a smooth batter, mix, and let it ferment overnight.\r\n\r\n2.Cook the Potato Filling:\r\nBoil and mash 3-4 potatoes. Sauté mustard seeds, curry leaves, green chilies, and onions in oil, then add turmeric, mashed\r\n\r\n3.Make the Dosa:\r\nHeat a non-stick pan or tawa, pour a ladle of batter, and spread it in a thin circle. Drizzle some oil or ghee on top.\r\n\r\n4.Assemble the Dosa:\r\nOnce the dosa is crisp and golden, place the potato filling in the center, fold, and remove from the pan. potatoes, and salt. Mix well.\r\n\r\n5.Serve:\r\nServe hot with coconut chutney and sambar. Enjoy!', 'images/dosa.jpg', 'Indian', 30, 'Vegetarian'),
(10, 'Sambar', '1.Toor Dal, \r\n2.Tamarind, \r\n3.Vegetables, \r\n4.Spices', '1.Place yellow split peas in a saucepan with 2 cups water and bring to a boil. Reduce heat to medium-low, and cook until soft, about 15 minutes. In another saucepan, mix together the tamarind pulp stir in 1/2 cup water to make a watery juice. Bring to a boil over medium-high heat. Add the bell pepper and tomato to the tamarind juice, and continue to boil until the vegetables are soft, and the liquid has reduced to almost half.\r\n\r\n2.Meanwhile, grind the coriander seeds, yellow lentils, coconut and chilies to a paste using a mortar and pestle or food processor. Add this paste to the tamarind sauce, then stir in the yellow lentils until everything is well blended. Bring to a boil once again, then remove from the heat and set aside.\r\n\r\n3.Heat oil in a small skillet over medium heat, and add the mustard seed, cumin seed, and asafoetida powder. Once the mustard seeds start to sputter and the mixture is fragrant, remove from heat and stir into sambar. Serve hot.', 'images/sambar.jpg', 'Indian', 35, 'Vegetarian'),
(11, 'Idli', '1.Rice, \r\n2.Lentils', '1.Heat vegetable oil in a pan over medium-low heat. Add mustard seeds, cumin seeds, and chana dal and saute for a few seconds. Add curry leaves, dried red chile, cashews, ginger, green chile peppers, and hing and saute until cashew nuts turn slightly brown, 3 to 4 minutes. Add semolina and cook and stir over low heat until slightly browned; remove mixture to a plate and let cool completely, about 10 minutes.\r\n\r\n2.Add yogurt and carrot to the mixture and mix well. Add water as needed to reach desired consistency. Season with salt to taste. Cover and let sit for 15 minutes. Check batter consistency again; add more water if needed.\r\n\r\n3.Grease an idli pan and add water to steam; bring to a boil.\r\n\r\n4.Meanwhile, add fruit salt to the batter, mix well, and then pour the batter in the greased molds.', 'images/idli.jpg', 'Indian', 20, 'Vegetarian'),
(12, 'Hyderabadi Biryani', '1.Basmati Rice, \r\n2.Chicken/Vegetables, \r\n3.Spices', '1.Place black peppercorns, cloves, cardamom, cinnamon sticks, star anise, and kala jeera in a spice grinder; grind into a fine powder.\r\n\r\n2.Place cilantro and mint leaves in a food processor; pulse until coarsely chopped.\r\n\r\n3.Combine spice powder, cilantro-mint mixture, yogurt, lemon juice, ginger-garlic paste, chile powder, biryani masala powder, and turmeric in a large bowl. Add chicken; turn to coat evenly. Cover with plastic wrap and let marinate in the refrigerator, about 2 hours.\r\n\r\n4.Bring water and rice to a boil in a saucepan; add 2 bay leaves. Reduce heat to medium-low, cover, and simmer until rice is partially cooked through and still firm, about 5 minutes. Drain.\r\n\r\n5.Combine milk and saffron in a small bowl; stir to combine.\r\n\r\n6.Heat ghee in a large pot with a tight-fitting lid over medium-high heat. Add onions; cook and stir until golden brown, about 15 minutes. Drain on paper towels. Reduce heat to low. Add remaining 2 bay leaves and chile peppers; cook and stir until fragrant, 1 to 2 minutes. Carefully remove 1 tablespoon of ghee from the pot; set it aside.\r\n\r\n7.Wipe excess marinade off the chicken, discarding marinade, and add to the pot. Cook over medium heat until no longer pink, about 2 minutes per side. Spread drained rice on top. Sprinkle onions on top of the rice. Drizzle reserved ghee and saffron milk over onions and rice.\r\n\r\n8.serve hot!!', 'images/hyderabadi_biryani.jpeg', 'Indian', 60, 'Non-Vegetarian'),
(13, 'Upma', '1.Semolina, \r\n2.Vegetables, \r\n3.Spices', '1.Roast semolina.\r\n2.Cook with vegetables \r\n3.Add spices.', 'images/upma.jpg', 'Indian', 20, 'Vegetarian'),
(14, 'Fried Rice', '1.Rice, \r\n2.Vegetables, \r\n3.Soy Sauce', '1.Combine 4 cups of water and 2 cups of white rice in a saucepan; bring to a boil.\r\n\r\n2.Reduce the heat, then cover and simmer until the rice is tender and the water has been absorbed, 20 to 25 minutes.\r\n\r\n3.Remove from the heat and let cool to room temperature.', 'images/fried_rice.jpg', 'Chinese', 25, 'Vegetarian'),
(15, 'Manchurian', '1.Vegetables, \r\n2.Soy Sauce, F\r\n3.lour, \r\n4.Garlic', '1.Heat oil in a large pot over medium heat.\r\n\r\n2.Mix flour, cornmeal, water, black pepper, and salt together in a bowl to make a thick batter. Toss in cauliflower florets and mix until coated.\r\n\r\n3.Deep fry cauliflower a few florets at a time until golden brown, about 3 minutes. Transfer to a paper towel-lined plate.\r\n\r\n4.Mix 1/4 cup vegetable stock with cornmeal in a bowl. Add soy sauce, ketchup, chile-garlic sauce, and salt.\r\n\r\n5.Heat oil in a wok or frying pan over high heat. Add onions, chile pepper, garlic, and ginger and stir fry for a few seconds. Add cornmeal mixture and cook 1 to 2 minutes. Add remaining vegetable stock and cook until very thick, about 10 minutes. Remove sauce from heat.\r\n\r\n6.Spoon sauce over fried cauliflower and toss slightly. Garnish with green onions and serve.', 'images/manchurian.jpg', 'Chinese', 30, 'Vegetarian'),
(16, 'Burgers', '1.Burger Buns, \r\n2.Patties, \r\n3.Lettuce, \r\n4.Cheese', '1.Preheat an outdoor grill for high heat and lightly oil grate.\r\n\r\n2.Whisk egg, salt, and pepper together in a medium bowl.\r\n\r\n3.Add ground beef and bread crumbs; mix with your hands or a fork until well blended.\r\n\r\n4.Form into four 3/4-inch-thick patties.\r\n\r\n5.Place patties on the preheated grill. Cover and cook 6 to 8 minutes per side, or to desired doneness. An instant-read thermometer inserted into the center should read at least 160 degrees F (70 degrees C).\r\n\r\n6.Serve hot and enjoy!', 'images/burger.jpg', 'American', 15, 'Non-Vegetarian'),
(17, 'Hot Dogs', '1.Hot Dog Buns, \r\n2.Sausages, \r\n3.Mustard', '1.Preheat an air fryer to 400 degrees F (200 degrees C).\r\n\r\n2.Place buns in a single layer in the air fryer basket; cook in the preheated air fryer until crisp, about 2 minutes. Remove buns to a plate.\r\n\r\n3.Place hot dogs in a single layer in the air fryer basket; cook for 3 minutes. Serve hot dogs in toasted buns.', 'images/hot_dogs.jpg', 'American', 10, 'Non-Vegetarian'),
(18, 'Pizza (Margherita)', '1.Dough, \r\n2.Tomato Sauce, \r\n3.Mozzarella, \r\n3.Basil', '1.Place warm water in a bowl; add yeast and sugar. Mix and let stand until creamy, about 10 minutes.\r\n\r\n2.Add flour, oil, and salt to the yeast mixture; beat until smooth. You can do this by hand or use a stand mixer fitted with a dough hook to make it easier\r\n\r\n3.Turn dough out onto a lightly floured surface and pat or roll into a 12-inch circle.\r\n\r\n4.Transfer to the prepared pizza pan.\r\n\r\n5.Spread crust with sauce and toppings of your choice.\r\n\r\n6.Bake in the preheated oven until golden brown, 15 to 20 minutes. Remove from the oven and let cool for 5 minutes before serving.\r\n', 'images/pizza.jpg', 'Italian', 20, 'Vegetarian'),
(19, 'Tao Chicken', '1.2 pounds skinless, boneless chicken breast halves - cut into bite-size pieces\r\n\r\n2.¼ cup cornstarch\r\n\r\n3.2 large eggs\r\n\r\n4.6 tablespoons all-purpose flour', '1.Coat chicken pieces with cornstarch in a bowl; set aside. Beat eggs, salt, and pepper in a mixing bowl until combined. Stir in flour and baking powder until no large lumps remain. Mix in chicken pieces until evenly coated.\r\n\r\n2.Heat vegetable oil in a large skillet or wok over high heat. Cook chicken in hot oil until golden brown and no longer pink on the inside, about 12 minutes. Set chicken aside; keep warm.\r\n\r\n3.Make sauce: Reduce heat to medium-high; add green onion, ginger, and sesame oil to the skillet. Cook and stir until onion is limp and ginger begins to brown, about 1 minute. Pour in water, sugar, and vinegar; bring to a boil\r\n\r\n4.Dissolve cornstarch in soy sauce in a small bowl and stir into vinegar mixture along with oyster sauce and ketchup. Cook until sauce has thickened and is no longer cloudy. Stir in chicken; simmer until heated through.', 'images/tao_chicken.png', 'Chinese', 50, 'Non-Vegetarian'),
(20, 'Fried Noodles', '1.2 (3 ounce) packages soy sauce-flavored ramen noodles with seasoning packets\r\n2.3 large eggs, beaten\r\n3.4 green onions, thinly slice\r\n4.1 teaspoon soy sauce, or to taste', '1.Bring a medium pot of water to a boil. Cook ramen noodles, reserving seasoning packets, in boiling water until softened, about 3 minutes. Drain noodles and set aside.\r\n\r\n2.Heat 1 tablespoon vegetable oil in a small skillet. Cook and stir beaten eggs in hot oil until scrambled and firm. Set aside.\r\n\r\n3.Heat 1 teaspoon vegetable oil in a large skillet over medium heat. Cook and stir green onions in hot oil until softened, 2 to 3 minutes. Remove green onions to a plate; set aside.\r\n\r\n4.Heat remaining 1 teaspoon vegetable oil in the same skillet over medium heat. Cook and stir carrots, peas, and bell pepper separately until softened, removing each to the plate with green onions when done.\r\n\r\n5.Combine 2 tablespoons sesame oil with remaining 1 tablespoon vegetable oil in the same large skillet or a wok over medium heat. Fry cooked noodles in hot sesame-vegetable oil, tossing frequently, until golden, 3 to 5 minutes. Season with desired amounts of sesame oil, soy sauce, and reserved ramen seasoning packets; toss to coat. Stir in cooked vegetables, tossing frequently, until heated through, about 5 more minutes.', 'images/Fried_Noodles.png', 'Chinese', 45, 'Non-Vegetarian');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `profile_picture`) VALUES
(23, 'vamshi', 'vijay236764@gmail.com', '1', '2024-12-02 16:30:27', ''),
(24, 'Vijay Kumar', 'weirdbohy7909@gmail.com', '1', '2024-12-02 17:00:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_favorites`
--

CREATE TABLE `user_favorites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_favorites`
--

INSERT INTO `user_favorites` (`id`, `user_id`, `recipe_id`) VALUES
(141, 23, 5),
(142, 23, 1),
(144, 24, 4),
(145, 24, 3),
(146, 24, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_favorites`
--
ALTER TABLE `user_favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user_favorites`
--
ALTER TABLE `user_favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`);

--
-- Constraints for table `user_favorites`
--
ALTER TABLE `user_favorites`
  ADD CONSTRAINT `user_favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_favorites_ibfk_2` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
