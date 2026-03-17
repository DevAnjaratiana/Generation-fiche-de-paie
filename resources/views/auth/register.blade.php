<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription — Gestion Paie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<script>
    // Empêche le bouton retour dès le chargement
    history.pushState(null, null, location.href);

    // Empêche aussi après chaque navigation
    window.onpageshow = function(event) {
        if (event.persisted) {
            history.pushState(null, null, location.href);
        }
    };

    window.addEventListener('popstate', function () {
        history.pushState(null, null, location.href);
    });
</script>
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-5">

            {{-- Logo / Titre --}}
            <div class="text-center mb-4">
                <h2 class="fw-bold">💼 Gestion Paie</h2>
                <p class="text-muted">Créez votre compte</p>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-success text-white fw-semibold text-center">
                    Inscription
                </div>
                <div class="card-body p-4">

                    {{-- Erreurs --}}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('register') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Nom <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}"
                                   placeholder="Votre nom complet" required autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}"
                                   placeholder="exemple@mail.com" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Mot de passe <span class="text-danger">*</span></label>
                            <input type="password" name="password" id="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Minimum 5 caractères" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-semibold">Confirmer le mot de passe <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   class="form-control"
                                   placeholder="Répétez le mot de passe" required>
                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            ✅ S'inscrire
                        </button>

                    </form>

                </div>
                <div class="card-footer text-center text-muted small py-3">
                    Déjà un compte ?
                    <a href="{{ route('login') }}" class="text-primary fw-semibold">Se connecter</a>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
