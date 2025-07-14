<body>
       <form action="../traitement/traitement_emprunt_objet.php" method="post">
        <div class="mb-3">
            <label for="objet_id" class="form-label">ID de l'objet :</label>
            <input type="text" class="form-control" name="objet_id" id="objet_id" required>
        </div>

        <div class="mb-3">
            <label for="membre_id" class="form-label">ID du membre :</label>
            <input type="text" class="form-control" name="membre_id" id="membre_id" required>
        </div>

        <div class="mb-3">
            <label for="nb_jours" class="form-label">Nombre de jours d'emprunt :</label>
            <input type="number" class="form-control" name="nb_jours" id="nb_jours" min="1" required>
        </div>

        <button type="submit" class="btn btn-primary">Emprunter</button>
    </form>
</body>
</html>
