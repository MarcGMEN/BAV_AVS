CREATE TABLE `bav_accessoire` (
  `acc_id` int NOT NULL,
  `acc_numero` int NOT NULL,
  `acc_numero_bav` int NOT NULL,
  `acc_commentaire` text NOT NULL,
  `acc_etat` enum('Déposé','A restituer','Restituer') NOT NULL DEFAULT 'Déposé'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bav_accessoire`
--
ALTER TABLE `bav_accessoire`
  ADD PRIMARY KEY (`acc_id`),
  ADD UNIQUE KEY `acc_numero` (`acc_numero`,`acc_numero_bav`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bav_accessoire`
--
ALTER TABLE `bav_accessoire`
  MODIFY `acc_id` int NOT NULL AUTO_INCREMENT;
COMMIT;
