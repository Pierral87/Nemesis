-- Les transactions sont possibles en MySQL
-- Il faudra par contre bien choisir, le moteur InnoDB sinon impossible de faire une transaction et aussi impossible de créer des relations 
-- On s'en sert dans le web lorsqu'une opération est composée de plusieurs requêtes qui sont liées. Mais, on veut s'assurer qu'elles s'executent toutes convenablement pour les valider ensemble et éviter des incohérences. 
-- Si un problème est rencontré, on est capable d'annuler la totalité de la transaction 

-- Dans la console, cela nous permet de tester des requêtes avant de les valider 
-- Dans notre langage back, on gèrera les transactions via des classes natives de PHP comme PDO englobées dans un try/catch 

USE entreprise; 

START TRANSACTION; -- démarre une transaction

SELECT * FROM employes; -- Ok je suis bien dans l'état d'origine de ma table employes 

UPDATE employes SET salaire = +100; -- Oups ! Trompé ! J'ai mis tout le monde à 100 au lieu d'augmenter tout le monde de 100 T_T

SELECT * FROM employes; -- Mon erreur est bien visible avec un SELECT * FROM employes par contre je peux voir que dans PHPMyAdmin, l'état n'a pas changé, j'étais dans la transaction ! Ouf ! 

ROLLBACK; -- Je peux annuler ici grâce à ROLLBACK
COMMIT; -- Ou bien valider là grâce à COMMIT

-- ATTENTION, un rollback ou un commit termine la transaction, et je me retrouve dans "l'espace réel" de manipulation de ma BDD 

-- Lorsque l'on manipulera la BDD au travers de PHP avec PDO, on pourra si on le souhaite mettre en place une transaction car la classe PDO possède des méthodes beginTransaction()  commit()  rollback()

-- Exemple en PHP : 
try {
    $pdo = new PDO("....."); -- Création de la liaison vers la BDD

    -- Début de transaction
    $pdo->beginTransaction();
    -- Lancement de plusieurs requêtes toutes rattachées à la même opération
    $stmt = $pdo->query("ma requete UPDATE qqchoz....");
    $stmt2 = $pdo->query("une autre requete UPDATE qqchoz...");

    -- Si tout va bien, je suis encore dans ce bloc là, et je peux commit les modifications pour les valider
    $pdo-commit();

} catch (PDOException $e) {
    $erreur = "Erreur d'opération";
    -- S'il y a eu un problème sur une des deux requêtes alors je tombe ici dans le bloc catch et je rollback la totalité de la transaction 
    $pdo->rollback();
}

