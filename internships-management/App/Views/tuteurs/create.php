<div class=" mt-4">
        <div class="">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4>Ajouter un nouveau tuteur</h4>
                </div>
                <div class="card-body">
                    <?php if (isset($errors) && !empty($errors)): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach ($errors as $error): ?>
                                    <li><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="/tuteurs/store" method="POST">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control <?= isset($errors) && in_array('Le nom est obligatoire', $errors) ? 'is-invalid' : '' ?>" 
                                       id="nom" name="nom" value="<?= isset($data['nom']) ? htmlspecialchars($data['nom']) : '' ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="prenom" class="form-label">Prénom</label>
                                <input type="text" class="form-control <?= isset($errors) && in_array('Le prénom est obligatoire', $errors) ? 'is-invalid' : '' ?>" 
                                       id="prenom" name="prenom" value="<?= isset($data['prenom']) ? htmlspecialchars($data['prenom']) : '' ?>" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control <?= isset($errors) && (in_array('L\'email est obligatoire', $errors) || in_array('L\'email n\'est pas valide', $errors) || in_array('Cet email est déjà utilisé', $errors)) ? 'is-invalid' : '' ?>" 
                                   id="email" name="email" value="<?= isset($data['email']) ? htmlspecialchars($data['email']) : '' ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="mot_de_passe" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control <?= isset($errors) && (in_array('Le mot de passe est obligatoire', $errors) || in_array('Le mot de passe doit contenir au moins 6 caractères', $errors)) ? 'is-invalid' : '' ?>" 
                                   id="mot_de_passe" name="mot_de_passe" required>
                            <div class="form-text">Le mot de passe doit contenir au moins 6 caractères.</div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="departement" class="form-label">Département</label>
                            <input type="text" class="form-control <?= isset($errors) && in_array('Le département est obligatoire', $errors) ? 'is-invalid' : '' ?>" 
                                   id="departement" name="departement" value="<?= isset($data['departement']) ? htmlspecialchars($data['departement']) : '' ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="poste" class="form-label">Poste</label>
                            <input type="text" class="form-control <?= isset($errors) && in_array('Le poste est obligatoire', $errors) ? 'is-invalid' : '' ?>" 
                                   id="poste" name="poste" value="<?= isset($data['poste']) ? htmlspecialchars($data['poste']) : '' ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="experience" class="form-label">Expérience</label>
                            <textarea class="form-control" id="experience" name="experience" rows="3"><?= isset($data['experience']) ? htmlspecialchars($data['experience']) : '' ?></textarea>
                        </div>
                        
                        <input type="hidden" name="role" value="tuteur">
                        <input type="hidden" name="statut" value="active">
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="/tuteurs" class="btn btn-secondary me-md-2">Annuler</a>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
