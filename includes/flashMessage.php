                <div>
                    <?php if(isset($_SESSION['flash'])): ?>
                        <?php foreach($_SESSION['flash'] as $type => $message): ?>
                            <div class="alert alert-<?= $type; ?> alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <?= $message; ?>
                            </div>
                        <?php endforeach; ?>
                        <?php unset($_SESSION['flash']); ?>
                    <?php endif; ?>
                </div>
                <!-- Affichage des erreurs -->
                <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <p>Vous n'avez pas rempli correctement le formulaire</p>
                    <ul>
                    <?php foreach($errors as $error): ?>
                        <li><?= $error; ?></li>
                    <?php endforeach; ?>
                </ul>
                </div>
                <?php endif; ?>