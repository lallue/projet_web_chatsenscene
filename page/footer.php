<?php
// footer.php
// Fonction pour afficher le footer
function afficherFooter()
{
    $anneeActuelle = date("Y");
?>
    <div class="footer-content">
        <div class="footer-text-links">
            <h6>© <?php echo $anneeActuelle; ?> MonSiteDeChat. Tous droits réservés.</h6>
            <h6>
                <a href="../../page/politique/mentions-legales.php">Mentions légales</a> |
                <a href="../../page/politique/politique-confidentialite.php">Politique de confidentialité</a>
            </h6>
            <h6>
                Nos chatbots sont programmés pour être drôles, mais s'ils commencent à danser,
                il est temps de débrancher le Wi-Fi !
            </h6>
        </div>
        <div class="footer-contact-admin">
            <div class="footer-padding" id="contact">
                <h5>Contact et Information</h5>
                <?php include 'bdd/get_contact.php'; ?>
            </div>
            <button id="admin-login" class="btn-modern" onclick="window.location.href='<?php echo isset($_SESSION['admin_logged_in']) ? '../../page/admin/admin.php' : '../../page/loginAdmin.php'; ?>'">Administrateur</button>
        </div>
    </div>

<?php
}

// Appel de la fonction pour afficher le footer
afficherFooter();
?>