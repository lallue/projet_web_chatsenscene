# ChatSenScene - Analyse Ecoindex
# ALLUE Luc

## Acte métier

Ce scénario simule la navigation d'un utilisateur lambda sur le site web ChatSenScene pour découvrir les chats disponibles à l'adoption ou voir des chats trop mignon. 

* L'utilisateur arrive sur la page d'accueil.
* Il consulte la page "Description" pour voir les chats disponibles.
* Il consulte la page "Contact" pour obtenir des informations supplémentaires.

## Solution

Site web ChatSenScene, hébergé sur Kubel.tech.

## Scénario

**Ouvrir le plugin Ecoindex, taper about:blank dans la barre d'adresse, vider le cache, activer les bonnes pratiques**

### Mesure 1 : Page d'accueil

1. Accès à la page d'accueil : `https://chatsenscene.kubel.tech/index.php`
2. Visioner notre présentation ou cliquer sur image pour les image générer 

### Mesure 2 : Page "Description"

1.  Accéder à la page "Description" en cliquant sur le lien correspondant sur la page d'accueil : `https://chatsenscene.kubel.tech/page/description.php`
2. Visionner les chats disponibles soit parce qu'il sont mignon ou disponible a l'adoption

### Mesure 3 : Page "Description" (2ème run)

1.  Accéder à la page "Description" en cliquant sur le lien correspondant sur la page d'accueil : `https://chatsenscene.kubel.tech/page/description.php`

### Mesure 4 : Page "Contact"

1.  Accéder à la page "Contact" en cliquant sur le lien correspondant sur la page d'accueil : `https://chatsenscene.kubel.tech/page/contact.php`
2. Récupérer les informations de contacts pour nous contacter.
3. Utiliser le formulaire pour que l'on vous contacte ultérieurement.

### Mesure 5 : Page "Mentions Légales"

1.  Accéder à la page "Mentions Légales" en cliquant sur le lien correspondant sur la page d'accueil : `https://chatsenscene.kubel.tech/page/politique/mentions-legales.php`
2.  Visionner nos mentions légales.

### Mesure 6 : Page "Politique de Confidentialité"

1.  Accéder à la page "Politique de Confidentialité" en cliquant sur le lien correspondant sur la page d'accueil : `https://chatsenscene.kubel.tech/page/politique/politique-confidentialite.php`
2.  Visionner notre politique.

### Mesure 7 : Page de connexion Admin

1.  Accéder à la page de connexion admin : `https://chatsenscene.kubel.tech/page/loginAdmin.php`
2. Espace réservé aux administrateurs et aux utilisateurs confirmé.

### Mesure 8 : Page  Admin 

1.  Accéder à la page admin à nouveau : `https://chatsenscene.kubel.tech/page/admin/admin.php`
2. Espace reservé aux administrateurs

### Mesure 9 : Page de connexion Admin simplifiée

1.  Accéder à la page admin simplifiée : `https://chatsenscene.kubel.tech/page/admin/admin.php`
2.  Espace réservé aux administrateurs et aux utilisateurs confirmé.

**FIN**

***RUN ECOINDEX***
Les run sont effectués de la manière suivante :
1) On arrive sur la page.
2) On ouvre le plugin GreenIT
3) On vide le cache.
4) On recharge la page avec le bouton en haut à droite ou crt + F5
5) On sélectionne activer l'analyse des bonnes pratiques.
6) On lance l'analyse.
Les tests sont réalisés sans cliquer sur du contenu sur le site ou d'autres manipulations spéciales. 

## Premier run Ecoindex

| Mesure | Requêtes | Taille | DOM | GES    | Eau | ecoIndex | Note |
|--------|----------|--------|-----|--------|-----|----------|------|
|       1|     12   |  110   | 48  | 1.14   | 1.71| 93.00    | A    |
|       2|     14   |  991   | 73  | 1.28   | 1.92| 85.86    | A    |
|       3|     14   |  991   | 73  | 1.28   | 1.92| 85.86    | A    |
|       4|     10   |  70    | 89  | 1.19   | 1.78| 90.66    | A    |
|       5|     10   |  69    | 64  | 1.16   | 1.74| 92.06    | A    |
|       6|     10   |  70    | 89  | 1.19   | 1.78| 90.66    | A    |
|       7|     11   |  29    | 0   | 0.108  | 1.61| 96.19    | A    |
|       8|     10   |  69    | 0   | 0.108  | 1.62| 96.08    | A    |
|       9|     10   |  70    | 65  | 1.16   | 1.74| 91.97    | A    |

## 2e run ecoindex

| Mesure | Requêtes | Taille | DOM | Ecoindex | Eau | CO2 | BP Rouges | BP Jaunes | BP Vertes |
|--------|----------|--------|-----|----------|-----|-----|-----------|-----------|-----------|
|       1|     12   |    110 | 48  |  93.00   | 1.71|1.14 |    4      |    0      |     17    |
|       2|     14   |    991 | 73  |  85.86   | 1.92|1.28 |    5      |    0      |     16    |
|       3|     14   |    991 | 73  |  85.86   | 1.82|1.28 |    5      |    0      |     16    |
|       4|     10   |    75  | 89  |  91.66   | 1.74|1.19 |    3      |    1      |     17    |
|       5|     10   |    72  | 64  |  91.06   | 1.74|1.16 |    3      |    1      |     17    |
|       6|     10   |    70  | 89  |  92.66   | 1.67|1.19 |    3      |    1      |     17    |
|       7|     11   |    50  | 51  |  96.5    | 1.62|0.108|    3      |    1      |     17    |
|       8|     10   |    69  | 82  |  96.08   | 1.62|0.108|    1      |    1      |     19    |
|       9|     10   |    70  | 65  |  91.97   | 1.74|1.16 |    3      |    1      |     17    |

## 3e run ecoindex

| Mesure | Requêtes | Taille | DOM | Ecoindex | Eau | CO2 | BP Rouges | BP Jaunes | BP Vertes |
|--------|----------|--------|-----|----------|-----|-----|-----------|-----------|-----------|
|       1|     12   |   43   |  51 |  93.12   | 1.71| 1.14|    0      |    1      |    20     |
|       2|     12   |   68   |  71 |  91.19   | 1.76| 1.18|    0      |    1      |    20     |
|       3|     12   |   72   |  74 |  91.15   | 1.77| 1.18|    0      |    1      |    20     |
|       4|     9    |   41   |  64 |  92.35   | 1.73| 1.15|    0      |    1      |    20     |
|       5|     9    |   42   |  65 |  92.26   | 1.73| 1.15|    0      |    1      |    20     |
|       6|     9    |   43   |  89 |  90.94   | 1.77| 1.18|    0      |    1      |    20     |
|       7|     9    |   41   |  48 |  93.78   | 1.69| 1.12|    0      |    1      |    20     |
|       8|     10   |   22   |  125|  89.87   | 1.80| 1.20|    0      |    1      |    20     |
|       9|     10   |   44   | 67  |  91.94   | 1.74| 1.16|    0      |    1      |    20     |
